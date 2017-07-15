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
                图书修改
                <small>Books to modify</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">编辑图书</h3>
                        </div>
                        @if ($errors->has('error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong>
                                {{ $errors->first('error', ':message') }}
                                <br/>
                                请联系开发者！
                            </div>
                        @endif
                    <!-- /.box-header -->
                        <!-- form start -->
                        {!! Form::model($book, ['route' => ['admin.book.update', $book->id], 'method' => 'put','role'=>'form','enctype'=>'multipart/form-data']) !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">图书名称</label>
                                {!! Form::text('bookname', $book->bookname, ['id' => 'exampleInputEmail1', 'class' => 'form-control','placeholder'=>'图书名称']) !!}
                                <font color="red">{{ $errors->first('bookname') }}</font>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">所属分类</label>
                                {!! Form::select('cid', $catArr , $book->cid , ['class' => 'form-control', 'id' => 'exampleInputEmail1','placeholder'=>'所属分类']) !!}
                                <font color="red">{{ $errors->first('cid') }}</font>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">发布商</label>
                                {!! Form::text('publisher', $book->publisher, ['id' => 'exampleInputEmail1', 'class' => 'form-control','placeholder'=>'发布商']) !!}
                                <font color="red">{{ $errors->first('publisher') }}</font>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">作者</label>
                                {!! Form::text('author', $book->author, ['id' => 'exampleInputEmail1', 'class' => 'form-control','placeholder'=>'作者']) !!}
                                <font color="red">{{ $errors->first('author') }}</font>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">价格</label>
                                {!! Form::text('price', $book->price, ['id' => 'exampleInputEmail1', 'class' => 'form-control','placeholder'=>'价格']) !!}
                                <font color="red">{{ $errors->first('price') }}</font>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">推荐</label>
                                {!! Form::checkbox('recom', '1', ['class' => 'form-control', 'id' => 'exampleInputEmail1', 'placeholder'=>'推荐']) !!}
                                <font color="red">{{ $errors->first('recom') }}</font>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">标签</label>
                                <select class="form-control select2" name="tags[]" multiple="multiple" data-placeholder="{{\App\Model\Tag::getTagStringByTagIds($book->tags)}}" style="width: 100%;">
                                    @foreach($tagList as $k => $v)
                                    <option>{{$v}}</option>
                                        @endforeach
                                </select>
                                <font color="red">{{ $errors->first('tags') }}</font>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">封面图</label>
                                {!! Form::file('pic', ['class' => 'control-label', 'id'=>'exampleInputFile', 'type'=>'file']) !!}
                                <font color="red">{{ $errors->first('pic') }}</font>
                                {{--@if(!empty($book->pic))--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-sm-12 ">--}}
                                {{--<img  id="imgPic" src="{{ asset('/uploads').'/'.$book->pic }}" class="img-thumbnail" alt="" />--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--@endif--}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">内容</label>
                                @include('editor::head')
                                {!! Form::textarea('content', $book->content, ['class' => 'form-control','id'=>'myEditor']) !!}
                                <font color="red">{{ $errors->first('content') }}</font>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {!! Form::submit('修改', ['class' => 'btn btn-success']) !!}
                            {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                        </div>
                        {!! Form::close() !!}
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

<!-- jQuery 2.2.3 -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}"></script>

<script src="{{ asset("/bower_components/AdminLTE/plugins/select2/select2.full.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("/bower_components/AdminLTE/dist/js/app.min.js")}}"></script>

<script type="text/javascript">
    $(function(){
        $(".select2").select2();

    });
    $('#inputTags').tokenfield({
        autocomplete: {
            source: [<?php echo \App\Model\Tag::getTagStringAll()?>],
            delay: 100
        },
        tokens: [<?php echo \App\Model\Tag::getTagStringByTagIds($book->tags)?>],
        showAutocompleteOnFocus: !0,
        delimiter: [","]
    })
    //$('#inputTags').tokenfield('setTokens', 'blue,red,white');
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
