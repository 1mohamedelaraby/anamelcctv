<ul class="w-full">
    <li class="py-4 bg-gray-600 text-white text-center font-bold text-xl border-b-2 border-gray-300 select-none">اخبار قد تهمك</li>
    @foreach (App\News::random() as $item)
    <li class="py-3 px-4 text-white bg-gray-600 border-b border-gray-400 odd:bg-gray-500">
        <a href="{{ route('news.show', $item->slug) }}">
            {{ $item->title }}
        </a>
    </li>
    @endforeach
</ul>