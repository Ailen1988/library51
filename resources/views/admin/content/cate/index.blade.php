@extends('admin.app')

<!-- Main Header -->
@include('admin.header')

<!-- Left side column. contains the logo and sidebar -->
@include('admin.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            分类管理
            <small>Systematic management</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="panel panel-default">
                        <div class="box-header">
                            <h3 class="box-title">分类管理</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right"
                                           placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-success" href="{{ URL::route('admin.cate.create')}}">创建分类</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>分类名称</th>
                                    <th>创建时间</th>
                                    <th class="text-right">操作</th>
                                </tr>
                                @foreach($cate as $k=> $v)
                                    <tr>
                                        <th scope="row">{{ $v->id }}</th>
                                        <td>{{ $v->html}} {{ $v->cate_name }}</td>
                                        <td>{{ $v->created_at }}</td>
                                        <td class="text-right">


                                            <div class="btn-group">
                                                {!! Form::open([
                                                'route' => array('admin.cate.destroy', $v->id),
                                                'method' => 'delete',
                                                'class'=>'btn_form btn ',
                                                'onsubmit'=>"return confirm('确定删除吗？')"
                                                ]) !!}

                                                <button type="submit" class="btn btn-danger">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                    删除
                                                </button>

                                                {!! Form::close() !!}

                                                {!! Form::open([
                                                    'route' => array('admin.cate.edit', $v->id),
                                                    'method' => 'get',
                                                    'class'=>'btn_form btn '
                                                ]) !!}

                                                <button type="submit" class="btn btn-info">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                    修改
                                                </button>
                                                {!! Form::close() !!}
                                            </div>

                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
@include('admin.footer')

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<div class="container ">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="modal fade " id="modal-container-507127" role="dialog" aria-labelledby="myModalLabel"
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
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input type="text" name="name" class="form-control" placeholder="员工姓名"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input type="text" name="number" class="form-control" placeholder="员工Id"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button autocomplete="off" data-error-text="出错了!" data-complete-text="借出完成"
                                        data-exists-text="存在借书记录" data-loading-text="执行..." id="check-borrow-btn"
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
<!-- AdminLTE App -->
<script src="{{ asset("/bower_components/AdminLTE/dist/js/app.min.js")}}"></script>
<script>
    $(function () {
        $(".borrow-btn").click(function () {
            var bookObj = $(this).parents('tr');
            $("#input-book-id").val(bookObj.find('.book-id').attr('data-book-id'));
            $("#modal-bookname").text(bookObj.find('.bookname').text());
            $("#modal-book-pic").attr('src', bookObj.find('.book-pic').children("img").attr('src'));
            $('#check-borrow-btn').button('reset');
            $("#modal-container-507127").modal();
        });

        $('#modal-container-507127').on('hidden.bs.modal', function (e) {
            $(".borrow-form")[0].reset();
        })

        $('#check-borrow-btn').bind('click', function () {
            var $this = $(this);
            var $btn = $this.button('loading');
            $.ajax({
                type: 'POST',
                url: "{{URL::route('admin.borrow.store')}}",
                data: $('.borrow-form').serialize(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function () {
                },
                success: function (d) {
                    if (d == 1) {
                        $btn.button("complete");
                    } else if (d == 2) {
                        $btn.button("exists");
                    } else {
                        $btn.button("error");
                    }
                },
                error: function (xhr, type) {
                    $btn.button("error");
                },
                complete: function (xhr, ts) {
                }
            });
        })
    });
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
