<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permitTo:CreateService')->only('create');
        $this->middleware('permitTo:ReadService')->only('index');
        $this->middleware('permitTo:UpdateService')->only('edit');
        $this->middleware('permitTo:DeleteService')->only('destroy');
    }

    public function index()
    {
        $services = Service::all();
        return view('adminServices.index', compact('services'));
    }

    public function create()
    {
        $order = Service::max('order') + 1;
        return view('adminServices.create', compact('order'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:services,slug',
            'short_desc' => 'required',
            'definition' => 'required',
            'usage' => 'required',
            'is_menu' => 'nullable',
            'order' => 'required|numeric',
        ]);

        $service = Service::create($data);

        if ($request->images) {
            $service->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('images');
                });
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(Service $service)
    {
        return view('adminServices.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:services,slug,' . $service->id,
            'short_desc' => 'required',
            'definition' => 'required',
            'usage' => 'required',
            'is_menu' => 'nullable',
            'order' => 'required|numeric',
        ]);


        $service->update($data);

        if ($request->images) {
            $service->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('images');
                });
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }

    public function deleteMedia(Media $media)
    {
        $media->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
