<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;

class MyAccountPage extends Component
{

    #[Url()]
    public $name;
    #[Url()]
    public $phone;
    #[Url()]
    public $email;
    #[Url()]
    public $password;

    #[Url()]
    public $state;
    #[Url()]
    public $city;
    #[Url()]
    public $district;
    #[Url()]
    public $village;
    #[Url()]
    public $street_address;
    #[Url()]
    public $zip_code;

    public function render()
    {
        return view('livewire.my-account-page');
    }
}
