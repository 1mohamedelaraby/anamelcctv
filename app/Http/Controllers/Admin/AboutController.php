<?php

namespace App\Http\Controllers\Admin;

use App\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permitTo:Updateabout');
    }

    public function index()
    {
        $about = About::first();
        return view('adminAbout.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'about' => 'required',
            'vision' => 'required|max:250',
            'mession' => 'required|max:250',
            'maner' => 'required|max:250',
            'goals' => 'required',
        ]);

        About::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }
}
