{{-- menu --}}
<div class="container mx-auto mt-5 px-5 select-none" x-data="{ isSm: true, submenu:false, storeMenu:false }">
    <svg class="mb-4 w-8 h-8 fill-current text-gray-600 cursor-pointer hover:text-blue-900 hover:shadow md:hidden" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
        xmlns="http://www.w3.org/2000/svg" @click="isSm=!isSm">
        <path
            d="m464.883 64.267h-417.766c-25.98 0-47.117 21.136-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.013-21.137-47.149-47.117-47.149z" />
        <path
            d="m464.883 208.867h-417.766c-25.98 0-47.117 21.136-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.013-21.137-47.149-47.117-47.149z" />
        <path
            d="m464.883 353.467h-417.766c-25.98 0-47.117 21.137-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.012-21.137-47.149-47.117-47.149z" />
    </svg>
    <div class="flex justify-around font-bold text-lg flex-col md:flex-row md:flex px-5 mb-5 shadow-lg md:shadow-none rounded-lg relative" x-bind:class="{ 'hidden': isSm }">
        <a href="{{ route('home') }}" class="text-gray-600 py-4 px-2 rounded hover:bg-gray-200 md:hover:bg-transparent">الرئيسة</a>
        <a href="{{ route('news.index') }}" class="text-gray-600 py-4 px-2 rounded hover:bg-gray-200 md:hover:bg-transparent">جديدنا</a>
        <a class="text-gray-600 py-4 px-2 rounded hover:bg-gray-200 md:hover:bg-transparent cursor-pointer" @click="submenu=!submenu">مجالاتنا</a>
        <div x-show="submenu" class="md:absolute z-50 right-0 left-0 top-0 bg-white md:mt-16 p-5 border rounded-lg hidden" :class="{'hidden': !submenu}"
            @click.away="submenu = false">
            @php
            $services = App\Service::orderBy('order','ASC')->where('is_menu', 1)->get();
            @endphp
            <div class="grid md:grid-cols-5 grid-cols-2 text-sm text-gray-600">
                @foreach ($services as $item)
                <div class="text-right px-5 mb-5">
                    <a href="{{ route('service.show', $item->slug) }}">
                        <div class="font-bold">{{ $item->name }}</div>
                        <p class="mt-3 font-normal">{{ $item->short_desc }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <a class="text-gray-600 py-4 px-2 rounded hover:bg-gray-200 md:hover:bg-transparent cursor-pointer" @click=" storeMenu=!storeMenu">المتجر</a>
        <div x-show="storeMenu" class="h-screen md:absolute z-50 right-0 left-0 top-0 bg-white md:mt-16 p-5 border rounded-lg hidden" :class="{ 'hidden': !storeMenu }"
            @click.away="storeMenu = false">
            @php
            $categories = CobraProjects\LaraShop\Models\LarashopCategory::with('childs')->where('parent_id', null)->orderBy('order','ASC')->get();
            @endphp
            <div class="flex text-sm text-gray-600">
                <ul class="text-right px-5 mb-5 w-64 relative">
                    @foreach ($categories as $item)
                    <li class="mb-3 pb-3 border-b border-gray-400" x-data="{sub{{ $item->id }}:false}">
                        <a @if (!$item->hasChilds) href="{{ route('store.category.index', $item->slug) }}" @endif class="flex justify-between cursor-pointer"
                            @click="sub{{ $item->id }}=!sub{{ $item->id }}">
                            <div class="font-bold">{{ $item->name }}</div>
                            @if ($item->hasChilds)
                            <span class="font-bold text-blue-900">
                                >
                            </span>
                            @endif
                        </a>
                        @if ($item->hasChilds)
                        <div class="subMenu md:absolute mr-5 mt-5 md:mr-0 md:mt-0 top-0 w-64" style="right:16rem" x-show="sub{{ $item->id }}"
                            @click.away="sub{{ $item->id }} = false">
                            <div class="flex justify-between mb-3 pb-3 border-b border-gray-400">
                                <a href="{{ route('store.category.index', $item->slug) }}" class="flex justify-between w-full">
                                    <div class="font-bold">تسوق جميع {{ $item->name }}</div>
                                </a>
                            </div>
                            @foreach ($item->childs as $child)
                            <div class="flex justify-between mb-3 pb-3 border-b border-gray-400">
                                <a href="{{ route('store.category.index', $child->slug) }}" class="flex justify-between w-full">
                                    <div class="font-bold">{{ $child->name }}</div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <a href="{{ route('calculator') }}" class="text-gray-600 py-4 px-2 rounded hover:bg-gray-200 md:hover:bg-transparent">حاسبة المشاريع</a>
        <a href="{{ route('about') }}" class="text-gray-600 py-4 px-2 rounded hover:bg-gray-200 md:hover:bg-transparent">من نحن</a>
        <a href="{{ route('testimonials') }}" class="text-gray-600 py-4 px-2 rounded hover:bg-gray-200 md:hover:bg-transparent">قالوا عنا</a>
        <a href="{{ route('contact-us') }}" class="text-gray-600 py-4 px-2 rounded hover:bg-gray-200 md:hover:bg-transparent">اتصل بنا</a>
    </div>
</div>
{{-- End Menu --}}