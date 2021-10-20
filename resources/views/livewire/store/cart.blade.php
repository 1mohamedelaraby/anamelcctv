<div class="mt-5">
    <style>
        .loader {
            border-top-color: #cabb8e;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
            position: absolute;
            top: 50%;
            right: 50%;
            transform: translate(-50%, -50%);
        }

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="fixed inset-0 bg-gray-900 bg-opacity-25 z-50" wire:loading>
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-32 w-32"></div>
    </div>
    @if ($items->count())
    <div class="flex justify-center my-6">
        <div class="flex flex-col w-full p-8 text-blue-900 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
            <div class="flex-1">
                <table class="w-full text-sm lg:text-base" cellspacing="0">
                    <thead>
                        <tr class="h-12">
                            <th class="hidden md:table-cell"></th>
                            <th class="text-right">المنتجات</th>
                            <th class="lg:text-right text-right pr-5 lg:pr-0">
                                <span class="lg:hidden" title="العدد">العدد</span>
                                <span class="hidden lg:inline">العدد</span>
                            </th>
                            <th class="hidden text-right md:table-cell">السعر</th>
                            <th class="text-right">الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key=>$item)
                        <tr>
                            <td class="hidden pb-4 md:table-cell">
                                <a href="{{ route('store.product.show', [$item->model->larashopCategories->first()->id, $item->model->slug]) }}">
                                    {{ $item->model->defaultImageThumb->attributes(['class' => 'w-20 rounded']) }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('store.product.show', [$item->model->larashopCategories->first()->id, $item->model->slug]) }}">
                                    <p class="mb-2 md:mr-4">{{ $item->model->name }}</p>
                                    <button class="text-gray-700 md:mr-4 focus:outline-none" wire:click.prevent="removeItem('{{ $key }}')">
                                        <small class="text-red-600">إزالة من السلة</small>
                                    </button>
                                </a>
                            </td>
                            <td class="justify-center md:justify-start md:flex mt-6">
                                <div class="w-20 h-10">
                                    <div class="relative flex flex-row w-full h-8">
                                        <input type="number" min="1" value="{{ $item->qty }}" wire:model="qty.{{ $key }}"
                                            class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
                                    </div>
                                </div>
                            </td>
                            <td class="hidden text-right md:table-cell">
                                <span class="text-sm lg:text-base font-medium">
                                    {{ $item->price }}
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="text-sm lg:text-base font-medium">
                                    {{ $item->total }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr class="pb-6 mt-6">
                <div class="my-4 mt-6 -mx-2 lg:flex">
                    <div class="lg:px-2 lg:w-1/2">
                        <div class="p-4 bg-gray-100 rounded-full">
                            <h1 class="mr-2 font-bold uppercase">كوبون خصم</h1>
                        </div>

                        <div class="p-4 mt-6 bg-gray-100 rounded-full">
                            <h1 class="mr-2 font-bold uppercase">معلومات الشحن</h1>
                        </div>
                        <div class="p-4">
                            @guest
                            <p class="mb-4 italic">يجب تسجيل الدخول لاختيار عنوان الشحن الخاص بك</p>
                            <a href="{{ route('login') }}" class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-blue-900 rounded-full shadow item-center hover:bg-gray-700
                                focus:shadow-outline focus:outline-none">
                                <span class="mr-2 mt-5px">تسجيل الدخول</span>
                            </a>
                            @else
                            @forelse ($addresses as $address)
                            <div class="flex items-start rounded bg-gray-100 bg-opacity-25 shadow p-2 mb-3 last:mb-0 relative">
                                <a href="{{ route('address.edit', $address->id) }}">
                                    <svg class="w-8 absolute left-0 pl-3 pt-3" viewBox="0 -1 401.52289 401" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m370.589844 250.972656c-5.523438 0-10 4.476563-10 10v88.789063c-.019532 16.5625-13.4375 29.984375-30 30h-280.589844c-16.5625-.015625-29.980469-13.4375-30-30v-260.589844c.019531-16.558594 13.4375-29.980469 30-30h88.789062c5.523438 0 10-4.476563 10-10 0-5.519531-4.476562-10-10-10h-88.789062c-27.601562.03125-49.96875 22.398437-50 50v260.59375c.03125 27.601563 22.398438 49.96875 50 50h280.589844c27.601562-.03125 49.96875-22.398437 50-50v-88.792969c0-5.523437-4.476563-10-10-10zm0 0" />
                                        <path
                                            d="m376.628906 13.441406c-17.574218-17.574218-46.066406-17.574218-63.640625 0l-178.40625 178.40625c-1.222656 1.222656-2.105469 2.738282-2.566406 4.402344l-23.460937 84.699219c-.964844 3.472656.015624 7.191406 2.5625 9.742187 2.550781 2.546875 6.269531 3.527344 9.742187 2.566406l84.699219-23.464843c1.664062-.460938 3.179687-1.34375 4.402344-2.566407l178.402343-178.410156c17.546875-17.585937 17.546875-46.054687 0-63.640625zm-220.257812 184.90625 146.011718-146.015625 47.089844 47.089844-146.015625 146.015625zm-9.40625 18.875 37.621094 37.625-52.039063 14.417969zm227.257812-142.546875-10.605468 10.605469-47.09375-47.09375 10.609374-10.605469c9.761719-9.761719 25.589844-9.761719 35.351563 0l11.738281 11.734375c9.746094 9.773438 9.746094 25.589844 0 35.359375zm0 0" />
                                    </svg>
                                </a>
                                <input class="ml-2 mt-2" type="radio" id="address_{{ $address->id }}" value="{{ $address->id }}" name="address" wire:model="address">
                                <label for="address_{{ $address->id }}">
                                    <p class="font-bold">مدينة: {{ $address->city->name }}</p>
                                    <p>{{ $address->phone }}</p>
                                    <p>{{ $address->address }}</p>
                                </label>
                            </div>
                            @empty
                            لم نجد اي عنواين مسجلة لديك. من فضلك قم بأضافة عنوان إلى قائمة العناوين الخاصة.
                            <a href="{{ route('address.create') }}"
                                class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-blue-900 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                                <span class="mr-2 mt-5px">اضافة عنوان</span>
                            </a>
                            @endforelse
                            @endguest
                        </div>
                        <hr class="pb-6 mt-6">
                        <div class="p-4">
                            <p class="mb-4 italic">إن كان دلديك كوبون خصم من فضلك ادخل الكود في مربع النص ادناه.</p>
                            @if ($couponError)
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-3 rounded-full relative" role="alert">
                                <strong class="font-bold">خطأ!</strong>
                                <span class="block sm:inline">{{ $couponError }}</span>
                                <span class="absolute top-0 bottom-0 left-0 px-4 py-3" wire:click="$set('couponError', '')">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <title>Close</title>
                                        <path
                                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                    </svg>
                                </span>
                            </div>
                            @endif

                            @if ($couponSuccess)
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 my-3 rounded-full relative" role="alert">
                                <strong class="font-bold">نجاح</strong>
                                <span class="block sm:inline">{{ $couponSuccess }}</span>
                                <span class="absolute top-0 bottom-0 left-0 px-4 py-3" wire:click="$set('couponSuccess', '')">
                                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <title>Close</title>
                                        <path
                                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                    </svg>
                                </span>
                            </div>
                            @endif

                            <div class="justify-center md:flex">
                                <div class="flex items-center w-full h-13 pr-3 bg-gray-100 border rounded-full">
                                    <input type="coupon" name="code" id="coupon" placeholder="كود الكوبون" wire:model.debounce.1s="couponCode"
                                        wire:keydown.enter.prevent="getCouponDiscount" autocomplete="off"
                                        class="w-full bg-gray-100 outline-none appearance-none focus:outline-none active:outline-none" />
                                    <button
                                        class="text-sm flex items-center px-3 py-1 text-white bg-blue-900 rounded-full outline-none md:px-4 hover:bg-gray-700 focus:outline-none active:outline-none"
                                        wire:click.prevent="getCouponDiscount">
                                        <svg aria-hidden="true" data-prefix="fas" data-icon="gift" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M32 448c0 17.7 14.3 32 32 32h160V320H32v128zm256 32h160c17.7 0 32-14.3 32-32V320H288v160zm192-320h-42.1c6.2-12.1 10.1-25.5 10.1-40 0-48.5-39.5-88-88-88-41.6 0-68.5 21.3-103 68.3-34.5-47-61.4-68.3-103-68.3-48.5 0-88 39.5-88 88 0 14.5 3.8 27.9 10.1 40H32c-17.7 0-32 14.3-32 32v80c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16v-80c0-17.7-14.3-32-32-32zm-326.1 0c-22.1 0-40-17.9-40-40s17.9-40 40-40c19.9 0 34.6 3.3 86.1 80h-86.1zm206.1 0h-86.1c51.4-76.5 65.7-80 86.1-80 22.1 0 40 17.9 40 40s-17.9 40-40 40z" />
                                        </svg>
                                        <span class="font-medium">تنفيذ الخصم</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr class="pb-6 mt-6">
                        <div class="p-4 mt-6 bg-gray-100 rounded-full">
                            <h1 class="mr-2 font-bold uppercase">معلومات اضافية</h1>
                        </div>
                        <div class="p-4">
                            <p class="mb-4 italic">ان كان لديك معلومات اضافية تفضل اخبارنا بها من فضلك ادخلها في مربع النص ادناه.</p>
                            <textarea class="w-full h-24 p-2 bg-gray-100 rounded" wire:model.lazy="notes"></textarea>
                        </div>
                    </div>

                    <div class="lg:px-2 lg:w-1/2">
                        <div class="p-4 bg-gray-100 rounded-full">
                            <h1 class="mr-2 font-bold uppercase">تفاصيل الطلب</h1>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between border-b">
                                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-blue-900">
                                    اجمالي المنتجات
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                                    {{ $total }} ريال
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="flex lg:px-4 lg:py-2 m-2 font-bold text-blue-900 items-center">
                                    <button class="ml-2" wire:click.prevent="removeDiscount">
                                        <svg aria-hidden="true" data-prefix="far" data-icon="trash-alt" class="w-4 text-red-600 hover:text-red-800"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                d="M268 416h24a12 12 0 0012-12V188a12 12 0 00-12-12h-24a12 12 0 00-12 12v216a12 12 0 0012 12zM432 80h-82.41l-34-56.7A48 48 0 00274.41 0H173.59a48 48 0 00-41.16 23.3L98.41 80H16A16 16 0 000 96v16a16 16 0 0016 16h16v336a48 48 0 0048 48h288a48 48 0 0048-48V128h16a16 16 0 0016-16V96a16 16 0 00-16-16zM171.84 50.91A6 6 0 01177 48h94a6 6 0 015.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0012-12V188a12 12 0 00-12-12h-24a12 12 0 00-12 12v216a12 12 0 0012 12z" />
                                        </svg>
                                    </button>
                                    <span>كوبون خصم:</span>
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text text-center text-green-700">
                                    {{ $couponDiscount }} ريال
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-blue-900">
                                    الإجمالي الجديد
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                                    {{ $newTotal }} ريال
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-blue-900">
                                    مصاريف شحن
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 text-center text-gray-900">
                                    {{ $shippingCost }} ريال
                                </div>
                            </div>
                            @if ($payment_fee)
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-blue-900">
                                    {{ $payment_fee_title }}
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 text-center text-gray-900">
                                    {{ $payment_fee }} ريال
                                </div>
                            </div>
                            @endif
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-lg font-bold text-center text-blue-900">
                                    الإجمالي
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                    {{ $grandTotal }} ريال
                                </div>
                            </div>
                            <div class="p-4 mt-6 bg-gray-100 rounded-full">
                                <h1 class="mr-2 font-bold uppercase">طريقة السداد</h1>
                            </div>
                            <div class="p-4">
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
                            </div>
                            @if($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-3 rounded-full relative" role="alert">
                                <strong class="font-bold">خطأ!</strong>
                                <span class="block sm:inline">برجاء اختيار عنوان الشحن وطريقة السداد</span>
                            </div>
                            @endif
                            <button wire:click.prevent="save"
                                class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-blue-900 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                                <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor"
                                        d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z" />
                                </svg>
                                <span class="mr-2 mt-5px">تابع عملية الشراء</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="bg-teal-lightest border-t-4 border-blue-900 rounded-b text-teal-darkest px-4 py-3 shadow-md my-2" role="alert">
        <div class="flex">
            <svg class="h-6 w-6 fill-current text-blue-900 ml-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" /></svg>
            <div>
                <p class="font-bold">عربة التسوق فارغة.</p>
                <p class="text-sm">أضف سلع لعربة التسوق واستعرضهم قبل عملية الشراء. <a href="{{ route('store.index') }}" class="text-blue-900">تسوق الأن</a></p>
            </div>
        </div>
    </div>
    @endif
</div>