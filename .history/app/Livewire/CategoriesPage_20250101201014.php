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
    #[Url()]
    public $cariCat = '';
    #[Url()]
    public $cariBrn = '';

    public function render()
    {
        $categoryQuery = Category::query()->where('is_active', 1);
        $brandQuery = Brand::query()->where('is_active', 1);

        return view('livewire.categories-page', [
            'categories' => $categoryQuery,
            'brands' => $brandQuery,
            'cariCat' => $this->cariCat,
            'cariBrn' => $this->cariBrn
        ]);
    }
}
