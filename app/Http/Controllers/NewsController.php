<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $featured = News::firstWhere('featured', 1);
        $news = News::with('media')->where('featured', 0)->latest()->paginate(12);
        return view('news.index', compact('news', 'featured'));
    }

    public function show(News $news)
    {
        visits($news)->increment();
        return view('news.show', compact('news'));
    }
}
