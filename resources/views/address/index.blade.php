@extends('layouts.app')

@section('title', ' - عناويني')

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
                <h3 class="text-3xl font-bold text-blue-900">عناويني</h3>
                <a href="{{ route('address.create') }}"
                    class="flex justify-center px-10 py-3 mt-6 font-medium text-white uppercase bg-blue-900 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                    <span class="mr-2 mt-5px">اضافة عنوان جديد</span>
                </a>
            </div>
            <hr class="pb-6 mt-6">
            <div class="flex flex-wrap -mx-3 mb-2 mt-8">
                @forelse ($addresses as $address)
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <div class="flex items-start rounded bg-gray-100  shadow p-2 mb-3 last:mb-0 relative">
                        <a href="{{ route('address.edit', $address->id) }}" title="تعديل العنوان">
                            <svg class="w-8 absolute left-0 pl-3 pt-3" viewBox="0 -1 401.52289 401" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m370.589844 250.972656c-5.523438 0-10 4.476563-10 10v88.789063c-.019532 16.5625-13.4375 29.984375-30 30h-280.589844c-16.5625-.015625-29.980469-13.4375-30-30v-260.589844c.019531-16.558594 13.4375-29.980469 30-30h88.789062c5.523438 0 10-4.476563 10-10 0-5.519531-4.476562-10-10-10h-88.789062c-27.601562.03125-49.96875 22.398437-50 50v260.59375c.03125 27.601563 22.398438 49.96875 50 50h280.589844c27.601562-.03125 49.96875-22.398437 50-50v-88.792969c0-5.523437-4.476563-10-10-10zm0 0" />
                                <path
                                    d="m376.628906 13.441406c-17.574218-17.574218-46.066406-17.574218-63.640625 0l-178.40625 178.40625c-1.222656 1.222656-2.105469 2.738282-2.566406 4.402344l-23.460937 84.699219c-.964844 3.472656.015624 7.191406 2.5625 9.742187 2.550781 2.546875 6.269531 3.527344 9.742187 2.566406l84.699219-23.464843c1.664062-.460938 3.179687-1.34375 4.402344-2.566407l178.402343-178.410156c17.546875-17.585937 17.546875-46.054687 0-63.640625zm-220.257812 184.90625 146.011718-146.015625 47.089844 47.089844-146.015625 146.015625zm-9.40625 18.875 37.621094 37.625-52.039063 14.417969zm227.257812-142.546875-10.605468 10.605469-47.09375-47.09375 10.609374-10.605469c9.761719-9.761719 25.589844-9.761719 35.351563 0l11.738281 11.734375c9.746094 9.773438 9.746094 25.589844 0 35.359375zm0 0" />
                            </svg>
                        </a>
                        <form action="{{ route('address.destroy', $address->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('سيتم خذف العنوان من قائمة العناوين الخاصة بك. للاستمرار اضغط Ok!')" title="حذف العنوان">
                                <svg class="fill-current text-red-500 w-8 absolute left-0 bottom-0 pl-3 pb-3" id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path
                                                d="m415.777 58.077h-83.977v-14.183c.001-24.204-19.69-43.894-43.893-43.894h-63.814c-24.203 0-43.894 19.69-43.894 43.894v14.184h-83.976c-29.34 0-53.21 23.87-53.21 53.21v30.466c0 5.522 4.478 10 10 10h28.397l25.358 301.106c1.362 16.172 8.691 31.126 20.639 42.109 11.947 10.982 27.463 17.031 43.692 17.031h169.803c16.229 0 31.745-6.049 43.692-17.031 11.947-10.983 19.276-25.938 20.638-42.109l25.358-301.106h28.397c5.522 0 10-4.478 10-10v-30.466c0-29.341-23.87-53.211-53.21-53.211zm-215.578-14.183c0-13.175 10.719-23.894 23.894-23.894h63.814c13.175 0 23.894 10.719 23.894 23.894v14.184h-111.602zm248.788 87.859h-148.686c-5.522 0-10 4.478-10 10s4.478 10 10 10h110.218l-25.217 299.429c-1.927 22.889-21.43 40.818-44.4 40.818h-169.803c-22.97 0-42.473-17.93-44.4-40.818l-25.217-299.429h110.823c5.522 0 10-4.478 10-10s-4.478-10-10-10h-149.292v-20.466c0-18.313 14.897-33.21 33.21-33.21h319.555c18.313 0 33.21 14.897 33.21 33.21v20.466z" />
                                            <path
                                                d="m198.959 229.392c-3.906-3.904-10.236-3.904-14.143 0-3.905 3.905-3.905 10.237 0 14.143l57.041 57.041-57.041 57.041c-3.905 3.905-3.905 10.237 0 14.143 1.953 1.952 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l57.042-57.042 57.041 57.041c1.953 1.952 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929c3.905-3.905 3.905-10.237 0-14.143l-57.041-57.041 57.041-57.041c3.905-3.905 3.905-10.237 0-14.143-3.906-3.904-10.236-3.904-14.143 0l-57.04 57.042z" />
                                            <path
                                                d="m247.77 145.58c2.097 5.029 8.008 7.492 13.05 5.41 5.04-2.081 7.488-8.03 5.41-13.061-2.08-5.037-8.025-7.493-13.06-5.41-5.05 2.09-7.463 8.025-5.4 13.061z" />
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </form>
                        <input class="ml-2 mt-2" type="radio" id="address_{{ $address->id }}" value="{{ $address->id }}" name="address" {{ $address->primary ? 'checked' : '' }}>
                        <label for="address_{{ $address->id }}">
                            <a href="{{ route('address.primary', $address->id) }}" title="تحديد العنوان الافتراضي">
                                <p class="font-bold">مدينة: {{ $address->city->name }}</p>
                                <p>{{ $address->phone }}</p>
                                <p>{{ $address->address }}</p>
                            </a>
                        </label>
                    </div>
                </div>
                @empty
                <p>لا توجد عنواين مسجلة. يمكنك اضافة عناوين من زر الاضافة اعلى الصفحة.</p>
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