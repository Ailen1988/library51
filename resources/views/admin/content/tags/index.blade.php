@extends('admin.content.common')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            标签管理
            <small>label management</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    {!! Notification::showAll() !!}
                    <div class="panel-heading">标签管理</div>

                    <div class="panel-body">
                        <a class="btn btn-success" href="{{ URL::route('admin.tags.create')}}">创建标签</a>

                        <table class="table table-hover table-top">
                            <tr>
                                <th>#</th>
                                <th>标签名</th>
                                <th>引用次数</th>
                                <th class="text-right">操作</th>
                            </tr>

                            @foreach($tags as $k=> $v)
                                <tr>
                                    <th scope="row">{{ $v->id }}</th>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->number }}</td>
                                    <td class="text-right">


                                        <div class="btn-group">
                                            {!! Form::open([
                                            'route' => array('admin.tags.destroy', $v->id),
                                            'method' => 'delete',
                                            'class'=>'btn_form btn '
                                            ]) !!}

                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('确定删除该标签吗？')">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                删除
                                            </button>

                                            {!! Form::close() !!}

                                            {!! Form::open([
                                                'route' => array('admin.tags.edit', $v->id),
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
                    {!! $tags->render() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
