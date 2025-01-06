<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Categories & Brands - TaibahShop')]

class CategoriesPage extends Component
{

    public function render()
    {
        $categoryQuery = Category::query()->where('is_active', 1)->get();
        $brandQuery = Brand::query()->where('is_active', 1)->get();

        return view('livewire.categories-page', [
            'categories' => $categoryQuery,
            'brands' => $brandQuery
        ]);
    }
}
