@extends('layouts.app')

@section('title', ' - تعديل عنوان')

@section('content')
<div class="banner">
    <img src="{{ asset('img/services.jpg') }}" alt="services-banner" class="w-full object-cover select-none">
</div>

<div class="container mx-auto my-16 px-5">
    <div class="flex md:items-center">
        <div class="w-full">
            <div class="flex justify-between items-center">
                <h3 class="text-3xl font-bold text-blue-900">تعديل عنوان</h3>
            </div>
            <hr class="pb-6 mt-6">
            <form class="w-full" action="{{ route('address.update', $address->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                            <span class="text-red-500">*</span>المدينة
                        </label>
                        <div class="relative">
                            <select
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 @error('city_id')  border-red-500 @enderror text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="city_id" id="city">
                                <option value="">اختر مدينة</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id', $address->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                            </div>
                        </div>
                        @error('city_id')
                        <p class="text-red-500 text-xs italic">يجب اختيار مدينة</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                            <span class="text-red-500">*</span>رقم الجوال
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('city_id')  border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="phone" id="phone" type="text" placeholder="0512345678" value="{{ old('phone', $address->phone) }}" pattern="05[0-9]{8}">
                        <p class="text-gray-600 text-xs italic">الصيغة المطلوبة رقم بحروف انجليزية يبدا ب 05 ويليه 8 ارقام</p>
                        @error('phone')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                            <span class="text-red-500">*</span>العنوان
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('city_id')  border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="address" id="address" type="text" placeholder="121 اسم الشارع - المنطقة - الحي" value="{{ old('address', $address->address) }}">
                        <p class="text-gray-600 text-xs italic">يرجى كتابة العنوان بصور دقيقة لسهولة توصيل المنتجات لكم</p>
                        @error('address')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="street_no">
                            رقم الشارع
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('street_no')  border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="street_no" id="street_no" type="text" placeholder="121" value="{{ old('street_no', $address->street_no) }}">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area">
                            الحي
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('area')  border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="area" id="area" type="text" placeholder="الشارقة" value="{{ old('area', $address->area) }}">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="building">
                            رقم العقار
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="building" id="building" type="text" placeholder="4562" value="{{ old('building', $address->building) }}">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="floor">
                            رقم الطابق
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('floor')  border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="floor" id="floor" type="text" placeholder="9" value="{{ old('floor', $address->floor) }}">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="apartment">
                            رقم الشقة
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('apartment')  border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="apartment" id="apartment" type="text" placeholder="2" value="{{ old('apartment', $address->apartment) }}">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="postcode">
                            الرمز البريدي
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="postcode" id="postcode" type="text" placeholder="22152" value="{{ old('postcode', $address->postcode) }}">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nearest">
                            اقرب مكان مشهور بجوارك
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('nearest')  border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="nearest" id="nearest" type="text" placeholder="بجوار مكتبة الأمة" value="{{ old('nearest', $address->nearest) }}">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="notes">
                            معلومات اضافية تحب ان تذكرها لسهولة الوصول
                        </label>
                        <textarea
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('notes')  border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="notes" id="notes" type="text" placeholder="بجوار مكتبة الأمة">{{ old('notes', $address->notes) }}</textarea>
                    </div>
                </div>

                <button type="submit"
                    class="flex justify-center px-10 py-3 mt-6 font-medium text-white uppercase bg-blue-900 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                    <span class="mr-2 mt-5px">تعديل عنوان</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>

</style>
@endsection