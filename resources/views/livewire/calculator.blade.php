<div class="flex md:items-center">
    <div class="w-full">
        <div class="flex justify-between items-center">
            <h3 class="text-3xl font-bold text-blue-900">حساب تكلفة تركيب نظام كامل</h3>
        </div>
        <hr class="pb-6 mt-6">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                    <span class="text-red-500">*</span>المدينة
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 @error('city_id')  border-red-500 @enderror text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="city_id" id="city" wire:model.lazy="city">
                        <option value="">اختر مدينة</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
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
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="type">
                    <span class="text-red-500">*</span>نوع النظام
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 @error('type')  border-red-500 @enderror text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="type" id="type" wire:model.lazy="systemType">
                        <option value="">اختر نوع</option>
                        @foreach ($systemTypes as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
                @error('type')
                <p class="text-red-500 text-xs italic">يجب اختيار مدينة</p>
                @enderror
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="indoor_count">
                    <span class="text-red-500">*</span>عدد الكاميرات الداخلية
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 @error('indoor_count')  border-red-500 @enderror text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="indoor_count" id="indoor_count" wire:model="indoorCount">
                        <option value="0">اختر عدد</option>
                        @for ($i = 1; $i <= $maxIndoorCount; $i++) <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
                @error('indoor_count')
                <p class="text-red-500 text-xs italic">يجب اختيار عدد</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="outdoor_count">
                    <span class="text-red-500">*</span>عدد الكاميرات الخارجية
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 @error('outdoor_count')  border-red-500 @enderror text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="outdoor_count" id="outdoor_count" wire:model="outdoorCount">
                        <option value="0">اختر عدد</option>
                        @for ($i = 1; $i <= $maxOutdoorCount; $i++) <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
                @error('outdoor_count')
                <p class="text-red-500 text-xs italic">يجب اختيار عدد</p>
                @enderror
            </div>
        </div>

        @if ($indoorCount)
        <h2 class="font-bold text-lg">اختر الكاميرات الداخلية</h2>
        <hr class="py-5 text-gray-400">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                @if (count($indoorProducts))
                <table class="w-full text-base">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">الكمية</th>
                            <th class="px-4 py-2">الكاميرا</th>
                            <th class="px-4 py-2">السعر</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indoorProducts as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item['qty'] }}</td>
                            <td class="border px-4 py-2">{{ @$item['product']['name'] }}</td>
                            <td class="border px-4 py-2">{{ @$item['product']['price'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            @if ($remainingIndoorCount)
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="outdoor_count">
                    <span class="text-red-500">*</span>اختر دقة الكاميرات ونوعها
                </label>
                <div class="relative flex gap-4">
                    <div class="mt-1 relative rounded-md shadow-sm flex-1">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <select aria-label="Currency" class=" text-right h-full py-0  pl-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5"
                                wire:model="indoorResolution">
                                <option value="0" selected>الدقة</option>
                                @foreach ($resolutions as $key=>$value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <select aria-label="Currency" class="form-select h-full py-0  pl-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5"
                                wire:model="indoorQty">
                                <option value="0" selected>الكمية</option>
                                @for ($i = 1; $i <= $remainingIndoorCount; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>
                        </div>
                        <div>
                            <select id="indoreSearch" class="form-input select2 block w-full pr-48 pl-7 sm:text-sm sm:leading-5" placeholder="ابحث عن كاميرا واضغط لاختيارها"
                                autocomplete="off" wire:model="indoorSearch">
                                <option value="">اختر كاميرا</option>
                                @foreach ($indoorCameraQuery as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                            <script>
                                $('#indoreSearch').select2();
                                $('#indoreSearch').on('change', function (e) {
                                    @this.set('indoorSearch', e.target.value);
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif

        @if ($outdoorCount)
        <h2 class="font-bold text-lg">اختر الكاميرات الخارجية</h2>
        <hr class="py-5 text-gray-400">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                @if (count($outdoorProducts))
                <table class="w-full text-base">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">الكمية</th>
                            <th class="px-4 py-2">الكاميرا</th>
                            <th class="px-4 py-2">السعر</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($outdoorProducts as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item['qty'] }}</td>
                            <td class="border px-4 py-2">{{ @$item['product']['name'] }}</td>
                            <td class="border px-4 py-2">{{ @$item['product']['price'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            @if ($remainingOutdoorCount)
            <div class="w-full  px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="outdoor_count">
                    <span class="text-red-500">*</span>اختر دقة الكاميرات ونوعها
                </label>
                <div class="relative flex gap-4">
                    <div class="mt-1 relative rounded-md shadow-sm flex-1">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <select aria-label="Currency" class=" text-right h-full py-0  pl-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5"
                                wire:model="outdoorResolution">
                                <option value="0" selected>الدقة</option>
                                @foreach ($resolutions as $key=>$value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <select aria-label="Currency" class="form-select h-full py-0  pl-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5"
                                wire:model="outdoorQty">
                                <option value="0" selected>الكمية</option>
                                @for ($i = 1; $i <= $remainingOutdoorCount; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>
                        </div>
                        <select id="outdoorSearch" class="form-input block w-full pr-48 pl-7 sm:text-sm sm:leading-5" placeholder="ابحث عن كاميرا واضغط لاختيارها"
                            autocomplete="off" wire:model="outdoorSearch">
                            <option value="">اختر كاميرا</option>
                            @foreach ($outdoorCameraQuery as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <script>
                            $('#outdoorSearch').select2();
                        $('#outdoorSearch').on('change', function (e) {
                            @this.set('outdoorSearch', e.target.value);
                        });
                        </script>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif

        @if (!$remainingOutdoorCount && !$remainingIndoorCount && ($outdoorCount || $indoorCount))
        <hr class="py-5 text-gray-400">
        <h2 class="font-bold text-lg">اختر جهاز التسجيل</h2>
        <hr class="py-5 mt-5 text-gray-400">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                @if (count($dvrProducts))
                <table class="w-full text-base">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">الكمية</th>
                            <th class="px-4 py-2">المنتج</th>
                            <th class="px-4 py-2">السعر</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dvrProducts as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item['qty'] }}</td>
                            <td class="border px-4 py-2">{{ @$item['product']['name'] }}</td>
                            <td class="border px-4 py-2">{{ @$item['product']['price'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        @if (!count($dvrProducts))
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <div class="w-full  px-3 mb-6 md:mb-0">
                    <div class="relative flex gap-4">
                        <div class="mt-1 relative rounded-md shadow-sm flex-1">
                            <div class="absolute inset-y-0 right-0 flex items-center">
                                <select aria-label="Currency" class=" text-right h-full py-0  pl-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5">
                                    @if ($systemType == 'ip')
                                    <option value="0" selected>NVR</option>
                                    @else
                                    <option value="0" selected>DVR</option>
                                    @endif
                                </select>
                            </div>
                            <select id="dvrSearch" class="form-input block w-full pr-48 pl-7 sm:text-sm sm:leading-5" placeholder="ابحث عن جهاز تسجيل واضغط عليه لاختياره"
                                autocomplete="off" wire:model="dvrSearch">
                                <option value="">اختر جهاز تسجيل</option>
                                @foreach ($dvrQuery as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                            <script>
                                $('#dvrSearch').select2();
                        $('#dvrSearch').on('change', function (e) {
                            @this.set('dvrSearch', e.target.value);
                        });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif



        @if (count($dvrProducts))
        <hr class="py-5 text-gray-400">
        <h2 class="font-bold text-lg">اختر السعة التخزينة</h2>
        <hr class="py-5 mt-5 text-gray-400">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <table class="w-full text-base">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">الكمية</th>
                            <th class="px-4 py-2">المنتج</th>
                            <th class="px-4 py-2">السعر</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hddProducts as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item['qty'] }}</td>
                            <td class="border px-4 py-2">{{ @$item['product']['name'] }}</td>
                            <td class="border px-4 py-2">{{ @$item['product']['price'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if (!count($hddProducts))
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <div class="w-full  px-3 mb-6 md:mb-0">
                    <div class="relative flex gap-4">
                        <div class="mt-1 relative rounded-md shadow-sm flex-1">
                            <div class="absolute inset-y-0 right-0 flex items-center">
                                <select aria-label="Currency" class=" text-right h-full py-0  pl-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5">
                                    <option value="0" selected>hdd</option>
                                </select>
                            </div>
                            <select id="hddSearch" class="form-input block w-full pr-48 pl-7 sm:text-sm sm:leading-5" placeholder="ابحث عن جهاز تسجيل واضغط عليه لاختياره"
                                autocomplete="off" wire:model="hddSearch">
                                <option value="">اختر هارد ديسك</option>
                                @foreach ($hddQuery as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                            <script>
                                $('#hddSearch').select2();
                        $('#hddSearch').on('change', function (e) {
                            @this.set('hddSearch', e.target.value);
                        });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif

        @if ($hddProducts)
        <hr class="py-5 text-gray-400">
        <h2 class="font-bold text-lg">مصاريف التركيب</h2>
        <hr class="py-5 mt-5 text-gray-400">

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full  px-3 mb-6 md:mb-0">
                <p>تمديد وتركيب النظام:</p>
                <select name="" id="" class="w-full text-right py-0 border-gray-500 border sm:text-sm sm:leading-5" wire:model="installment">
                    <option value="0" selected>لا احتاج للتركيب</option>
                    <option value="1">ارغب بالتركيب بدون تمديد</option>
                    <option value="2">ارغب بالتركيب والتمديد</option>
                </select>
            </div>
        </div>

        <hr class="py-5 mt-10 text-gray-400">

        @if ($totalPrice && $hddProducts)
        <div class="w-full mt-8">
            <div class="text-center font-bold text-xl text-blue-900">التكلفة الإجمالية</div>
            <hr class="py-5 text-gray-400">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full  px-3 mb-6 md:mb-0">
                    <table class="w-full text-base">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">تكلفة المنتجات</th>
                                <th class="px-4 py-2">تكلفة الشحن</th>
                                <th class="px-4 py-2">مصاريف التركيب</th>
                                <th class="px-4 py-2">الخصم</th>
                                <th class="px-4 py-2">الاجمالي</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-4 py-2">{{ $productsPrice }}</td>
                                <td class="border px-4 py-2">{{ $shippingCost }}</td>
                                <td class="border px-4 py-2">{{ $installmentCost }}</td>
                                <td class="border px-4 py-2 text-red-600">{{ $discount }}</td>
                                <td class="border px-4 py-2 text-lg text-blue-900 font-bold">{{ $totalPrice }} ريال</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr class="py-5 text-gray-400">
        </div>
        @endif

        @endif

        <div class="flex justify-between">
            @if ($hddProducts)
            <button wire:click="calculate"
                class="flex justify-center px-10 py-3 mt-6 font-medium text-white uppercase bg-teal-800 rounded-full shadow item-center hover:bg-teal-600 focus:shadow-outline focus:outline-none">
                <span class="mr-2 mt-5px">حساب التكلفة</span>
            </button>
            @endif

            @if ($totalPrice && $hddProducts)
            <div>
                <button wire:click="showModal"
                    class="flex justify-center px-10 py-3 mt-6 font-medium text-white uppercase bg-blue-900 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                    <span class="mr-2 mt-5px">تنفيذ الطلب</span>
                </button>
                @error('city')
                <p class="text-red-500 text-xs italic">المدينة مطلوبة</p>
                @enderror
            </div>
            @endif
        </div>
    </div>


    <!-- Payment modal -->
    @if ($showPaymentModal)
    <div class="fixed z-50 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">

                        <div class="w-full mt-3 text-center sm:mt-0 sm:text-right">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                بيانات السداد
                            </h3>
                            <hr class="mb-5 mt-3 text-gray-400">
                            <div class="mt-2">

                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                                            <span class="text-red-500">*</span>الاسم الاول
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('firstName')  border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="firstName" id="firstName" type="text" value="{{ old('firstName') }}" wire:model="firstName">

                                        @error('firstName')
                                        <p class="text-red-500 text-xs italic">الاسم الاول مطلوب</p>
                                        @enderror
                                    </div>
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="lastName">
                                            <span class="text-red-500">*</span>اللقب
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('lastName')  border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="lastName" id="lastName" type="text" value="{{ old('lastName') }}" wire:model="lastName">
                                        @error('lastName')
                                        <p class="text-red-500 text-xs italic">اللقب او اسم العائلة مطلوب</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                            <span class="text-red-500">*</span>رقم الجوال
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('phone')  border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="phone" id="phone" type="text" placeholder="0512345678" value="{{ old('phone') }}" pattern="05[0-9]{8}" wire:model="phone">
                                        @error('phone')
                                        <p class="text-red-500 text-xs italic">رقم الجوال مطلوب</p>
                                        @enderror
                                    </div>
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                                            <span class="text-red-500">*</span>البريد الإلكتروني
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('email')  border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="email" id="email" type="text" value="{{ old('email') }}" wire:model="email">
                                        @error('email')
                                        <p class="text-red-500 text-xs italic">البريد الإلكتروني مطلوب</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                                            <span class="text-red-500">*</span>العنوان
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 @error('address')  border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="address" id="address" type="text" placeholder="121 اسم الشارع - المنطقة - الحي" value="{{ old('address') }}" wire:model="address">
                                        <p class="text-gray-600 text-xs italic">يرجى كتابة العنوان بصور دقيقة لسهولة توصيل المنتجات لكم</p>
                                        @error('address')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                    طريقة السداد
                                </h3>
                                <hr class="mb-5 mt-3 text-gray-400">
                                <div class="">
                                    <p>
                                        <input type="radio" id="cod" value="cod" name="payment_type" wire:model="payment_type">
                                        <label for="cod">الدفع عند الاستلام (+20ريال)</label>
                                    </p>
                                    <p>
                                        <input type="radio" id="credit" value="credit" name="payment_type" wire:model="payment_type">
                                        <label for="credit">بطاقة ائتمان (Visa - Mastercard - amircan Express)</label>
                                    </p>
                                    <p>
                                        <input type="radio" id="mada" value="mada" name="payment_type" wire:model="payment_type">
                                        <label for="mada">بطاقة ائتمان (Mada مدى)</label>
                                    </p>
                                    @error('payment_type')
                                    <p class="text-red-500 text-xs italic">يجب اختيار طريقة السداد</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-900 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                        wire:click="pay">
                        اتمام طلب الشراء
                    </button>
                    <button type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-800 text-base font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                        wire:click="pdf">
                        طباعة العرض
                    </button>
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        wire:click="$set('showPaymentModal',0)">
                        إلغاء
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>

@push('js')
<script>
    window.livewire.on('select2', () => {
            $('#outdoorSearch').select2();
            $('#indoreSearch').select2();
            $('#dvrSearch').select2();
            $('#hddSearch').select2();
            $('.select2-container').css('width', $('.select2-container').width() - 150 + 'px');
        });
        window.livewire.on('openPdf', name => {
            window.open(name, '_blank');
            window.livewire.emit('pdfOpened', name);
        });
</script>
@endpush