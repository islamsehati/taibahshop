<?php

namespace App\Livewire;

use App\Models\Branch;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('About Us & Branches')]
class BranchesPage extends Component
{
    public $cariBranch = '';

    public function render()
    {
        $branchQuery = Branch::query()->where('is_active', 1);

        return view('livewire.categories-page', [
            'branches' => $branchQuery,
            'cariBranch' => $this->cariBranch
        ]);
    }
}
