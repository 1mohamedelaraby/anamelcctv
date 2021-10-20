@extends('layouts.app')

@section('title', ' - جديدنا - '. $news->title)

@section('content')
<div class="banner">
    <img src="{{ asset('img/services.jpg') }}" alt="about-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto my-16 px-5">
    <div class="flex content-center flex-wrap">
        <div class="w-full md:w-8/12">
            <h1 class="text-3xl text-gray-700 font-bold">{{ $news->title }}</h1>
            {{ $news->getFirstMedia('image')()->lazy()->attributes(['class' => 'mx-auto my-16']) }}
            <div class="text-justify">
                {!! $news->body !!}
            </div>
        </div>
        <div class="w-full md:w-4/12">
            @include('news.side')
        </div>
    </div>
</div>
@endsection