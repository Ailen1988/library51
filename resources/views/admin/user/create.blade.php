@extends('admin.content.common')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            创建管理员
            <small>To create an administrator</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">创建用户</div>

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

                    <div class="panel-body">
                        {!! Form::open(['route' => 'admin.user.store', 'method' => 'post','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}


                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-3">
                                {!! Form::text('name', '', ['class' => 'form-control','placeholder'=>'Username']) !!}
                                <font color="red">{{ $errors->first('name') }}</font>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-3">
                                {!! Form::text('email', '', ['class' => 'form-control','placeholder'=>'Email']) !!}
                                <font color="red">{{ $errors->first('email') }}</font>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-3">
                                {!! Form::text('password', '', ['class' => 'form-control','placeholder'=>'Password']) !!}
                                <font color="red">{{ $errors->first('password') }}</font>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">头像</label>
                            <div class="col-sm-3">
                                {!! Form::file('photo') !!}
                                <font color="red">{{ $errors->first('photo') }}</font>
                            </div>
                        </div>

                        {!! Form::hidden('desc', '', ['class' => 'form-control','id'=>'myEditor']) !!}

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                {!! Form::submit('创建', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
