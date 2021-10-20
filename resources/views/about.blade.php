@extends('layouts.app')

@section('title', ' - من نحن')

@section('content')
<div class="banner">
    <img src="{{ asset('img/about.jpg') }}" alt="about-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto my-16 px-5">
    <div class="flex md:items-center">
        <div class="w-2/12 ml-3 md:ml-0">
            <img src="{{ asset('img/quill.png') }}" alt="quill">
        </div>
        <div class="w-10/12">
            <h3 class="text-3xl font-bold text-blue-900">نبذة تعريفية:</h3>
            <div class="text-justify">
                {{ @$about->about }}
            </div>
        </div>
    </div>
    <hr class="mx-16 my-24">
    <div class="grid grid-cols-3 gap-16">
        <div class="text-center">
            <img src="{{ asset('img/vision.png') }}" alt="vision" class="mx-auto">
            <h3 class="text-3xl font-bold text-blue-900">رؤيتنا:</h3>
            <p>{{ @$about->vision }}</p>
        </div>
        <div class="text-center">
            <img src="{{ asset('img/mission.png') }}" alt="mission" class="mx-auto">
            <h3 class="text-3xl font-bold text-blue-900">رسالتنا:</h3>
            <p>{{ @$about->mession }}</p>
        </div>
        <div class="text-center">
            <img src="{{ asset('img/maner.png') }}" alt="maner" class="mx-auto">
            <h3 class="text-3xl font-bold text-blue-900">قيمنا:</h3>
            <p>{{ @$about->maner }}</p>
        </div>
    </div>
    <hr class="mx-16 my-24">
    <div class="flex">
        <div class="w-2/12 ml-3 md:ml-0">
            <img src="{{ asset('img/target.png') }}" alt="qoals">
        </div>
        <div class="w-10/12">
            <h3 class="text-3xl font-bold text-blue-900">اهدافنا:</h3>
            <div class="text-justify list-disc">
                {!! @$about->goals !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>

</style>
@endsection