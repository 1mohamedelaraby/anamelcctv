@extends('layouts.app')

@section('title', ' - حاسبة المشاريع')

@section('content')
<div class="banner">
    <img src="{{ asset('img/services.jpg') }}" alt="about-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto my-16 px-5">
    @livewire('calculator')
</div>
@endsection

@section('style')
@livewireStyles
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container {
        float: left;
    }
</style>
<style>

</style>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@livewireScripts
@stack('js')
@endsection