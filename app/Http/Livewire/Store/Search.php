<?php

namespace App\Http\Livewire\Store;

use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Searchable\Search as S;
use Spatie\Searchable\ModelSearchAspect;
use CobraProjects\LaraShop\Models\LarashopProduct;

class Search extends Component
{
    public $search;
    public $showItems = false;

    public function searchSubmit()
    {
        $this->emit('searchSubmit', $this->search);
        $this->search = null;
    }

    public function render()
    {
        $results = [];
        if (Str::length($this->search) > 3) {
            $results = $this->getSearchResults();
            if ($results->count()) {
                $this->showItems = true;
            }
        }
        return view('livewire.store.search', compact('results'));
    }

    public function getSearchResults()
    {
        return (new S())
            ->registerModel(LarashopProduct::class, function (ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('name') // return results for partial matches on usernames
                    ->addSearchableAttribute('description')
                    ->with('media')
                    ->shown();
            })
            ->search(trim(str_replace(' ', '%', $this->search)))->take(12);
    }
}
