<?php

namespace App\Http\Livewire\Store;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;
use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Models\LarashopProduct;
use CobraProjects\LaraShop\Models\LarashopCategory;

class Show extends Component
{
    use WithPagination;

    protected $listeners = ['searchSubmit'];

    public $categories;
    public $category;
    public $subCategories;
    public $selectedSubCategories = [];
    public $filters;
    public $selectedFilters = [];
    public $searchSubmited = false;
    public $search;

    public function mount($category)
    {
        $this->categories = LaraShop::getCategoryByParent();
        $this->category =  $category == null ? $this->categories->first() : LaraShop::getCategoryById($category);
    }

    public function render()
    {
        $products = $this->searchSubmited ? $this->updateDataForSearch() : $this->updateData();
        return view('livewire.store.show', compact('products'));
    }

    public function paginationView()
    {
        return 'vendor.pagination.tailwindLivewire';
    }

    public function updateData()
    {
        $this->subCategories = LaraShop::getCategoryByParent($this->category->id);
        $this->filters = count(array_filter($this->selectedSubCategories)) ? LaraShop::getSubCategoriesFilter(array_merge($this->selectedSubCategories, $this->selectedFilters)) : [];
        $products = count(array_filter($this->selectedSubCategories)) ? Larashop::getProductsInCategories($this->selectedSubCategories) : LaraShop::getCategoryProducts($this->category);
        $this->resetPage();
        return count(array_filter($this->selectedFilters)) ? Larashop::getProductsInCategories($this->selectedFilters) : $products;
    }

    public function updateDataForSearch()
    {
        if ($this->search) {
            $searchResults = $this->getSearchResults();

            $products = collect(new LarashopProduct);
            $allCategories = collect(new LarashopCategory);
            foreach ($searchResults as $value) {
                $product = $value->searchable;
                $cat = $product->larashopCategories->first();

                if (!$allCategories->contains('id', $cat->id)) {
                    $allCategories->add($cat);
                }
                $products->add($product);
            }

            $products = LarashopProduct::whereIn('id', $products->pluck('id')->all())->paginate(12);

            $this->subCategories = LaraShop::getSubCategoriesFilter($allCategories->pluck('id')->all());
            $this->filters = count(array_filter($this->selectedSubCategories)) ? LaraShop::getSubCategoriesFilter(array_merge($this->selectedSubCategories, $this->selectedFilters)) : [];
            return count(array_filter($this->selectedFilters)) ? Larashop::getProductsInCategories($this->selectedFilters) : $products;
        }
    }

    public function searchSubmit($search)
    {
        if (Str::length($search) > 3) {
            $this->search = $search;
            $this->searchSubmited = true;
        }
    }

    public function getSearchResults()
    {
        return (new Search())
            ->registerModel(LarashopProduct::class, function (ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('name') // return results for partial matches on usernames
                    ->addSearchableAttribute('description')
                    ->with('media')
                    ->shown();
            })
            ->search(trim($this->search));
    }
}
