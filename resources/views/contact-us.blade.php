@extends('layouts.app')

@section('title', ' - اتصل بنا')

@section('content')
<div class="banner">
    <img src="{{ asset('img/contact.jpg') }}" alt="about-banner" class="w-full object-cover select-none">
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
                    <p class="font-bold">شكرا لتواصلكم معنا</p>
                    <p class="text-sm">تم استلام رسالتكم وسيتم الرد عليها في اقرب وقت ممكن.</p>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="flex md:items-center">
        <form action="{{ route('contact-us') }}" method="post" class="w-full md:w-1/2 mx-auto">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        الأسم الاول
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-first-name" type="text" placeholder="الأسم الأول" name="first_name" value="{{ old('first_name') }}">
                    @error('first_name')
                    <p class="text-red-500 text-xs italic">الاسم الاول مطلوب !!</p>
                    @enderror
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        أسم العائلة
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="text" placeholder="أسم العائلة" name="last_name" value="{{ old('last_name') }}">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        البريد الإلكتروني
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="email" type="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-red-500 text-xs italic">البريد الإلكتروني مطلوب</p>
                    @enderror
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        الرسالة
                    </label>
                    <textarea
                        class=" no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none"
                        id="message" name="message">{{ old('message') }}</textarea>
                    @error('message')
                    <p class="text-red-500 text-xs italic">نص الرسالة مطلوب</p>
                    @enderror
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3" x-data="{submited: false}">
                    <button type="submit"
                        class="shadow bg-blue-900 hover:bg-blue-900 focus:shadow-outline focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold py-2 px-4 rounded"
                        :disabled='submited' @click="submited = true">
                        ارسال
                    </button>
                </div>
                <div class="md:w-2/3"></div>
            </div>
        </form>
    </div>
</div>
@endsection