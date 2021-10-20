@extends('layouts.app')

@section('title', ' - اتمام الطلب')

@section('content')
<div class="banner">
    <img src="{{ asset('img/services.jpg') }}" alt="about-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto my-16 px-5">
    <div class="w-full">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 my-3 rounded-full relative" role="alert">
            <strong class="font-bold">نجاح</strong>
            <span class="block sm:inline">تم تسجيل طلبك بنجاح وسيتم ارسال بريد إلكتروني يوضح لك تفاصيل الطلب وحالته</span>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>

</style>
@endsection