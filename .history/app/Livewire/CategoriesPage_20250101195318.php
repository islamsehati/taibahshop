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
    use WithPagination;

    #[Url()]
    public $cariCat = '';

    // #[Url()]
    // public $cariBrand = '';

    public function render()
    {
        $categoryQuery = Category::query()->where('is_active', 1);
        $brandQuery = Brand::query()->where('is_active', 1)->get();

        if (!empty($this->cariCat)) {
            $pencarian = $this->cariCat;
            $categoryQuery
                ->where(function ($query) use ($pencarian) {
                    $query->where('name', 'LIKE', '%' . $pencarian . '%');
                    $query->orWhere('variant', 'LIKE', '%' . $pencarian . '%');
                    $query->orWhere('description', 'LIKE', '%' . $pencarian . '%');
                    $query->orWhere('tags', 'LIKE', '%' . $pencarian . '%');
                });
        }

        // if (!empty($this->cariBrand)) {
        //     $pencarianB = $this->cariBrand;
        //     $brandQuery->where(function ($query) use ($pencarianB) {
        //         $query->where('name', 'LIKE', '%' . $pencarianB . '%');
        //     });
        // }

        return view('livewire.categories-page', [
            'categories' => $categoryQuery->paginate(500),
            'brands' => $brandQuery
        ]);
    }
}
