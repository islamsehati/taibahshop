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
        $categoryQuery = Category::query()->where('is_active', 1);
        $brandQuery = Brand::query()->where('is_active', 1);

        if (!empty($this->cariCat)) {
            $pencarianC = $this->cariCat;
            $categoryQuery->where(function ($query) use ($pencarianC) {
                $query->where('name', 'LIKE', '%' . $pencarianC . '%');
            })->get();
        }
        if (!empty($this->cariBrand)) {
            $pencarianB = $this->cariBrand;
            $brandQuery->where(function ($query) use ($pencarianB) {
                $query->where('name', 'LIKE', '%' . $pencarianB . '%');
            })->get();
        }

        return view('livewire.categories-page', [
            'categories' => $categoryQuery,
            'brands' => $brandQuery
        ]);
    }
}
