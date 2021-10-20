@extends('layouts.app')

@section('title', ' - مشترياتي')

@section('content')
<div class="banner">
    <img src="{{ asset('img/services.jpg') }}" alt="services-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto my-16 px-5">
    @if (session()->has('success'))
    <div class="mx-auto mb-8">
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="px-1">
                    <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg>
                </div>
                <div>
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="flex md:items-center">
        <div class="w-full">
            <div class="flex justify-between items-center">
                <h3 class="text-3xl font-bold text-blue-900">مشترياتي</h3>
            </div>
            <hr class="pb-6 mt-6">
            <div class="flex flex-wrap -mx-3 mb-2 mt-8">
                @forelse ($orders as $order)
                <div class="w-full px-3 mb-6 md:mb-0">
                    <div class="flex items-start rounded bg-gray-100  shadow p-5 mb-3 last:mb-0 relative">
                        <div class="flex gap-16">
                            <span><strong>تاريخ الطلب:</strong> {{ $order->created_at }}</span>
                            <span><strong>رقم الطلب:</strong> {{ $order->id }}</span>
                            <span><strong>حالة الطلب:</strong> {{ $order->status }}</span>
                            <span><strong>حالة السداد:</strong> {{ $order->paid ? 'مسدد' : 'غير مسدد' }}</span>
                            <span><strong>اجمالي الطلب:</strong> {{ $order->totalPrice }} ريال</span>
                        </div>
                    </div>
                </div>
                @empty
                <p>لا توجد طلبات شراء قمت بطلبها حتى الان.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>

</style>
@endsection