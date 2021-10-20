<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Models\LarashopCategory;

class LarashopCategoryController extends Controller
{
    public function index(LarashopCategory $larashopCategory)
    {
        $category = $larashopCategory;

        return view('store.index.index', compact('category'));
    }
}
