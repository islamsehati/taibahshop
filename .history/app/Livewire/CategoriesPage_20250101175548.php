<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Categories & Brands - TaibahShop')]

class CategoriesPage extends Component
{

    #[Url()]
    public $cariCat = '';

    #[Url()]
    public $cariBrand = '';

    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();
        return view('livewire.categories-page', [
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
}
