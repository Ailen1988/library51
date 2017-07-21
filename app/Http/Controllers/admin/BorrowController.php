<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Borrow;
use Auth, Notification, Input;
use App\Model\Tag;
use App\Model\Book;
use App\Model\Category;
use Cache;

class BorrowController extends Controller
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
        $schParams = $this->getSchParams();
        $borrows = $this->filterBorrow($schParams);

        return adminView("index", ['borrows' => $borrows, 'schParams' => $schParams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (empty($name = $request->input('name')) || empty($bookId = $request->input('book_id'))) {
            die(json_encode(
                [
                    'code' => 1,
                    'msg' => '数据出错, 请重新尝试!'
                ])
            );
        }

        // 限制每个用户只能借阅一次
        if (2 <= Borrow::where('name', '=', $name)
                ->where('status', '=', '0')
                ->count()
        ) {
            die(json_encode(
                [
                    'code' => 3,
                    'msg' => '每人最多借阅2本'
                ])
            );
        }

        //判断是否借出
        if (Borrow::where("status", "=", 0)
            ->where("book_id", "=", $bookId)
            ->first()
        ) {
            die(json_encode(
                [
                    'code' => 2,
                    'msg' => '书本已借出'
                ])
            );
        }
        if (Borrow::create($request->all())) {
            die(json_encode(
                [
                    'code' => 1,
                    'msg' => '你现已借阅'.$name.'书，可到908休闲区书架上领取，记得一个月内归还哦'
                ])
            );
        } else {
            die(json_encode(
                [
                    'code' => 0,
                    'msg' => '出错了!'
                ])
            );
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 设置借书状态为已归还
     *
     */
    public function bookReturn($borrowId)
    {
        if (Borrow::returnBook($borrowId)) {
            Notification::success('还书成功');
        } else {
            Notification::error('还书失败');
        }
        return back();
    }


    /**
     * 获取检索的键值数组列表
     * @return array
     */
    private function getSchParams()
    {
        return [
            'keyword' => Input::get('keyword'),
            'name_or_number' => Input::get('name_or_number'),
        ];
    }

    /**
     * 筛选并分页
     * @param $schParams 搜索的表单字段
     */
    private function filterBorrow($schParams)
    {
        return Borrow::select("borrows.*", "b.id as b_id", "b.bookname", "b.author")
            ->leftJoin("books as b", "borrows.book_id", "=", "b.id")
            ->where(function ($query) use ($schParams) {
                if ($keyword = $schParams["keyword"]) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where("b.bookname", "like", "%$keyword%")
                            ->orWhere("b.author", "=", $keyword);
                    });
                }

                if ($name_or_number = $schParams["name_or_number"]) {
                    $query->where(function ($query) use ($name_or_number) {
                        $query->where("borrows.name", "=", $name_or_number);
                    });
                }
            })->orderBy("borrows.id", "DESC")->paginate(10);
    }

    private function getBorrowInfoByBookId($bookId)
    {
        return Borrow::where('book_id', '=', $bookId)
            ->find(['name', 'created_at']);
    }
}
