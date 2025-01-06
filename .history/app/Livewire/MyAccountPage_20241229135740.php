<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;

class MyAccountPage extends Component
{

    public function mount() {}


    public function render()
    {

        $users = User::all();

        return view('livewire.my-account-page', [
            'users' => $users,
        ]);
    }
}
