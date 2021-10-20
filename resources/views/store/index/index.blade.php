@extends('layouts.app')

@section('title', ' - المتجر')

@section('content')
<div class="banner">
    <img src="{{ asset('img/services.jpg') }}" alt="store-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto mb-16 px-5 relative">
    <livewire:store.show category="{{ $category ? $category->id : null }}" />
</div>
@endsection

@section('style')
@livewireStyles
<style>
    .line-through {
        text-decoration-color: red;
    }
</style>
@endsection


@section('script')
@livewireScripts
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script>
    $('.cart-btn').on('click', function(){
        let image = $(this).closest('.product').find('.product-image');
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