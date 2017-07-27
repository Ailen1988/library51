@extends('themes.default.layouts')

@section('header')
    <title>{{env('BOOKMG_NAME')}}</title>
    <meta name="keywords" content="{{ systemConfig('seo_key') }}" />
    <meta name="description" content="{{ systemConfig('seo_desc') }}">
@endsection

@section('content')
<div class="container">
  <div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
      <p class="pull-right visible-xs">
        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
      </p>
      <div class="jumbotron">
        <h2>类别：{{ $cateName }}</h2>

      </div>
      <div class="row">
        @foreach($bookList['data'] as $k => $v)
          <div class=" col-xs-6 col-lg-4">
            <div class="thumbnail col-xs-12">
              <div class="col-xs-12 borrow">
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
                            class="btn btn-default borrow-btn">
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
                <button type="button" class="btn btn-default btn-close" data-dismiss="modal">关闭</button>
                <button autocomplete="off" data-error-text="出错了!" data-complete-text="赏了"
                        data-limit-text="每人最多赏赐两本" data-exists-text="你来晚了" data-loading-text="执行中.." id="check-borrow-btn"
                        type="button" class="btn btn-primary">确定借出
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
            $("#input-bookname").val(bookname);
            $("#modal-bookname").text(bookname);
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
//                            $btn.button("complete");
                        alert(d.msg);
//                            $("#demo01").animatedModal();
                    } else if (d.code == 2) {
                        alert(d.msg);
//                            $btn.button("exists");
                    } else if (d.code == 3) {
                        alert(d.msg);
//                            $btn.button("limit");
                    } else {
                        alert(d.msg);
//                            $btn.button("error");
                    }
                },
                error: function (xhr, type) {
//                    alert(d.msg);
                        $btn.button("error");
                },
                complete: function (xhr, ts) {
                }
            });
            location.reload(true);
//            window.location.reload();
        })

        // 刷新
        $('.btn-close').click(function () {
            window.location.reload();
        })
    });
</script>
@endsection
