@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
    integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
    integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.2/plyr.css"
    integrity="sha512-jrLDXl9jUPe5DT19ukacvpX39XiErIBZxiaVMDFRe+OAKoBVYO126Dt7cvhMJ3Fja963lboD9DH+ev/2vbEnMw==" crossorigin="anonymous" />
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

    .plyr__video-wrapper.plyr__video-embed {
        padding-bottom: 56.25% !important;
    }

    #player {
        --plyr-color-main: #CABB8E;
    }
</style>
@endsection

@section('content')
<div class="h-8 bg-gray-300"></div>
@if ($data['videos']->count())
<div class="flex container m-auto my-20 gap-8 items-stretch justify-center">
    <div class="w-3/12 flex-1 invisible md:visible">
        @if ($data['adv']->where('type',0)->count())
        <a href="{{ $data['adv']->where('type',0)->first()->url }}" target="_blank">
            <img src="{{ Storage::url('/advs/0.jpg') }}" alt="{{ $data['adv']->where('type',0)->first()->title }}" class="object-cover">
        </a>
        @endif
    </div>

    <div class="w-full md:w-6/12 self-end bg-gray-600 p-5 rounded-lg">
        <div class="video shadow-xl">
            {!! MyStr::getYoutubeEmbed($data['videos']->slice(0, 1)->first()->url, 0) !!}
        </div>
        @if ($data['videos']->slice(1)->count())
        <div class="videoLibrary rounded-b-lg overflow-hidden mt-8 mx-5">
            @foreach ($data['videos'] as $item)
            <div class="rounded overflow-hidden text-center">
                <a href="{{ MyStr::getVideoSrc($item->url) }}" class="changeIt" title="{{ $item->title }}" onclick="changeIt(this.href); return false;" target="_blank">
                    {!! MyStr::getYoutubeImg($item->url) !!}
                    <p class="truncate text-xs text-white">{{ $item->title }}</p>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="w-3/12 flex-1 invisible md:visible">
        @if ($data['adv']->where('type',1)->count())
        <a href="{{ $data['adv']->where('type',1)->first()->url }}" target="_blank">
            <img src="{{ Storage::url('/advs/1.jpg') }}" alt="{{ $data['adv']->where('type',0)->first()->title }}" class="object-cover">
        </a>
        @endif
    </div>
</div>
<hr>
@endif

<div class="w-full bg-gray-300 text-center bg-cover relative h-screen">
    <div class="video-bg">
        <div class="videoOverlay"></div>
        <video autoplay muted loop id="myVideo" class="object-cover">
            <source src="{{ asset('img/index-bg.mp4') }}" type="video/mp4">
        </video>
    </div>
    <a href="{{ route('store.index') }}"
        class="translate-center px-12 py-6 bg-blue-600 text-white rounded-lg shadow-md inline-flex font-bold text-lg hover:bg-blue-500 hover:shadow active:bg-blue-900 focus:outline-none focus:shadow-outline z-40">الدخول
        للمتجر</a>
</div>

{{-- وصل حديثا --}}
<div class="container mx-auto py-16 text-center">
    <div class="w-full">
        <div class="mx-5 px-3 md:px-0">
            <div class="title flex justify-center font-bold text-gray-700 text-3xl mb-5">
                <h3 class="px-3 border-gray-400 border-r-8">وصل حديثا</h3>
            </div>

            <div class="py-5"></div>

            <div class="slick mt-5 mx-20">
                @foreach ($data['new'] as $item)
                <a href="{{ route('store.product.show', [$item->larashopCategories()->first()->id, $item->slug]) }}" class="outline-none">
                    <div class="flex flex-col items-center border border-gray-400  p-5">
                        {{ $item->defaultImageThumb->attributes(['class'=>'max-w-full mx-auto']) }}
                        <div class="text-gray-700 py-2 h-16 overflow-hidden">{{ $item->name }}</div>
                    </div>
                </a>
                @endforeach
                @foreach ($data['new'] as $item)
                <a href="{{ route('store.product.show', [$item->larashopCategories()->first()->id, $item->slug]) }}" class="outline-none">
                    <div class="flex flex-col items-center border border-gray-400  p-5">
                        {{ $item->defaultImageThumb->attributes(['class'=>'max-w-full mx-auto']) }}
                        <div class="text-gray-700 py-2 h-16 overflow-hidden">{{ $item->name }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- نهاية وصل حديثا --}}

