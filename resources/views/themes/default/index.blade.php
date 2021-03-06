@extends('themes.default.layouts')

@section('content')
    <div class="container">
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-xs-12 col-sm-9">
                <p class="pull-right visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                </p>
                <div class="row">
                    @foreach($bookList['data'] as $k => $v)
                        <div class=" col-xs-6 col-lg-4">
                            <div class="thumbnail col-xs-12">
                                <div class="col-xs-12 borrow" title="{{$v->bookname}}">
                                    {{--<tr>--}}

                                    <h2 class=" text-overflow bookname">{{strCut($v->bookname,10)}}</h2>
                                    <h4 class="text-overflow">作者：{{strCut($v->author, 5)}}</h4>
                                    @if($v->name && $v->status == 0)
                                        <h5 class="text-overflow">借阅人：<font
                                                    color="#D81B60">{{strCut($v->name, 5)}}</font></h5>
                                    @else
                                        <h5 class="text-overflow">借阅人：可借阅</h5>
                                    @endif
                                    <p class="book-pic">
                                        <a href="{{url('book/'.$v->id)}}">

                                            <img class="" width="130" height="130" src="{{asset('/uploads/'.$v->pic)}}"
                                                 alt=""/>
                                        </a>
                                    </p>
                                    <div>
                                        <div style="width: 50%">

                                        </div>
                                        <div align="right">
                                            {!! Form::open([
                                                'route' => array('admin.book.destroy', $v->id),
                                                'method' => 'delete',
                                                'class'=>'btn_form',
                                                'data-book-id'=>$v->id,
                                                'bookname'=>$v->bookname,
                                                'bookpic'=>asset('/uploads/'.$v->pic)
                                            ]) !!}
                                            <button role="button" data-toggle="modal" type="button"
                                                    class="btn btn-default borrow-btn"
                                                    @if($v->name)
                                                    disabled
                                                    @endif
                                            >
                                                <span aria-hidden="true"></span>
                                                跪求
                                            </button>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                    <p>
                                    </p>
                                    {{--</tr>--}}
                                </div>
                            </div>
                        </div><!--/.col-xs-6.col-lg-4-->
                    @endforeach
                </div><!--/row-->
            </div><!--/.col-xs-12.col-sm-9-->
            @include('themes.default.right')

        </div><!--/row-->

        <div class="pagination text-align">
            <nav>
                {!! $bookList['page']->render($page) !!}
            </nav>
        </div><!-- /pagination -->
    </div><!--/.container-->

    {{--<ul>--}}
    {{--<li><a id="demo01" href="#animatedModal">DEMO01</a></li>--}}
    {{--<li><a id="demo02" href="#modal-02">DEMO02</a></li>--}}
    {{--</ul>--}}
    {{--<!--DEMO01-->--}}
    {{--<div id="animatedModal">--}}
    {{--<!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID -->--}}
    {{--<div  id="btn-close-modal" class="close-animatedModal">--}}
    {{--CLOSE MODAL--}}
    {{--</div>--}}

    {{--<div class="modal-content">--}}
    {{--<!--Your modal content goes here-->--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<!--DEMO02-->--}}
    {{--<div id="modal-02">--}}
    {{--<!--"THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID-->--}}
    {{--<div  id="btn-close-modal" class="close-modal-02">--}}
    {{--CLOSE MODAL--}}
    {{--</div>--}}

    {{--<div class="modal-content">--}}
    {{--<!--Your modal content goes here-->--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- REQUIRED JS SCRIPTS -->
    <div class="container ">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <div class="modal fade " id="modal-container-borrow" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" class="borrow-form form-horizontal">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        <b>输入借书人信息</b>
                                    </h4>
                                </div>
                                <div class="modal-header">
                                    <h4 class="modal-title">
                                        <div>正在借出的图书：<span id="modal-bookname"></span></div>
                                    </h4>
                                    <h3 class="thumbnail">
                                        <img id="modal-book-pic" class="" width="80" src="" alt=""/>
                                    </h3>
                                </div>
                                <div class="modal-body">
                                    <form action="" class="form-horizontal">
                                        <input type="hidden" name="book_id" id="input-book-id" value=""/>
                                        <input type="hidden" name="bookname" id="input-bookname" value=""/>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input type="text" name="name" class="form-control" placeholder="员工姓名"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-close" data-dismiss="modal">关闭
                                    </button>
                                    <button autocomplete="off" data-error-text="出错了!" data-complete-text="赏了"
                                            data-limit-text="每人最多赏赐两本" data-exists-text="你来晚了" data-loading-text="执行中.."
                                            id="check-borrow-btn"
                                            type="button" class="btn btn-primary demo01">确定借出
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery 2.2.3 -->
    <script src="{{ asset("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}"></script>


    <script>
        $(function () {
            $(".borrow-btn").click(function () {
                var bookObj = $(this).parents('form');
                var bookid = bookObj.attr('data-book-id');
                var bookname = bookObj.attr('bookname');
                var bookpic = bookObj.attr('bookpic');

                $("#input-book-id").val(bookid);
                $("#modal-bookname").text(bookname);
                $("#input-bookname").val(bookname);
                $("#modal-book-pic").attr('src', bookpic);
                $('#check-borrow-btn').button('reset');
                $("#modal-container-borrow").modal();
            });

            $('#modal-container-borrow').on('hidden.bs.modal', function (e) {
                $(".borrow-form")[0].reset();
            })

            $('#check-borrow-btn').bind('click', function () {
                var $this = $(this);
                var $btn = $this.button('loading');
                $.ajax({
                    type: 'POST',
                    url: "{{URL::route('borrow.store')}}",
                    data: $('.borrow-form').serialize(),
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function () {
                    },
                    success: function (d) {

                        if (d.code == 1) {
                            alert(d.msg);
                            $btn.button("complete");
//                            $("#demo01").animatedModal();
                        } else if (d.code == 2) {
                            alert(d.msg);
                            $btn.button("exists");
                        } else if (d.code == 3) {
                            alert(d.msg);
                            $btn.button("limit");
                        } else {
                            alert(d.msg);
                            $btn.button("error");
                        }
                        location.reload(true);
                    },
                    error: function (xhr, type) {
                        $btn.button("error");
                    },
                    complete: function (xhr, ts) {
                    }


                });

//                window.location.reload();
            })

            // 刷新
            $('.btn-close').click(function () {
                window.location.reload();
            })
        });
    </script>

@endsection
