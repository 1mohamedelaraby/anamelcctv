<?php

namespace App\Http\Controllers;

use App\City;
use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = auth()->user()->addresses;
        return view('address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::orderBy('name', 'ASC')->get();
        return view('address.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'city_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'area' => 'nullable',
            'street_no' => 'nullable',
            'building' => 'nullable',
            'floor' => 'nullable',
            'apartment' => 'nullable',
            'nearest' => 'nullable',
            'postcode' => 'nullable',
            'notes' => 'nullable',
            'primary' => 'nullable',
        ]);

        if (!Address::where('primary', 1)->count()) {
            $data['primary'] = 1;
        }

        auth()->user()->addresses()->create($data);
        return redirect()->route('address.index')->with('success', 'تم اضافة العنوان بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        $cities = City::orderBy('name', 'ASC')->get();
        return view('address.edit', compact('cities', 'address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $data = $request->validate([
            'city_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'area' => 'nullable',
            'street_no' => 'nullable',
            'building' => 'nullable',
            'floor' => 'nullable',
            'apartment' => 'nullable',
            'nearest' => 'nullable',
            'postcode' => 'nullable',
            'notes' => 'nullable',
            'primary' => 'nullable',
        ]);

        $address->update($data);
        return redirect()->route('address.index')->with('success', 'تم تعديل العنوان بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return back()->with('success', 'تم حذف العنوان بنجاح');
    }

    public function primary(Address $address)
    {
        Address::where('primary', 1)->update(['primary' => 0]);
        $address->primary = 1;
        $address->save();

        return back()->with('success', 'تم تعين العنوان الافتراضي');
    }
}
