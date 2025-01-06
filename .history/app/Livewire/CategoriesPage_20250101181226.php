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
        $categories = Category::query()->where('is_active', 1);
        $brands = Brand::query()->where('is_active', 1);

        if (!empty($this->cariCat)) {
            $pencarian = $this->cariCat;
            $categories->where(function ($query) use ($pencarian) {
                $query->where('name', 'LIKE', '%' . $pencarian . '%');
            });
        }

        if (!empty($this->cariBrand)) {
            $brands->where('name', 'LIKE', "%$this->cariBrand%");
        }

        return view('livewire.categories-page', [
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
}
