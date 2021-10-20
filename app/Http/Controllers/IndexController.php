<?php

namespace App\Http\Controllers;

use App\About;
use App\Adv;
use App\Brand;
use App\Client;
use App\Helpers\GoogleReviews;
use App\Setting;
use App\Video;
use CobraProjects\LaraShop\Models\LarashopProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index(GoogleReviews $googleReviews)
    {
        $data['about'] = About::first();
        $data['brands'] = Brand::orderBy('order', 'ASC')->limit(8)->get();
        $data['clients'] = Client::orderBy('order', 'ASC')->where('is_menu', 1)->get();
        $data['new'] = LarashopProduct::where('hidden', 0)->where('new', 1)->get();
        $data['reviews'] = $googleReviews->reviews->where('status', 1)->take(8);
        $data['reviewsTotal'] = $googleReviews->reviewsTotal;
        $data['avgRating'] = $googleReviews->avgRating;

        $data['videos'] = Video::latest()->get();
        $data['adv'] = Adv::all();

        $data['visits'] = $this->setVisits();

        return view('index.main', compact('data'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $email = @Setting::first()->email;
        Mail::raw($request->message, function ($message) use ($request, $email) {
            $message->from($request->email, $request->first_name . ' ' . $request->last_name);
            $message->sender($request->email, $request->first_name . ' ' . $request->last_name);
            $message->to($email, @Setting::first()->name);
            $message->replyTo($request->email, $request->first_name . ' ' . $request->last_name);
            $message->subject('From Ananel CCTV website contact page.');
            $message->priority(3);
        });

        return back()->with('success', 'شكرا لتواصللكم معنا وسيتم الرد على رسالتكم قريباً');
    }

    public function setVisits()
    {
        $count = 1250;
        if (Storage::has('visits.txt')) {
            $count = Storage::get('visits.txt');
            $count++;
            Storage::put('visits.txt', $count);
        } else {
            Storage::put('visits.txt', $count);
        }

        return $count;
    }
}
