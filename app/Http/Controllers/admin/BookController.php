<?php namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\BookForm;
use Auth, Notification, Request;
use App\Model\Tag;
use App\Model\Book;
use App\Model\Category;
use Illuminate\Support\Facades\Input;

class BookController extends Controller
{
    public function __construct()
    {
        conversionClassPath(__CLASS__);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $catArr = Category::getCategoryTree('选择分类');
        $schParams = $this->getSchParams();
        $books = $this->filterBooks($schParams);

        return adminView("index", ['books' => $books, 'catArr' => $catArr, 'schParams' => $schParams]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catArr = Category::getCategoryTree();
        unset($catArr[0]);
        $tagList = \App\Model\Tag::getTagArray();
        return adminView('create', ['catArr' => $catArr, 'tagList' => $tagList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookForm $request)
    {
        try {
            $data = array(
                'bookname' => $request->input('bookname'),
                'user_id' => Auth::user()->id,
                'cid' => empty($request->input('cid')) ? 0 : $request->input('cid'),
                'content' => $request->input('content'),
                'tags' => Tag::SetBookTags(implode(',', $request->input('tags'))),
                'pic' => Book::uploadImg('pic'),
                'publisher' => $request->input('publisher'),
                'author' => $request->input('author'),
                'price' => $request->input('price'),
                'booknum' => $request->input('booknum')
            );

            if ($article = Book::create($data)) {
                // 清除缓存
//                dd($data);
//                Cache::tags(Book::REDIS_BOOK_PAGE_TAG)->flush();
                Notification::success('新增图书成功');
                return redirect()->route('admin.book.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catArr = Category::getCategoryTree();
        unset($catArr[0]);
//        dd( Book::find($id));
        $tagList = \App\Model\Tag::getTagArray();
//        dd($tagList);

        return adminView('edit', ['book' => Book::find($id), 'catArr' => $catArr, 'tagList' => $tagList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookForm $request, $id)
    {
        try {
            $data = array(
                'bookname' => $request->input('bookname'),
                'user_id' => Auth::user()->id,
                'cid' => $request->input('cid'),
                'content' => $request->input('content'),
                'tags' => Tag::SetBookTags($request->input('tags')),
//                'tags' => Tag::SetBookTags(implode(',', $request->input('tags'))),
                'publisher' => $request->input('publisher'),
                'author' => $request->input('author'),
                'price' => $request->input('price'),
                'booknum' => $request->input('booknum')
            );

            if (Request::hasFile('pic')) {
                $data['pic'] = Book::uploadImg('pic');
            }
            if (Book::where('id', $id)->update($data)) {
                Notification::success('更新成功');
                // 清除缓存
                Cache::tags(BOOK::REDIS_BOOK_PAGE_TAG)->flush();
                Cache::forget(BOOK::REDIS_BOOK_CACHE . $id);
                return redirect()->route('admin.book.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if (Book::destroy($id)) {
            Notification::success("删除“{$book->bookname}”成功");
            Cache::tags(BOOK::REDIS_BOOK_PAGE_TAG)->flush();
            Cache::forget(Book::REDIS_BOOK_CACHE . $id);
            if (!empty($book->pic)) {
                $fileName = public_path() . '/uploads/' . $book->pic;
                if (file_exists($fileName)) {
                    unlink($fileName);
                }
            }
        } else {
            Notification::error('主数据删除失败');
        }

        return redirect()->route('admin.book.index');
    }

    /**
     * 获取检索的键值数组列表
     * @return array
     */
    private function getSchParams()
    {
        return [
            'keyword' => Request::input('keyword'),
            'cid' => Request::input('cid'),
            'priceStart' => Request::input('priceStart'),
            'priceEnd' => Request::input('priceEnd'),
        ];
    }

    /**
     * 筛选图书并分页
     * @param $schParams 搜索的表单字段
     */
    private function filterBooks($schParams)
    {
        return $books = Book::select(
            'books.*', 'b.name', 'b.created_at as b_created_at'
        )
            ->leftJoin("borrows as b", function ($leftJoin) {
                $leftJoin->on("b.book_id", "=", "books.id");
//                $leftJoin->orderBy('b.book_id', 'desc');
//                $leftJoin->limit(1);
                $leftJoin->where('b.status', '=', '0');

            })
            ->distinct()
            ->where(function ($query) use ($schParams) {
                if ($keyword = $schParams['keyword']) {
                    //相当于 where (bookname like '%$keyword%' or author = '$keyword')
                    $query->where(function ($query) use ($keyword) {
                        $query->where("books.bookname", "like", "%$keyword%")
                            ->orWhere("books.author", "=", $keyword);
                    });
                }
                if ($cid = $schParams['cid']) {
                    $query->where("books.cid", "=", $cid);
                }
                if ($priceStart = $schParams['priceStart']) {
                    $query->where("books.price", ">=", $priceStart);
                }
                if ($priceEnd = $schParams['priceEnd']) {
                    $query->where("books.price", "<=", $priceEnd);
                }
            })->orderBy('books.id', 'DESC')->paginate(10);
    }

    /**
     * 筛选图书并分页
     * @param $schParams 搜索的表单字段
     */
    private function filterBooks1($schParams)
    {
        return $books = Book::select('books.*', 'b.name', 'b.created_at')
            ->leftJoin("borrows as b", "b.book_id", "=", "books.id")
            ->where(function ($query) use ($schParams) {
                if ($keyword = $schParams['keyword']) {
                    //相当于 where (bookname like '%$keyword%' or author = '$keyword')
                    $query->where(function ($query) use ($keyword) {
                        $query->where("books.bookname", "like", "%$keyword%")
                            ->orWhere("books.author", "=", $keyword);
                    });
                }
                if ($cid = $schParams['cid']) {
                    $query->where("books.cid", "=", $cid);
                }
                if ($priceStart = $schParams['priceStart']) {
                    $query->where("books.price", ">=", $priceStart);
                }
                if ($priceEnd = $schParams['priceEnd']) {
                    $query->where("books.price", "<=", $priceEnd);
                }
            })->orderBy('books.id', 'DESC')->paginate(10);
    }
}
