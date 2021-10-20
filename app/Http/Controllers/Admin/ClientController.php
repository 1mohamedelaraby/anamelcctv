<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permitTo:CreateClient')->only('create');
        $this->middleware('permitTo:ReadClient')->only('index');
        $this->middleware('permitTo:UpdateClient')->only('edit');
        $this->middleware('permitTo:DeleteClient')->only('destroy');
    }

    public function index()
    {
        $clients = Client::all();
        return view('adminClients.index', compact('clients'));
    }

    public function create()
    {
        $order = Client::max('order') + 1;
        return view('adminClients.create', compact('order'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'url' => 'nullable',
            'logo' => 'nullable',
            'is_menu' => 'required',
            'order' => 'required|numeric',
        ]);

        $data['logo'] = $request->logo ? $this->uploadImage($request->logo) : null;
        Client::create($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(Client $client)
    {
        return view('adminClients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => 'required',
            'url' => 'nullable',
            'logo' => 'nullable',
            'is_menu' => 'required',
            'order' => 'required|numeric',
        ]);


        if ($request->logo) {
            Storage::delete($client->logo);
            $data['logo'] = $this->uploadImage($request->logo);
        }


        $client->update($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function destroy(Client $client)
    {
        Storage::delete($client->logo);
        $client->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }

    public function uploadImage($image)
    {
        $photo = Image::make($image)
            ->resize(null, 150, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('png');
        $path = 'client/' . Str::random() . '.png';
        Storage::put($path, $photo);

        return $path;
    }
}
