<?php

namespace App\Livewire;

use App\Models\Branch;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('About Us & Branches')]
class BranchesPage extends Component
{
    public $cariBranch = '';

    // change Branch in User
    public function changeBranch()
    {
        $data = User::where('id', auth()->user()->id);

        if (auth()->user()->is_admin == 1) {
            $update = [
                'branch_id' => auth()->user()->branch_id,
            ];
        } else {
            $update = [
                'branch_id' => $this->branch,
            ];
        }
        $data->update($update);
    }

    public function render()
    {
        $branchQuery = Branch::query()->where('is_active', 1);

        return view('livewire.branches-page', [
            'branches' => $branchQuery,
            'cariBranch' => $this->cariBranch
        ]);
    }
}
