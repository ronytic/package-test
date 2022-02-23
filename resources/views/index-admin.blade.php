<!-- Add TopNav -->
@extends('layouts.layout')
@section('title') Package Test Title @endsection
@section('breadcrumbs')
@include('shared.breadcrumbs', ['routes' => [
__('Admin') => route('admin.index'),
'Package Test...' => null,
]])
@endsection
<!-- Add Sidebar Menu -->
@section('sidebar')
    @include('layouts.sidebar', ['sidebar'=> Menu::get('sidebar_admin')])
@endsection
<!-- Styles optional -->
@section('css')
    <link rel="stylesheet" href="{{mix('/css/package.css', 'vendor/processmaker/packages/package-test')}}">
@endsection
<!-- Content -->
@section('content')
    <div class="container page-content" id="app-package-test-admin">
        <!-- Component Vue -->
        <adminterface></adminterface>
    </div>
@endsection
<!-- Scripts required -->
@section('js')
<script src="{{mix('/js/my-script.js', 'vendor/processmaker/packages/package-test')}}"></script>
@endsection