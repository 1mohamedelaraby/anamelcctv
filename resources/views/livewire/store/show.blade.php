<div>
    <div class="search absolute w-full inset-x-0">
        @livewire('store.search')
    </div>
    <div class="mt-10 px-3 flex flex-col md:flex-row">
        <div class="w-full md:w-1/4 text-l ml-5">
            <ul>
                <h3 class="text-xl text-bold mb-3">الأقسام</h3>
                @foreach (@$categories as $item)
                <a href="{{ route('store.category.index', $item->slug) }}" class="{{ @$category->id == $item->id?'text-blue-900':'text-gray-700' }}">
                    <li class="px-2 py-4 hover:bg-gray-300">{{ $item->name }}</li>
                </a>
                <hr>
                @endforeach
            </ul>
            @if (@$subCategories && @$subCategories->count())
            <ul class="mt-20">
                <h3 class="text-xl text-bold mb-3">الاقسام الفرعية</h3>
                @foreach (@$subCategories as $key=>$item)
                <a class="{{ @$category->id == $item->id?'text-blue-900':'text-gray-700' }}">
                    <li class="px-2 py-4 hover:bg-gray-300">
                        <input type="checkbox" class="mx-2" {{ @in_array($selectedSubCategories, $item->id)?'checked':'' }} value="{{ $item->id }}"
                            wire:model="selectedSubCategories.{{ $item->id }}">
                        {{ $item->name }} ({{ $item->larashop_products_count }})
                    </li>
                </a>
                <hr>
                @endforeach
            </ul>
            @endif

            @if (@count($filters))
            <ul class="mt-20">
                @foreach (@$filters as $key=>$item)
                <a class="{{ @$category->id == $item->id?'text-blue-900':'text-gray-700' }}">
                    <li class="px-2 py-4 hover:bg-gray-300">
                        <input type="checkbox" class="mx-2" {{ @in_array($selectedFilters, $item->id)?'checked':'' }} value="{{ $item->id }}"
                            wire:model="selectedFilters.{{ $item->id }}">
                        {{ $item->name }} ({{ $item->larashop_products_count }})
                    </li>
                </a>
                <hr>
                @endforeach
            </ul>
            @endif
        </div>
        <div class="w-full md:w-3/4 ">
            <div class="flex content-center flex-wrap">
                @foreach ($products as $item)
                <div class="flex w-2/2 md:w-1/3 p-2 product">
                    <div class="pt-12 overflow-hidden border-t-4 border-blue-900 shadow hover:shadow-xl text-gray-700">
                        <a href="{{ route('store.product.show', [$item->larashopCategories->first()->id, $item->slug]) }}">
                            {{ $item->defaultImageThumb->attributes(['class'=>'product-image', 'style' => 'height:'.config('larashop.thumbnails.product.height').'px;width:'.config('larashop.thumbnails.product.width').'px']) }}
                            <div class="p-4 md:p-6">
                                <h5 class="py-3 h-16 overflow-hidden font-semibold mb-2 leading-tight sm:leading-normal hover:text-blue-900">{{ $item->name }}</h5>
                                <hr>
                                <div class="mt-5 flex justify-center items-center">
                                    <div class="old-price ml-5">
                                        @if ($item->old_price)
                                        <span class="text-lg  line-through">&nbsp;&nbsp;&nbsp;{{ $item->old_price }} ريال&nbsp;&nbsp;&nbsp;</span>
                                        @endif
                                    </div>
                                    <div class="price">
                                        <span class="text-2xl font-bold text-blue-900">{{ $item->price }}</span> ريال
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="button-group flex text-center">
                            <div class="w-3/4 bg-blue-900 text-white py-4">
                                <div class="flex justify-center cursor-pointer cart-btn" data-product="{{ $item->id }}">
                                    <span>أضف إلى السلة</span>
                                    <svg class="w-6 h-6 mr-2 fill-current text-white" version="1.1" id="Capa_1" xmlns="https://www.w3.org/2000/svg"
                                        xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 437.812 437.812" style="enable-background:new 0 0 437.812 437.812;"
                                        xml:space="preserve">
                                        <g>
                                            <g>
                                                <g>
                                                    <circle cx="152.033" cy="390.792" r="47.02"></circle>
                                                    <circle cx="350.563" cy="390.792" r="47.02"></circle>
                                                    <path d="M114.939,82.024l-16.196-49.11C92.296,13.499,74.267,0.292,53.812,0H18.808C13.037,0,8.359,4.678,8.359,10.449
				s4.678,10.449,10.449,10.449h35.004c11.361,0.251,21.365,7.546,25.078,18.286l65.829,200.098l-4.702,12.016
				c-5.729,14.98-4.185,31.769,4.18,45.453c8.695,13.274,23.323,21.466,39.184,21.943h203.755c5.771,0,10.449-4.678,10.449-10.449
				c0-5.771-4.678-10.449-10.449-10.449H183.38c-8.797-0.304-16.849-5.017-21.42-12.539c-4.932-7.424-5.908-16.796-2.612-25.078
				l6.269-15.674c0.942-2.504,1.124-5.23,0.522-7.837l-3.135-7.837l212.637-21.943c15.482-1.393,28.327-12.554,31.869-27.69
				l21.943-92.473L114.939,82.024z"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="w-1/4 bg-red-700 py-4">
                                <svg class="w-6 h-6 m-auto" viewBox="0 -20 464 464" xmlns="https://www.w3.org/2000/svg">
                                    <path
                                        d="m340 0c-44.773438.00390625-86.066406 24.164062-108 63.199219-21.933594-39.035157-63.226562-63.19531275-108-63.199219-68.480469 0-124 63.519531-124 132 0 172 232 292 232 292s232-120 232-292c0-68.480469-55.519531-132-124-132zm0 0"
                                        fill="#fff"></path>
                                    <path
                                        d="m32 132c0-63.359375 47.550781-122.359375 108.894531-130.847656-5.597656-.769532-11.242187-1.15625025-16.894531-1.152344-68.480469 0-124 63.519531-124 132 0 172 232 292 232 292s6-3.113281 16-8.992188c-52.414062-30.824218-216-138.558593-216-283.007812zm0 0"
                                        fill="#ff5023"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-5">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>