@extends('multiauth::adminLayouts.app')
@section('title', 'تعديل كوبون')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">تعديل كوبون</span>
@endsection

@section('pagetitle','تعديل كوبون')

@section('content')
<div class="container-fluid">
    @livewire('coupon', ['coupon' => $coupon])
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