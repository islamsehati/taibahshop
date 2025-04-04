<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('About Us & Branches')]
class BranchesPage extends Component
{
    public $cariBranch = '';

    // change Branch in User
    public function changeBranch($branch_id)
    {

        if (Auth::check()) {
            $data = User::where('id', auth()->user()->id);

            if (auth()->user()->is_admin == 1) {
                $update = [
                    'branch_id' => auth()->user()->branch_id,
                ];
            } else {
                $update = [
                    'branch_id' => $branch_id,
                ];
            }
            $data->update($update);

            return redirect('/products?branch=' . $branch_id);
        } else {
            return redirect('/products?branch=' . $branch_id);
        }
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
