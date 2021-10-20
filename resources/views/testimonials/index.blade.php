@extends('layouts.app')

@section('title', ' - قالوا عنا')

@section('content')
<div class="banner">
    <img src="{{ asset('img/testimonials.jpg') }}" alt="testimonials-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto mb-16 px-5">
    {{-- @livewire('testimonial') --}}
    @if ($reviews->count())
    <div class="w-full">
        <div class="py-16">
            <div class="container mx-auto px-3 md:px-0">
                <div class="title flex justify-center font-bold text-gray-700 text-3xl">
                    <h3 class="px-3">قالوا عنا</h3>
                </div>
                <div class="mt-10 mx-5 text-shadow text-lg text-gray-700 text-center">
                    {{ $reviewsTotal }} تقييم على جوجل
                    <p class="flex justify-center items-center mt-3">
                        @for ($i = 1; $i <= 5; $i++) <svg class="mx-1 w-4 h-4 fill-current {{ $i <= $avgRating ? 'text-yellow-500' : 'text-gray-300' }}"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                            </svg>
                            @endfor
                    </p>
                </div>
                <div class="mt-5">
                    <div class="slick flex mx-20">
                        @foreach ($reviews as $item)
                        <!-- component -->
                        <!-- post card -->
                        <div class="bg-white  rounded-lg focus:outline-none border  shadow-inner">
                            <!--horizantil margin is just for display-->
                            <div class="flex flex-col items-start px-4 py-6">
                                <img class="w-12 h-12 rounded-full object-cover mr-4 shadow self-center" src="{{ $item->profile_photo_url }}" alt="avatar">
                                <div class="">
                                    <div class="flex items-center justify-center">
                                        <h2 class="text-lg font-semibold text-gray-900 ">{{ $item->author_name }} </h2>
                                    </div>
                                    <p class="flex justify-center items-center my-3">
                                        @for ($i = 1; $i <= 5; $i++) <svg class="mx-1 w-4 h-4 fill-current {{ $i <= $item->rating ? 'text-yellow-500' : 'text-gray-300' }}"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                            @endfor
                                    </p>
                                    <p class="mt-3 text-gray-700 text-sm">
                                        {!! nl2br($item->text) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
    integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
    integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" />
<style>
    .video-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .videoOverlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #363636;
        opacity: 0.7;
        z-index: 30;
    }

    #myVideo {
        min-height: 100%;
        min-width: 100%;
        display: block;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    /* the slides */
    .slick-slide {
        margin: 0 2rem;
    }

    /* the parent */
    .slick-list {
        margin: 0 -2rem;
    }

    .slick-track {
        display: flex !important;
    }

    .slick-slide {
        height: inherit !important;
    }

    .prev,
    .next {
        top: 50%;
    }

    .prev {
        right: -3rem;
    }

    .next {
        left: -3rem;
    }
</style>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>

<script>
    $('.slick').slick({
        rtl: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 5000,
        prevArrow:`<button type='button' class='prev text-gray-600 absolute h-8 w-8 z-30 focus:outline-none'>
            <svg class="fill-current text-gray-600" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M238.933,0C106.974,0,0,106.974,0,238.933s106.974,238.933,238.933,238.933s238.933-106.974,238.933-238.933
                            S370.893,0,238.933,0z M354.009,250.356c-0.397,0.441-0.817,0.861-1.258,1.258l-170.667,153.6
                            c-7.128,6.167-17.906,5.389-24.073-1.739c-5.996-6.93-5.449-17.357,1.238-23.622l156.57-140.919L159.249,98.014
                            c-6.879-6.444-7.231-17.244-0.787-24.123c6.265-6.687,16.693-7.234,23.622-1.238l170.667,153.6
                            C359.754,232.561,360.317,243.353,354.009,250.356z"/>
                    </g>
                </g>
            </svg>
            </button>`,
        nextArrow:`<button type='button' class='next text-gray-600 h-8 w-8 absolute z-30 focus:outline-none'>
            <svg class="fill-current text-gray-600" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M238.933,0C106.974,0,0,106.974,0,238.933s106.974,238.933,238.933,238.933s238.933-106.974,238.933-238.933
                            S370.893,0,238.933,0z M320.357,403.926c-6.167,7.128-16.945,7.907-24.073,1.739c-0.17-0.147-0.337-0.298-0.501-0.451
                            l-170.667-153.6c-7.003-6.309-7.566-17.1-1.258-24.103c0.397-0.441,0.817-0.861,1.258-1.258l170.667-153.6
                            c6.879-6.444,17.679-6.092,24.123,0.787c6.444,6.879,6.092,17.679-0.787,24.123c-0.164,0.154-0.331,0.304-0.501,0.451
                            L162.133,238.933l156.484,140.919C325.746,386.02,326.524,396.798,320.357,403.926z"/>
                    </g>
                </g>
            </svg>
            </button>`,
            responsive: [
            {
            breakpoint: 640,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
            }
            },
            {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                arrows: false,
                dots: true,
            }
            },
        ]
    });
</script>
@endsection