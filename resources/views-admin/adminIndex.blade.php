@extends('multiauth::adminLayouts.app')
@section('title', 'الرئيسة')
@section('breadcrumb')
<a class="breadcrumb-item" href="/admin">أنامل الخبرة</a>
<span class="breadcrumb-item active">لوحة التحكم</span>
@endsection

@section('pagetitle','لوحة التحكم')

@section('css')
<style>
    .card-body {
        overflow: hidden;
    }
</style>
@endsection

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="container-fluid">

</div>
@endsection

@section('script')

@endsection