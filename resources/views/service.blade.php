@extends('layouts.app')

@section('title', ' - مجالاتنا')

@section('content')
<div class="banner">
    <img src="{{ asset('img/services.jpg') }}" alt="about-banner" class="w-full object-cover select-none">
</div>


<div class="container m-8 p-4 mx-auto bg-gray-300 text-gray-700">
    <h1 class="text-xl font-bold ">{{ $service->name }}</h1>
</div>

<div class="container mx-auto my-16 px-5">
    <div class="flex md:items-center">
        <div class="w-10/12">
            <h3 class="text-xl font-bold text-blue-900">تعريف ب{{ $service->name }}:</h3>
            <div class="text-justify md:mr-16">
                {!! @$service->definition !!}
            </div>
        </div>
    </div>

    <div class="flex md:items-center my-20">
        <div class="w-10/12">
            <h3 class="text-xl font-bold text-blue-900">مجالات استخدام {{ $service->name }}</h3>
            <div class="text-justify md:mr-16">
                {!! @$service->usage !!}
            </div>
        </div>
    </div>

    <div class="flex md:items-center">
        <div class="w-10/12">
            <h3 class="text-xl font-bold text-blue-900">صور من منتجات {{ $service->name }}</h3>
        </div>
    </div>
    <div class="grid md:grid-cols-3">
        @foreach ($service->getMedia('images') as $item)
        <div class="text-center my-8 ">
            <h3 class="text-xl font-bold text-gray-600 my-5">{{ $item->name }}</h3>
            {{ $item }}
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('style')

@endsection