<?php

namespace App\Http\Controllers\Admin;

use App\GoogleReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permitTo:CreateTestimonial')->only('create');
        $this->middleware('permitTo:ReadTestimonial')->only('index');
        $this->middleware('permitTo:UpdateTestimonial')->only('edit');
        $this->middleware('permitTo:DeleteTestimonial')->only('destroy');
    }

    public function index()
    {
        $googleReviews = GoogleReview::all();
        return view('adminTestimonial.index', compact('googleReviews'));
    }

    public function create()
    {
        return view('adminTestimonial.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'author_name' => 'required',
            'text' => 'required',
            'rating' => 'required',
            'profile_photo_url' => 'nullable',
            'status' => 'nullable',
        ]);

        $data['profile_photo_url'] = !$data['profile_photo_url'] ? 'https://lh3.googleusercontent.com/a/default-user=s128-c0x00000000-cc-rp-mo' : $data['profile_photo_url'];
        $data['author_url'] = 'not_found';
        $data['time'] = 0;
        GoogleReview::create($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(GoogleReview $googleReview)
    {
        return view('adminTestimonial.edit', compact('googleReview'));
    }

    public function update(Request $request, GoogleReview $googleReview)
    {
        $data = $request->validate([
            'author_name' => 'required',
            'text' => 'required',
            'rating' => 'required',
            'profile_photo_url' => 'nullable',
            'status' => 'nullable',
        ]);

        $data['profile_photo_url'] = !$data['profile_photo_url'] ? 'https://lh3.googleusercontent.com/a/default-user=s128-c0x00000000-cc-rp-mo' : $data['profile_photo_url'];
        $data['author_url'] = 'not_found';
        $data['time'] = 0;
        $googleReview->update($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function destroy(GoogleReview $googleReview)
    {
        $googleReview->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
