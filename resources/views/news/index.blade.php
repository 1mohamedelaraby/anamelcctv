@extends('layouts.app')

@section('title', ' - جديدنا')

@section('content')
<div class="banner">
    <img src="{{ asset('img/services.jpg') }}" alt="about-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto my-16 px-5">
    <div class="flex content-center mb-16">
        <div class="flex w-full md:w-8/12 items-end justify-between bg-contain bg-center px-8 mx-8 py-4 bg-no-repeat shadow"
            style="background-image: url('{{ $featured ? $featured->getFirstMediaUrl('image') : '' }}'); min-height:300px">
            @if ($featured)
            <h1 class="text-lg text-white bg-gray-900 bg-opacity-50 px-2 py-4">{{ @$featured->title }}</h1>
            <a href="{{ route('news.show', @$featured->slug) }}" class="px-6 py-2 rounded bg-blue-900 text-white">أقراء المزيد</a>
            @endif
        </div>
        <div class="w-full md:w-4/12 hidden md:flex">
            @include('news.side')
        </div>
    </div>
    <div class="flex content-center flex-wrap">
        @foreach ($news as $item)
        <div class="flex w-1/2 md:w-1/4 p-2 ">
            <div class="bg-gray-100 overflow-hidden border-b-4 border-blue-900 shadow hover:shadow-xl text-gray-700">
                <a href="{{ route('news.show', $item->slug) }}">
                    {{ $item->media->first()('thumb')->attributes(['class' => 'w-full object-cover h-32 sm:h-48 md:h-64']) }}
                    <div class="p-4 md:p-6">
                        <h3 class="font-semibold mb-2 text-xl leading-tight sm:leading-normal hover:text-blue-900">{{ $item->title }}</h3>
                        <div class="text-sm flex items-center">
                            <svg class="opacity-75 ml-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                width="12" height="12" viewBox="0 0 97.16 97.16" style="enable-background:new 0 0 97.16 97.16;" xml:space="preserve">
                                <path
                                    d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823    c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z" />
                                <path
                                    d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832    c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z" />
                            </svg>
                            <p class="leading-none">{{ $item->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    {{ $news->links() }}
</div>
@endsection