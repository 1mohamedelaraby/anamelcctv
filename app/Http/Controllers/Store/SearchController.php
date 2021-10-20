<?php

namespace App\Http\Controllers\Store;

use App\Product;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Http\Controllers\Controller;
use Spatie\Searchable\ModelSearchAspect;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->q;

        $searchResults = (new Search())
            ->registerModel(\App\LarashopProduct::class, function (ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('name') // return results for partial matches on usernames
                    ->addSearchableAttribute('description')
                    ->shown();
            })
            ->search($search);

        return $searchResults;
        return view('store.search', compact('searchResults'));
    }
}
