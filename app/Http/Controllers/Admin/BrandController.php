<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permitTo:CreateBrand')->only('create');
        $this->middleware('permitTo:ReadBrand')->only('index');
        $this->middleware('permitTo:UpdateBrand')->only('edit');
        $this->middleware('permitTo:DeleteBrand')->only('destroy');
    }

    public function index()
    {
        $brands = Brand::all();
        return view('adminBrands.index', compact('brands'));
    }

    public function create()
    {
        $order = Brand::max('order') + 1;
        return view('adminBrands.create', compact('order'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'descripiton' => 'nullable',
            'logo' => 'nullable',
            'order' => 'required|numeric',
        ]);

        $data['logo'] = $request->logo ? $this->uploadImage($request->logo) : null;
        Brand::create($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(Brand $brand)
    {
        return view('adminBrands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => 'required',
            'descripiton' => 'nullable',
            'logo' => 'nullable',
            'order' => 'required|numeric',
        ]);

        if ($request->logo) {
            Storage::delete($brand->logo);
            $data['logo'] = $this->uploadImage($request->logo);
        }

        $brand->update($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function destroy(Brand $brand)
    {
        Storage::delete($brand->logo);
        $brand->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }

    public function uploadImage($image)
    {
        $photo = Image::make($image)
            ->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('png');
        $path = 'brand/' . Str::random() . '.png';
        Storage::put($path, $photo);

        return $path;
    }
}
