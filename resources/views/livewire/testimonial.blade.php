<div>
    <div class="mt-10 px-3 flex flex-col md:flex-row">
        <div class="w-full md:w-1/4 md:border-l-2 border-gray-300 text-xl md:pb-8 md:mt-24">
            <ul>
                @foreach (@$testimonials as $item)
                <a href="?testimonial_id={{ $item->id }}" class="{{ @$testimonial->id == $item->id?'text-blue-900':'text-gray-700' }}"
                    wire:click.prevent="changeTestimonial({{ $item->id }})">
                    <li class="p-2 hover:bg-gray-300">{{ $item->name }}</li>
                </a>
                @endforeach
            </ul>
        </div>
        <div class="w-full md:w-3/4 mr-0 md:mr-5 flex justify-between flex-col border-t-2 border-gray-300 md:border-none">
            <p class="mt-5 md:mt-0">
                <img src="{{ Storage::url(@$testimonial->photo) }}" alt="" class="mx-auto md:mx-0">
            </p>
            <p class="text-gray-600 text-lg text-justify mt-10">{!! nl2br(@$testimonial->content) !!}</p>
            <div class="py-3 bg-yuma-200 mt-16"></div>
        </div>
    </div>
</div>