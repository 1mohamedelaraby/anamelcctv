<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permitTo:CreateNews')->only('create');
        $this->middleware('permitTo:ReadNews')->only('index');
        $this->middleware('permitTo:UpdateNews')->only('edit');
        $this->middleware('permitTo:DeleteNews')->only('destroy');
    }

    public function index()
    {
        $news = News::with('media')->orderBy('id', 'DESC')->get();
        return view('adminNews.index', compact('news'));
    }

    public function create()
    {
        return view('adminNews.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:news,slug',
            'body' => 'required',
            'image' => 'required|mimes:jpeg,png',
            'featured' => 'nullable',
        ]);

        if ($request->featured == 1) {
            News::where('featured', 1)->update(['featured' => 0]);
            $data['featured'] = 1;
        }

        $news = News::create($data);

        if ($request->image) {
            $news->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(News $news)
    {
        return view('adminNews.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:news,slug,' . $news->id,
            'body' => 'required',
            'image' => 'nullable|mimes:jpeg,png',
            'featured' => 'nullable',
        ]);

        if ($request->featured == 1) {
            News::where('featured', 1)->update(['featured' => 0]);
            $data['featured'] = 1;
        }

        $news->update($data);

        if ($request->image) {
            $news->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
