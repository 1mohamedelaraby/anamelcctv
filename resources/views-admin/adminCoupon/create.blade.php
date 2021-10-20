@extends('multiauth::adminLayouts.app')
@section('title', 'اضافة كوبون')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">اضافة كوبون</span>
@endsection

@section('pagetitle','اضافة كوبون')

@section('content')
<div class="container-fluid">
    @livewire('coupon', ['coupon' => null])
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@livewireStyles
@endsection

@section('script')
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@stack('js')
@endsection