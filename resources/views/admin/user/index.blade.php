@extends('admin.content.common')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            内容管理
            <small>content management</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    {!! Notification::showAll() !!}
                    <div class="panel-heading">内容管理</div>

                    <div class="panel-body">
                        <a class="btn btn-success" href="{{ URL::route('admin.user.create')}}">创建用户</a>

                        <table class="table table-hover table-top">
                            <tr>
                                <th>#</th>
                                <th>姓名</th>
                                <th>邮箱</th>
                                <th>创建时间</th>
                                <th class="text-right">操作</th>
                            </tr>

                            @foreach($users as $k=> $v)
                                <tr>
                                    <th scope="row">{{ $v->id }}</th>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->email }}</td>
                                    <td>{{ $v->created_at }}</td>
                                    <td class="text-right">


                                        <div class="btn-group">
                                        {!! Form::open([
                                        'route' => array('admin.user.destroy', $v->id),
                                        'method' => 'delete',
                                        'class'=>'btn_form btn '
                                        ]) !!}

                                        <button type="submit" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            删除
                                        </button>

                                        {!! Form::close() !!}

                                        {!! Form::open([
                                            'route' => array('admin.user.edit', $v->id),
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
                    {!! $users->render() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
