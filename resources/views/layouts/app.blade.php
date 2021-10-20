<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ @$site->description }}">
    <meta name="author" content="Mohamed Melouk">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ @$site->name }} @yield('title')</title>


    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .whatsapp {
            position: fixed;
            border-radius: 10px;
            right: 1vw;
            bottom: 1vw;
            padding: 0.5vw 2vw;
            background: #ffffff;
            box-shadow: 0px 0px 5px 2px #ccc;
            z-index: 50;
        }
    </style>
    @yield('style')
</head>

<body class="h-full antialiased text-right leading-relaxed" dir="rtl" style="direction: rtl; font-family: 'cairo', sans-serif;">
    <div id="app" class="h-full flex flex-col justify-between">
        <header x-data="{showFixed:window.pageYOffset>200 ? true : false}" @scroll.window="showFixed = window.pageYOffset>200 ? true : false">
            <div class="h-8 bg-blue-900"></div>
            <div class="fixed inset-x-0 top-0 z-50 w-full bg-gray-300 shadow-xl hidden" :class="{'hidden':!showFixed}" x-show="showFixed">
                <div class="py-4 flex flex-col md:flex-row items-center md:h-auto container mx-auto justify-between md:items-start px-5 relative">
                    @guest
                    <div class="login-container flex items-center order-3 md:order-1 md:w-1/3">
                        <a href=" {{ route('register') }}" class="ml-2 hover:text-black text-blue-900 hover:text-shadow">مستخدم جديد</a>
                        <div class="h-5 rounded bg-blue-900 w-1"></div>
                        <a href="{{ route('login') }}" class="mr-2 hover:text-black text-blue-900 hover:text-shadow">تسجيل الدخول</a>
                    </div>
                    @endguest
                    @auth
                    <div class="login-container flex items-center order-3 md:order-1 md:w-1/3">
                        <svg class="ml-2 w-6 h-6 fill-current text-white cursor-pointer hover:text-blue-900 hover:shadow" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                            xmlns="https://www.w3.org/2000/svg">
                            <g>
                                <path
                                    d="m256 512c-60.615 0-119.406-21.564-165.543-60.721-10.833-9.188-20.995-19.375-30.201-30.275-38.859-46.06-60.256-104.657-60.256-165.004 0-68.381 26.628-132.668 74.98-181.02s112.639-74.98 181.02-74.98 132.668 26.628 181.02 74.98 74.98 112.639 74.98 181.02c0 60.348-21.397 118.945-60.251 164.998-9.211 10.906-19.373 21.093-30.209 30.284-46.134 39.154-104.925 60.718-165.54 60.718zm0-480c-123.514 0-224 100.486-224 224 0 52.805 18.719 104.074 52.709 144.363 8.06 9.543 16.961 18.466 26.451 26.516 40.364 34.256 91.801 53.121 144.84 53.121s104.476-18.865 144.837-53.119c9.493-8.052 18.394-16.976 26.459-26.525 33.985-40.281 52.704-91.55 52.704-144.356 0-123.514-100.486-224-224-224z" />
                                <path
                                    d="m256 256c-52.935 0-96-43.065-96-96s43.065-96 96-96 96 43.065 96 96-43.065 96-96 96zm0-160c-35.29 0-64 28.71-64 64s28.71 64 64 64 64-28.71 64-64-28.71-64-64-64z" />
                                <path
                                    d="m411.202 455.084c-1.29 0-2.6-.157-3.908-.485-8.57-2.151-13.774-10.843-11.623-19.414 2.872-11.443 4.329-23.281 4.329-35.185 0-78.285-63.646-142.866-141.893-143.99l-2.107-.01-2.107.01c-78.247 1.124-141.893 65.705-141.893 143.99 0 11.904 1.457 23.742 4.329 35.185 2.151 8.571-3.053 17.263-11.623 19.414s-17.263-3.052-19.414-11.623c-3.512-13.989-5.292-28.448-5.292-42.976 0-46.578 18.017-90.483 50.732-123.63 32.683-33.114 76.285-51.708 122.774-52.358.075-.001.149-.001.224-.001l2.27-.011 2.27.01c.075 0 .149 0 .224.001 46.489.649 90.091 19.244 122.774 52.358 32.715 33.148 50.732 77.053 50.732 123.631 0 14.528-1.78 28.987-5.292 42.976-1.823 7.262-8.343 12.107-15.506 12.108z" />
                            </g>
                        </svg>
                        <div class="relative" x-data="{userMenu:false}">
                            <a href="" class="ml-2 text-white hover:text-blue-900 hover:text-shadow" @click.prevent="userMenu = !userMenu">{{ auth()->user()->name }}</a>
                            @include('layouts.userMenu')
                        </div>
                    </div>
                    @endauth
                    <div class="logo-container order-2 md:w-1/3">
                        <a href="{{ route('home') }}"><img src="{{ asset('img/inlineLogo.png') }}" alt="anamel-logo" class=" mx-auto"></a>
                    </div>
                    <div class="lang-container flex items-center order-1 md:order-3 md:w-1/3 justify-end">
                        @guest
                        <a href="" class="ml-2 hover:text-black text-blue-900 hover:text-shadow flex items-center">
                            تواصل معنا
                        </a>
                        <div class="h-5 rounded bg-blue-900 w-1"></div>
                        <a href="{{ route('cart.index') }}" class="mr-2 hover:text-black text-blue-900 hover:text-shadow flex items-center">
                            <div class="cart">
                                سلة المشتريات
                                <svg class="w-6 h-6 mr-2 fill-current text-blue-900" version="1.1" id="Capa_1" xmlns="https://www.w3.org/2000/svg"
                                    xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 437.812 437.812" style="enable-background:new 0 0 437.812 437.812;"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <circle cx="152.033" cy="390.792" r="47.02" />
                                                <circle cx="350.563" cy="390.792" r="47.02" />
                                                <path d="M114.939,82.024l-16.196-49.11C92.296,13.499,74.267,0.292,53.812,0H18.808C13.037,0,8.359,4.678,8.359,10.449
				s4.678,10.449,10.449,10.449h35.004c11.361,0.251,21.365,7.546,25.078,18.286l65.829,200.098l-4.702,12.016
				c-5.729,14.98-4.185,31.769,4.18,45.453c8.695,13.274,23.323,21.466,39.184,21.943h203.755c5.771,0,10.449-4.678,10.449-10.449
				c0-5.771-4.678-10.449-10.449-10.449H183.38c-8.797-0.304-16.849-5.017-21.42-12.539c-4.932-7.424-5.908-16.796-2.612-25.078
				l6.269-15.674c0.942-2.504,1.124-5.23,0.522-7.837l-3.135-7.837l212.637-21.943c15.482-1.393,28.327-12.554,31.869-27.69
				l21.943-92.473L114.939,82.024z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                        </a>
                        <span
                            class="{{ LaraShop::cartItems()->count() == 0 ? 'hidden' : '' }} cart-count absolute mt-2 leading-4 top-0 w-4 h-4 bg-red-600 text-white rounded-full flex items-center justify-center text-xs"
                            style="margin-right:115px;">
                            {{ LaraShop::cartItems()->count() }}
                        </span>
                    </div>

                    @endguest
                    @auth
                    <a href="" class="ml-2 text-white hover:text-blue-900 hover:text-shadow flex items-center">
                        المفضلة
                        <svg class="w-6 h-6 mr-2" viewBox="0 -20 464 464" xmlns="https://www.w3.org/2000/svg">
                            <path
                                d="m340 0c-44.773438.00390625-86.066406 24.164062-108 63.199219-21.933594-39.035157-63.226562-63.19531275-108-63.199219-68.480469 0-124 63.519531-124 132 0 172 232 292 232 292s232-120 232-292c0-68.480469-55.519531-132-124-132zm0 0"
                                fill="#ff6243" />
                            <path
                                d="m32 132c0-63.359375 47.550781-122.359375 108.894531-130.847656-5.597656-.769532-11.242187-1.15625025-16.894531-1.152344-68.480469 0-124 63.519531-124 132 0 172 232 292 232 292s6-3.113281 16-8.992188c-52.414062-30.824218-216-138.558593-216-283.007812zm0 0"
                                fill="#ff5023" /></svg>
                    </a>
                    <div class="h-5 rounded bg-gray-500 w-1"></div>
                    <a href="{{ route('cart.index') }}" class="mr-2 text-white hover:text-blue-900 hover:text-shadow flex items-center">
                        <div class="cart">
                            سلة المشتريات
                            <svg class="w-6 h-6 mr-2 fill-current text-blue-900" version="1.1" id="Capa_1" xmlns="https://www.w3.org/2000/svg"
                                xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 437.812 437.812" style="enable-background:new 0 0 437.812 437.812;"
                                xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <circle cx="152.033" cy="390.792" r="47.02" />
                                            <circle cx="350.563" cy="390.792" r="47.02" />
                                            <path d="M114.939,82.024l-16.196-49.11C92.296,13.499,74.267,0.292,53.812,0H18.808C13.037,0,8.359,4.678,8.359,10.449
				s4.678,10.449,10.449,10.449h35.004c11.361,0.251,21.365,7.546,25.078,18.286l65.829,200.098l-4.702,12.016
				c-5.729,14.98-4.185,31.769,4.18,45.453c8.695,13.274,23.323,21.466,39.184,21.943h203.755c5.771,0,10.449-4.678,10.449-10.449
				c0-5.771-4.678-10.449-10.449-10.449H183.38c-8.797-0.304-16.849-5.017-21.42-12.539c-4.932-7.424-5.908-16.796-2.612-25.078
				l6.269-15.674c0.942-2.504,1.124-5.23,0.522-7.837l-3.135-7.837l212.637-21.943c15.482-1.393,28.327-12.554,31.869-27.69
				l21.943-92.473L114.939,82.024z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                    </a>
                    <span
                        class="{{ LaraShop::cartItems()->count() == 0 ? 'hidden' : '' }} cart-count absolute mt-2 leading-4 top-0 w-4 h-4 bg-red-600 text-white rounded-full flex items-center justify-center text-xs"
                        style="margin-right:115px;">
                        {{ LaraShop::cartItems()->count() }}
                    </span>
                </div>
                @endauth
            </div>
    </div>
    </div>
    <div class="py-4 flex flex-col md:flex-row items-center h-64 md:h-auto container mx-auto justify-between md:items-start px-5 relative">
        @guest
        <div class="login-container flex items-center order-3 md:order-1 md:w-1/3">
            <a href=" {{ route('register') }}" class="ml-2 text-gray-600 hover:text-blue-900 hover:text-shadow">مستخدم جديد</a>
            <div class="h-5 rounded bg-gray-500 w-1"></div>
            <a href="{{ route('login') }}" class="mr-2 text-gray-600 hover:text-blue-900 hover:text-shadow">تسجيل الدخول</a>
        </div>
        @endguest
        @auth
        <div class="login-container flex items-center order-3 md:order-1 md:w-1/3">
            <svg class="ml-2 w-6 h-6 fill-current text-gray-600 cursor-pointer hover:text-blue-900 hover:shadow" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                xmlns="https://www.w3.org/2000/svg">
                <g>
                    <path
                        d="m256 512c-60.615 0-119.406-21.564-165.543-60.721-10.833-9.188-20.995-19.375-30.201-30.275-38.859-46.06-60.256-104.657-60.256-165.004 0-68.381 26.628-132.668 74.98-181.02s112.639-74.98 181.02-74.98 132.668 26.628 181.02 74.98 74.98 112.639 74.98 181.02c0 60.348-21.397 118.945-60.251 164.998-9.211 10.906-19.373 21.093-30.209 30.284-46.134 39.154-104.925 60.718-165.54 60.718zm0-480c-123.514 0-224 100.486-224 224 0 52.805 18.719 104.074 52.709 144.363 8.06 9.543 16.961 18.466 26.451 26.516 40.364 34.256 91.801 53.121 144.84 53.121s104.476-18.865 144.837-53.119c9.493-8.052 18.394-16.976 26.459-26.525 33.985-40.281 52.704-91.55 52.704-144.356 0-123.514-100.486-224-224-224z" />
                    <path
                        d="m256 256c-52.935 0-96-43.065-96-96s43.065-96 96-96 96 43.065 96 96-43.065 96-96 96zm0-160c-35.29 0-64 28.71-64 64s28.71 64 64 64 64-28.71 64-64-28.71-64-64-64z" />
                    <path
                        d="m411.202 455.084c-1.29 0-2.6-.157-3.908-.485-8.57-2.151-13.774-10.843-11.623-19.414 2.872-11.443 4.329-23.281 4.329-35.185 0-78.285-63.646-142.866-141.893-143.99l-2.107-.01-2.107.01c-78.247 1.124-141.893 65.705-141.893 143.99 0 11.904 1.457 23.742 4.329 35.185 2.151 8.571-3.053 17.263-11.623 19.414s-17.263-3.052-19.414-11.623c-3.512-13.989-5.292-28.448-5.292-42.976 0-46.578 18.017-90.483 50.732-123.63 32.683-33.114 76.285-51.708 122.774-52.358.075-.001.149-.001.224-.001l2.27-.011 2.27.01c.075 0 .149 0 .224.001 46.489.649 90.091 19.244 122.774 52.358 32.715 33.148 50.732 77.053 50.732 123.631 0 14.528-1.78 28.987-5.292 42.976-1.823 7.262-8.343 12.107-15.506 12.108z" />
                </g>
            </svg>
            <div class="relative" x-data="{userMenu:false}">
                <a href="" class="ml-2 text-gray-600 hover:text-blue-900 hover:text-shadow" @click.prevent="userMenu = !userMenu">{{ auth()->user()->name }}</a>
                @include('layouts.userMenu')
            </div>
        </div>
        @endauth
        <div class="logo-container order-2 md:w-1/3">
            <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="anamel-logo" class="max-w-full mx-auto"></a>
        </div>
        <div class="lang-container flex items-center order-1 md:order-3 md:w-1/3 justify-end">
            @guest
            <a href="" class="ml-2 text-gray-600 hover:text-blue-900 hover:text-shadow flex items-center">
                تواصل معنا
            </a>
            <div class="h-5 rounded bg-gray-500 w-1"></div>
            <a href="{{ route('cart.index') }}" class="mr-2 text-gray-600 hover:text-blue-900 hover:text-shadow flex items-center">
                <div class="cart">
                    سلة المشتريات
                    <svg class="w-6 h-6 mr-2 fill-current text-blue-900" version="1.1" id="Capa_1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"
                        x="0px" y="0px" viewBox="0 0 437.812 437.812" style="enable-background:new 0 0 437.812 437.812;" xml:space="preserve">
                        <g>
                            <g>
                                <g>
                                    <circle cx="152.033" cy="390.792" r="47.02" />
                                    <circle cx="350.563" cy="390.792" r="47.02" />
                                    <path d="M114.939,82.024l-16.196-49.11C92.296,13.499,74.267,0.292,53.812,0H18.808C13.037,0,8.359,4.678,8.359,10.449
				s4.678,10.449,10.449,10.449h35.004c11.361,0.251,21.365,7.546,25.078,18.286l65.829,200.098l-4.702,12.016
				c-5.729,14.98-4.185,31.769,4.18,45.453c8.695,13.274,23.323,21.466,39.184,21.943h203.755c5.771,0,10.449-4.678,10.449-10.449
				c0-5.771-4.678-10.449-10.449-10.449H183.38c-8.797-0.304-16.849-5.017-21.42-12.539c-4.932-7.424-5.908-16.796-2.612-25.078
				l6.269-15.674c0.942-2.504,1.124-5.23,0.522-7.837l-3.135-7.837l212.637-21.943c15.482-1.393,28.327-12.554,31.869-27.69
				l21.943-92.473L114.939,82.024z" />
                                </g>
                            </g>
                        </g>
                    </svg>
            </a>
            <span
                class="{{ LaraShop::cartItems()->count() == 0 ? 'hidden' : '' }} cart-count absolute mt-2 leading-4 top-0 w-4 h-4 bg-red-600 text-white rounded-full flex items-center justify-center text-xs"
                style="margin-right:115px;">
                {{ LaraShop::cartItems()->count() }}
            </span>
        </div>

        @endguest
        @auth
        <a href="" class="ml-2 text-gray-600 hover:text-blue-900 hover:text-shadow flex items-center">
            المفضلة
            <svg class="w-6 h-6 mr-2" viewBox="0 -20 464 464" xmlns="https://www.w3.org/2000/svg">
                <path
                    d="m340 0c-44.773438.00390625-86.066406 24.164062-108 63.199219-21.933594-39.035157-63.226562-63.19531275-108-63.199219-68.480469 0-124 63.519531-124 132 0 172 232 292 232 292s232-120 232-292c0-68.480469-55.519531-132-124-132zm0 0"
                    fill="#ff6243" />
                <path
                    d="m32 132c0-63.359375 47.550781-122.359375 108.894531-130.847656-5.597656-.769532-11.242187-1.15625025-16.894531-1.152344-68.480469 0-124 63.519531-124 132 0 172 232 292 232 292s6-3.113281 16-8.992188c-52.414062-30.824218-216-138.558593-216-283.007812zm0 0"
                    fill="#ff5023" /></svg>
        </a>
        <div class="h-5 rounded bg-gray-500 w-1"></div>
        <a href="{{ route('cart.index') }}" class="mr-2 text-gray-600 hover:text-blue-900 hover:text-shadow flex items-center">
            <div class="cart">
                سلة المشتريات
                <svg class="w-6 h-6 mr-2 fill-current text-blue-900" version="1.1" id="Capa_1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"
                    x="0px" y="0px" viewBox="0 0 437.812 437.812" style="enable-background:new 0 0 437.812 437.812;" xml:space="preserve">
                    <g>
                        <g>
                            <g>
                                <circle cx="152.033" cy="390.792" r="47.02" />
                                <circle cx="350.563" cy="390.792" r="47.02" />
                                <path d="M114.939,82.024l-16.196-49.11C92.296,13.499,74.267,0.292,53.812,0H18.808C13.037,0,8.359,4.678,8.359,10.449
				s4.678,10.449,10.449,10.449h35.004c11.361,0.251,21.365,7.546,25.078,18.286l65.829,200.098l-4.702,12.016
				c-5.729,14.98-4.185,31.769,4.18,45.453c8.695,13.274,23.323,21.466,39.184,21.943h203.755c5.771,0,10.449-4.678,10.449-10.449
				c0-5.771-4.678-10.449-10.449-10.449H183.38c-8.797-0.304-16.849-5.017-21.42-12.539c-4.932-7.424-5.908-16.796-2.612-25.078
				l6.269-15.674c0.942-2.504,1.124-5.23,0.522-7.837l-3.135-7.837l212.637-21.943c15.482-1.393,28.327-12.554,31.869-27.69
				l21.943-92.473L114.939,82.024z" />
                            </g>
                        </g>
                    </g>
                </svg>
        </a>
        <span
            class="{{ LaraShop::cartItems()->count() == 0 ? 'hidden' : '' }} cart-count absolute mt-2 leading-4 top-0 w-4 h-4 bg-red-600 text-white rounded-full flex items-center justify-center text-xs"
            style="margin-right:115px;">
            {{ LaraShop::cartItems()->count() }}
        </span>
    </div>
    @endauth
    </div>
    </div>
    @include('layouts.menu')
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer class="bg-gray-100 break-all">
        <div class="container mx-auto mt-5 py-8 pt-24 text-3xl font-bold">
            <div class="flex flex-col justify-around items-center">
                <h3 class="text-gray-700">الاستشارات والدعم الفني</h3>
                <div class="contacts w-full flex flex-col md:flex-row my-16 justify-around items-center">
                    <div class="email flex items-center text-gray-600">
                        <a href="mailto:{{ @$site->email }}">{{ @$site->email }}</a>
                        <svg class="mr-2 w-8 h-8 fill-current text-gray-600" version="1.1" id="Capa_1" xmlns="https://www.w3.org/2000/svg"
                            xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M467,61H45c-6.927,0-13.412,1.703-19.279,4.51L255,294.789l51.389-49.387c0,0,0.004-0.005,0.005-0.007
			c0.001-0.002,0.005-0.004,0.005-0.004L486.286,65.514C480.418,62.705,473.929,61,467,61z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M507.496,86.728L338.213,256.002L507.49,425.279c2.807-5.867,4.51-12.352,4.51-19.279V106
			C512,99.077,510.301,92.593,507.496,86.728z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M4.51,86.721C1.703,92.588,0,99.073,0,106v300c0,6.923,1.701,13.409,4.506,19.274L173.789,256L4.51,86.721z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M317.002,277.213l-51.396,49.393c-2.93,2.93-6.768,4.395-10.605,4.395s-7.676-1.465-10.605-4.395L195,277.211
			L25.714,446.486C31.582,449.295,38.071,451,45,451h422c6.927,0,13.412-1.703,19.279-4.51L317.002,277.213z" />
                                </g>
                            </g>
                        </svg>

                    </div>

                    <div class="phone flex items-center text-gray-600 mt-5 md:mt-0" style="direction: ltr">
                        <svg class="w-10 h-10 mr-3" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M298.667,25.6h-85.333c-4.71,0-8.533,3.823-8.533,8.533c0,4.71,3.823,8.533,8.533,8.533h85.333
			c4.71,0,8.533-3.823,8.533-8.533C307.2,29.423,303.377,25.6,298.667,25.6z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M358.4,25.6h-8.533c-4.71,0-8.533,3.823-8.533,8.533c0,4.71,3.823,8.533,8.533,8.533h8.533
			c4.71,0,8.533-3.823,8.533-8.533C366.933,29.423,363.11,25.6,358.4,25.6z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M266.598,435.2H245.41c-12.979,0-23.543,10.564-23.543,23.543v4.122c0,12.979,10.564,23.535,23.535,23.535h21.188
			c12.979,0,23.543-10.556,23.543-23.535v-4.122C290.133,445.764,279.569,435.2,266.598,435.2z M273.067,462.865
			c0,3.567-2.901,6.468-6.468,6.468H245.41c-3.575,0-6.477-2.901-6.477-6.468v-4.122c0-3.575,2.901-6.477,6.477-6.477h21.18
			c3.576,0,6.477,2.901,6.477,6.477V462.865z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M370.227,0H141.781c-17.007,0-30.848,13.841-30.848,30.848v450.304c0,17.007,13.841,30.848,30.848,30.848h228.437
			c17.007,0,30.848-13.841,30.848-30.839V30.848C401.067,13.841,387.226,0,370.227,0z M384,481.152
			c0,7.595-6.178,13.781-13.773,13.781H141.781c-7.603,0-13.781-6.187-13.781-13.773V30.848c0-7.595,6.178-13.781,13.781-13.781
			h228.437c7.603,0,13.781,6.187,13.781,13.781V481.152z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M392.533,51.2H119.467c-4.71,0-8.533,3.823-8.533,8.533v358.4c0,4.71,3.823,8.533,8.533,8.533h273.067
			c4.71,0,8.533-3.823,8.533-8.533v-358.4C401.067,55.023,397.244,51.2,392.533,51.2z M384,409.6H128V68.267h256V409.6z" />
                                </g>
                            </g>
                        </svg>
                        <a href="tel:{{ @$site->phone }}" target="_blank">{{ @$site->phone }}</a>
                    </div>

                </div>

                <div class="w-full text-center text-sm grid grid-cols-2 md:grid-cols-4 text-gray-700" style="direction: ltr">
                    <div class="mt-2">
                        <a class="flex justify-center items-center" target="_blank" href="//facebook.com/{{ @$site->facebook }}">
                            <img src="{{ asset('img/icons/facebook.png') }}" alt="anamel facebook icon" class="mr-1">
                            {{ @$site->facebook }}
                        </a>
                    </div>
                    <div class="mt-2">
                        <a class="flex justify-center items-center" target="_blank" href="//twitter.com/{{ @$site->twitter }}">
                            <img src="{{ asset('img/icons/twitter.png') }}" alt="anamel facebook icon" class="mr-1">
                            {{ @$site->twitter }}
                        </a>
                    </div>
                    <div class="mt-2">
                        <a class="flex justify-center items-center" target="_blank" href="//youtube.com/channel/{{ @$site->youtube }}">
                            <img src="{{ asset('img/icons/youtube.png') }}" alt="anamel facebook icon" class="mr-1">
                            {{ @$site->youtube }}
                        </a>
                    </div>
                    <div class="mt-2">
                        <a class="flex justify-center items-center" target="_blank" href="//instagram.com/{{ @$site->instagram }}">
                            <img src="{{ asset('img/icons/instagram.png') }}" alt="anamel facebook icon" class="mr-1">
                            {{ @$site->instagram }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 bg-blue-900">
            <div class="text-center text-white text-sm">
                جميع الحقوق محفوظة لدى مؤسسة أنامل
                <div class="text-xs">
                    <a href="https://alandrin.com" target="_blank" class="flex md:justify-end justify-center items-center">برمجة وتصميم <img
                            src="{{ asset('img/andrin-logo.png') }}" alt="alandrin" title="الأندرين لتكنولوجيا المعلومات" class="h-8 mr-3"></a>
                </div>
            </div>
        </div>
    </footer>
    <div class="whatsapp">
        <a href="//wa.me/966{{ @$site->whatsApp }}" target="_blank" class="flex items-center">
            تواصل معنا عبر الواتساب
            <svg class="w-10 h-10 rounded-full mr-3" version="1.1" id="Capa_1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 455.731 455.731" style="enable-background:new 0 0 455.731 455.731;" xml:space="preserve">
                <g>
                    <rect x="0" y="0" style="fill:#1BD741;" width="455.731" height="455.731" />
                    <g>
                        <path style="fill:#FFFFFF;" d="M68.494,387.41l22.323-79.284c-14.355-24.387-21.913-52.134-21.913-80.638
			c0-87.765,71.402-159.167,159.167-159.167s159.166,71.402,159.166,159.167c0,87.765-71.401,159.167-159.166,159.167
			c-27.347,0-54.125-7-77.814-20.292L68.494,387.41z M154.437,337.406l4.872,2.975c20.654,12.609,44.432,19.274,68.762,19.274
			c72.877,0,132.166-59.29,132.166-132.167S300.948,95.321,228.071,95.321S95.904,154.611,95.904,227.488
			c0,25.393,7.217,50.052,20.869,71.311l3.281,5.109l-12.855,45.658L154.437,337.406z" />
                        <path style="fill:#FFFFFF;" d="M183.359,153.407l-10.328-0.563c-3.244-0.177-6.426,0.907-8.878,3.037
			c-5.007,4.348-13.013,12.754-15.472,23.708c-3.667,16.333,2,36.333,16.667,56.333c14.667,20,42,52,90.333,65.667
			c15.575,4.404,27.827,1.435,37.28-4.612c7.487-4.789,12.648-12.476,14.508-21.166l1.649-7.702c0.524-2.448-0.719-4.932-2.993-5.98
			l-34.905-16.089c-2.266-1.044-4.953-0.384-6.477,1.591l-13.703,17.764c-1.035,1.342-2.807,1.874-4.407,1.312
			c-9.384-3.298-40.818-16.463-58.066-49.687c-0.748-1.441-0.562-3.19,0.499-4.419l13.096-15.15
			c1.338-1.547,1.676-3.722,0.872-5.602l-15.046-35.201C187.187,154.774,185.392,153.518,183.359,153.407z" />
                    </g>
                </g>
            </svg>
        </a>
    </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6XZNWPZLX4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-6XZNWPZLX4');
    </script>
    </script>
</body>

</html>