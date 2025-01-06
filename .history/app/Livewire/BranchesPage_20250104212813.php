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
    public $cariBranch = '';

    public function render()
    {
        $branchQuery = Brand::query()->where('is_active', 1);

        return view('livewire.categories-page', [
            'branchQuery' => $branchQuery,
            'cariBranch' => $this->cariBranch
        ]);
    }
}
