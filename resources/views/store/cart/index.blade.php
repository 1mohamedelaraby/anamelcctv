@extends('layouts.app')

@section('title', ' - سلة المشتريات')

@section('content')
<div class="banner">
    <img src="{{ asset('img/services.jpg') }}" alt="store-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto mb-16 px-5">
    <livewire:store.cart />
</div>
@endsection

@section('style')
@livewireStyles
@endsection


@section('script')
@livewireScripts
@endsection