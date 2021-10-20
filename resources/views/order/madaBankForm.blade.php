@extends('layouts.app')

@section('title', ' - من نحن')

@section('content')
<div class="container-fluid">
    <div class="row no-gutters">
        <div class="col-md-12">
            <div class="section-block mt-1">
                <div class="title">اتمام عملية الشراء</div>
            </div>
            <div class="body">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            @if(session()->get('error'))
                            <div class="alert alert-danger text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong class="d-block d-sm-inline-block-force"> رسالة خطأ: </strong>
                                <p class="mt-3">{!! session('error') !!}</p>
                            </div>
                            @endif
                            <div class="block">
                                <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous">
                                </script>
                                <script>
                                    var wpwlOptions = {
                                        locale: "{{ app()->getLocale() }}",
                                        style: "plain",
                                        onReady: function(e){
                                            $('.wpwl-form-card').find('.wpwl-button-pay').html('سداد');
                                            $('.wpwl-form-card').find('.wpwl-button-pay').on('click', function(e){
                                            validateHolder(e);
                                            });
                                        },
                                        onBeforeSubmitCard: function(e){
                                            return validateHolder(e);
                                        }
                                    }

                                    function validateHolder(e) {
                                        var holder = $('.wpwl-control-cardHolder').val();
                                        if (holder.trim().length < 2) {
                                            $('.wpwl-control-cardHolder').addClass('wpwl-has-error').after('<div class="wpwl-hint wpwl-hint-cardHolderError">اسم حامل البطاقة مطلوب</div>');
                                            return false;
                                        }
                                        return true;
                                    }
                                </script>
                                <script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId=<?php echo $checkout?>"></script>
                                <p>المبلغ المطلوب {{ $order->totalPrice }} ريال</p>
                                <div>
                                    <form action="{{ route('order.payment', $order->id) }}" class="paymentWidgets" data-brands="MADA">
                                        @csrf
                                        MADA
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    ul {
        padding: 0;
        list-style: none;
    }

    .visa {
        display: none;
    }

    .wpwl-control-cardNumber {
        direction: ltr !important;
    }
</style>
@endsection

@section('scripts')

@endsection