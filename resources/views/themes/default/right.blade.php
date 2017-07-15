<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
    <h4 class="title">类型</h4>
    <div class="list-group">
    @foreach($topCategory as $k => $v)
      <a href="{{url('search/cate/'.$v->id)}}" class="list-group-item @if(@$cateId == $v->id) active @endif">{{$v->cate_name}}</a>
    @endforeach
  </div>

  <div class="widget">
      <h4 class="title">标签</h4>
      <div class="content tag-cloud">
          @foreach($tagList as $k => $v)
            <a href="{{url('search/tag/'.$v->id)}}" class="@if(@$tagId == $v->id) active @endif" title="{{$v->name}}">{{$v->name}}</a>
          @endforeach
      </div>
  </div>

</div><!--/.sidebar-offcanvas-->