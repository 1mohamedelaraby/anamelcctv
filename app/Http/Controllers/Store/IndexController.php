<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use CobraProjects\LaraShop\Facades\LaraShop;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $category = null;

        return view('store.index.index', compact('category'));
    }
}
