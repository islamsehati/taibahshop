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
    public $cariCat;

    #[Url()]
    public $cariBrand;

    public function render()
    {
        $categoriesQ = Category::query()->where('is_active', 1);
        $brandsQ = Brand::query()->where('is_active', 1);

        if (!empty($this->cariCat)) {
            $categories = $categoriesQ->where('name', 'LIKE', "%$this->cariCat");
        } else {
            $categories = $categoriesQ;
        }

        if (!empty($this->cariBrand)) {
            $brands = $brandsQ->where('name', 'LIKE', "%$this->cariBrand%");
        } else {
            $brands = $brandsQ;
        }

        return view('livewire.categories-page', [
            'categories' => $categoriesQ,
            'brands' => $brandsQ
        ]);
    }
}
