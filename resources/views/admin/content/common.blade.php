@extends('admin.app')

<!-- Main Header -->
@include('admin.header')

<!-- Left side column. contains the logo and sidebar -->
@include('admin.sidebar')

@section('modules')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @yield('content')

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.footer')

@endsection


