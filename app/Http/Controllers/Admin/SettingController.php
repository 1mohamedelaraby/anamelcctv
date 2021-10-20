<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permitTo:UpdateSetting');
    }

    public function index()
    {
        $setting = Setting::first();
        return view('adminSetting.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required|max:1000',
            'phone' => 'required',
            'email' => 'required',
            'whatsApp' => 'required|numeric',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'youtube' => 'required',
        ]);

        if ($request->visits) {
            Storage::put('visits.txt', $request->visits);
        }

        Setting::updateOrCreate(['id' => 1], $data);
        Cache::forget('settings');

        return back()->with('success', 'تم الحفظ بنجاح');
    }
}
