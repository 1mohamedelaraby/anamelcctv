@extends('layouts.app')

@section('title', $larashopProduct->name)

@section('content')
<div class="banner">
    <img src="{{ asset('img/services.jpg') }}" alt="about-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto my-16 px-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="">
            <div class="main">
                <div x-data="{ total: {{ $larashopProduct->getMedia('images')->count() + 1 }}, current: 0, open: true }">
                    <div x-show="open" class="item-img flex items-center justify-center p-4 border-gray-400 border">
                        {{ $larashopProduct->getFirstMedia('main')('medium')->lazy()->attributes(['class' => 'mx-auto', 'x-show'=>"current == 0"]) }}
                        @if ($larashopProduct->getMedia('images')->count())

                        @foreach ($larashopProduct->getMedia('images') as $item)
                        {{ $item('medium')->lazy()->attributes(['class' => 'mx-auto', 'x-show'=>"current == $loop->iteration"]) }}
                        @endforeach
                        @endif
                    </div>
                    <div class="flex flex-wrap justify-center items-center gap-4 mt-4 relative select-none">
                        <div class="thumb p-2 border border-gray-400  w-16 min-w-16 h-16 flex items-center cursor-pointer" @click="current = 0, open=true"
                            :class="current == 0? 'border-yuma-400' : ''">
                            {{ $larashopProduct->getFirstMedia('main')('thumb')->lazy()->attributes(['class' => '', 'width' => '50']) }}
                        </div>
                        @if ($larashopProduct->getMedia('images')->count())

                        @foreach ($larashopProduct->getMedia('images') as $item)
                        <div class="thumb p-2 border border-gray-400 w-16 h-16 flex items-center cursor-pointer" @click="current = {{ $loop->iteration }}, open=true"
                            :class="current == {{ $loop->iteration }}? 'border-yuma-400' : ''">
                            {{ $item('thumb')->lazy()->attributes(['class' => '', 'width' => '50']) }}
                        </div>
                        @endforeach

                        @endif
                    </div>
                </div>
            </div>

            <div class="addthis_inline_share_toolbox mt-10 text-center"></div>

        </div>
        <div class="flex flex-col justify-between">
            <h1 class="text-3xl text-gray-700 font-bold">{{ $larashopProduct->name }}</h1>
            {{-- {{ $news->getFirstMedia('image')()->lazy()->attributes(['class' => 'mx-auto my-16']) }} --}}
            <div class="text-justify mt-10">
                {!! $larashopProduct->description !!}
            </div>

            <div class="text-center mt-10">
                <span class="text-2xl font-bold text-blue-900">{{ $larashopProduct->price }}</span> ريال
            </div>

            <div class="w-1/2 bg-blue-900 text-white py-4 self-center mt-5">
                <div class="flex justify-center cursor-pointer cart-btn" data-product="{{ $larashopProduct->id }}">
                    <span>أضف إلى السلة</span>
                    <svg class="w-6 h-6 mr-2 fill-current text-white" version="1.1" id="Capa_1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"
                        x="0px" y="0px" viewBox="0 0 437.812 437.812" style="enable-background:new 0 0 437.812 437.812;" xml:space="preserve">
                        <g>
                            <g>
                                <g>
                                    <circle cx="152.033" cy="390.792" r="47.02"></circle>
                                    <circle cx="350.563" cy="390.792" r="47.02"></circle>
                                    <path d="M114.939,82.024l-16.196-49.11C92.296,13.499,74.267,0.292,53.812,0H18.808C13.037,0,8.359,4.678,8.359,10.449
s4.678,10.449,10.449,10.449h35.004c11.361,0.251,21.365,7.546,25.078,18.286l65.829,200.098l-4.702,12.016
c-5.729,14.98-4.185,31.769,4.18,45.453c8.695,13.274,23.323,21.466,39.184,21.943h203.755c5.771,0,10.449-4.678,10.449-10.449
c0-5.771-4.678-10.449-10.449-10.449H183.38c-8.797-0.304-16.849-5.017-21.42-12.539c-4.932-7.424-5.908-16.796-2.612-25.078
l6.269-15.674c0.942-2.504,1.124-5.23,0.522-7.837l-3.135-7.837l212.637-21.943c15.482-1.393,28.327-12.554,31.869-27.69
l21.943-92.473L114.939,82.024z"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .thumb {
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: 60px;
        height: 60px;
    }

    .thumb img {
        max-width: 100%;
        max-height: 100%;
    }
</style>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f7f86838726858d"></script>
<script>
    $('.cart-btn').on('click', function(){
        let image = $('.item-img').find('img:visible').eq(0);
        flyToElement($(image), $('.cart'));

        let id = $(this).data('product');
        $.ajax({
            method: "POST",
            url: '/store/cart',
            data: { product:id, _token: "{{ csrf_token() }}" }
        })
        .done(function( msg ) {
            $('.cart-count').text(msg).removeClass('hidden');
        }).fail(function( jqXHR, textStatus ) {
            alert('حدث خطأ اثناء محاولة الأضافة للسلة .. برجاء المحاولة فيما بعد.');
        });
    });

    function flyToElement(flyer, flyingTo) {
        var $func = $(this);
        var divider = 3;
        var flyerClone = $(flyer).clone();
        $(flyerClone).css({position: 'absolute', top: $(flyer).offset().top + "px", left: $(flyer).offset().left + "px", opacity: 1, 'z-index': 1000});
        $('body').append($(flyerClone));
        var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 2) - ($(flyer).width()/divider)/2;
        var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 2) - ($(flyer).height()/divider)/2;
        
        $(flyerClone).animate({
            opacity: 0.4,
            left: gotoX,
            top: gotoY,
            width: $(flyer).width()/divider,
            height: $(flyer).height()/divider
        }, 700,
        function () {
            $(flyingTo).fadeOut('fast', function () {
                $(flyingTo).fadeIn('fast', function () {
                    $(flyerClone).fadeOut('fast', function () {
                        $(flyerClone).remove();
                    });
                });
            });
        });
    }
</script>
@endsection