{{-- من نحن --}}
<div class="w-full text-center">
    <div class="h-screen relative bg-cover bg-bottom bg-no-repeat py-16" style=" background-image: url('img/about-index.jpg')">
        <div class="container mx-auto">
            <div class="title flex justify-center font-bold text-gray-700 text-3xl">
                <h3 class="px-3 border-white border-r-8">من نحن</h3>
            </div>
            <div class="mt-10 mx-5 text-justify text-shadow text-lg text-gray-700" style="text-align-last:center">
                {{ @$data['about']->about }}
            </div>
        </div>
    </div>
</div>
{{-- نهاية من نحن --}}


{{-- شركائنا --}}
<div class="w-full text-center">
    <div class="relative py-16">
        <div class="container mx-auto">
            <div class="title flex justify-center font-bold text-gray-700 text-3xl">
                <h3 class="px-3 border-gray-400 border-r-8">شركائنا</h3>
            </div>
            <div class="mt-10 mx-5 text-center text-shadow text-lg text-gray-700" style="text-align-last:center">
                <div class="grid grid-cols-2 md:grid-cols-4 text-center gap-32">
                    @foreach ($data['brands'] as $item)
                    <div class="flex flex-col justify-end mt-5">
                        <div class="img">
                            <img src="{{ Storage::url($item->logo) }}" alt="{{ $item->name }}" class="mx-auto max-w-full">
                        </div>
                        <div class="text-center">
                            {{ $item->name }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
{{-- نهاية شركائنا --}}

@if ($data['reviews']->count())
<div class="w-full bg-gray-100">
    <div class="py-16">
        <div class="container mx-auto px-3 md:px-0">
            <div class="title flex justify-center font-bold text-gray-700 text-3xl">
                <h3 class="px-3">قالوا عنا</h3>
            </div>
            <div class="mt-10 mx-5 text-shadow text-lg text-gray-700 text-center">
                {{ $data['reviewsTotal'] }} تقييم على جوجل
                <p class="flex justify-center items-center mt-3">
                    @for ($i = 1; $i <= 5; $i++) <svg class="mx-1 w-4 h-4 fill-current {{ $i <= $data['avgRating'] ? 'text-yellow-500' : 'text-gray-300' }}"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                        @endfor
                </p>
            </div>
            <div class="mt-5">
                <div class="slick flex mx-20">
                    @foreach ($data['reviews'] as $item)
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

{{-- شركائنا --}}
<div class="w-full bg-yuma-100 pb-16">
    <div class="relative py-16">
        <div class="container mx-auto">
            <div class="title flex justify-center font-bold text-gray-700 text-3xl">
                <h3 class="px-3">عملائنا</h3>
            </div>
            <div class="mt-10 mx-5 text-shadow text-lg text-gray-700">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach ($data['clients'] as $item)
                    <div class="flex items-center select-none">
                        <span class="ml-2"><img src="{{ asset('img/left-caret.png') }}" alt="caret"> </span>{{ @$item->name }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
{{-- نهاية شركائنا --}}
{{-- <div class="py-16">
    <div class="container mx-auto px-3 md:px-0">
        <div class="flex gap-8">
            <div class="twitter w-3/4">
                <a class="twitter-timeline" data-lang="ar" data-height="300" data-theme="light" style="width: 100%" href="https://twitter.com/anamelcctv?ref_src=twsrc%5Etfw">Tweets
                    by anamelcctv</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="vists w-1/4 text-center flex flex-col justify-around items-center">
                <h3 class="text-2xl">الزيارات</h3>
                <div>
                    <img src="/img/vision.png" alt="vision" class="mx-auto">
                    <p class="text-xl">{{ $data['visits'] }}</p>
</div>
</div>
</div>
</div>
</div> --}}

<div class="w-full aspect-16x9">
    <iframe class="iframe"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.989400224896!2d46.863214415001494!3d24.795816484084398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2fab559c214bef%3A0x149701e80d0a11ee!2z2KPZhtin2YXZhCDYp9mE2K7YqNix2Kkg2YTZhNij2YbYuNmF2Kkg2KfZhNij2YXZhtmK2Kkg2KfZhNmF2KrZg9in2YXZhNip!5e0!3m2!1sen!2seg!4v1594813253260!5m2!1sen!2seg"
        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.2/plyr.min.js"
    integrity="sha512-5HcOw3x/g3GAUpNNyvKYB2/f8ivVNBVebdqCxz3Mmdftx7vXOdbYvonB2Det6RVcA1IDxYeYWTAzxRg+c6uvYQ==" crossorigin="anonymous"></script>

<script>
    let player = new Plyr('#player');

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

    $('.videoLibrary').slick({
        rtl: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 5000,
    });


    function changeIt(src) {
        player.destroy();
        $('.video iframe').attr('src', src);
        player = new Plyr('#player');
        player.play();
    }
</script>
@endsection