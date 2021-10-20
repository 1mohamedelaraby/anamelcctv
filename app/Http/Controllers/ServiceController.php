<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show(Service $service)
    {
        $images = $service->getMedia('images');
        return view('service', compact('service', 'images'));
    }
}
