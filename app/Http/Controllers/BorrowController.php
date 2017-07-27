<?php

namespace App\Http\Controllers;

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
                    'msg' => '你现已借阅［' . $request->input('bookname') . '］，可到908休闲区书架上领取，记得一个月内归还哦'
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
}

