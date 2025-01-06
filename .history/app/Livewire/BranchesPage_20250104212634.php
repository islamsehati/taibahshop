<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\JumboTron;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('About Us & Branches')]
class BranchesPage extends Component
{
    public $cariCat = '';
    public $cariBrn = '';

    public function render()
    {
        $jumbotrons = JumboTron::query()->where('is_active', 1)->where('target', 'category')->get();
        // dd($jumbotrons);
        $categoryQuery = Category::query()->where('is_active', 1);
        $brandQuery = Brand::query()->where('is_active', 1);

        return view('livewire.categories-page', [
            'jumbotrons' => $jumbotrons,
            'categories' => $categoryQuery,
            'brands' => $brandQuery,
            'cariCat' => $this->cariCat,
            'cariBrn' => $this->cariBrn
        ]);
    }
}
