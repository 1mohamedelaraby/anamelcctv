<?php

namespace App\Http\Controllers\Admin;

use App\Adv;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdvController extends Controller
{
    public function index()
    {
        $advs = Adv::all();
        return view('adminAdv.index', compact('advs'));
    }

    public function create()
    {
        return view('adminAdv.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable',
            'url' => 'required|url',
            'type' => 'required',
        ]);

        if ($request->img) {
            $img = Image::make($request->file('img'))->resize(300, 570)->encode('jpg');
            Storage::put('advs/' . $request->type . '.jpg', $img);
        }

        Adv::create($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }


    public function edit(Adv $adv)
    {
        return view('adminAdv.edit', compact('adv'));
    }

    public function update(Request $request, Adv $adv)
    {
        $data = $request->validate([
            'title' => 'nullable',
            'url' => 'required|url',
            'type' => 'required',
        ]);

        if ($request->img) {
            $img = Image::make($request->file('img'))->resize(300, 570)->encode('jpg');
            Storage::put('advs/' . $request->type . '.jpg', $img);
        }

        $adv->update($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function destroy(Adv $adv)
    {
        Storage::delete(['advs/' . $adv->type . '.jpg']);
        $adv->delete();
        return back()->with('success', 'تم الح1ف بنجاح');
    }
}
