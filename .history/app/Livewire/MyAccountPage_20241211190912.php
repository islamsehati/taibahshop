<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;

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

    public function mount() {
        $states = Province::all();
        $cities = City::all()->where('province_code', $this->state)->sortByDesc('name');
        $districts = District::all()->where('city_code', $this->city)->sortBy('name');
        $villages = Village::all()->where('district_code', $this->district)->sortBy('name');
        $branches = Branch::all();

        $this->name = User::where('id', auth()->user()->id)->value('name');
        $this->phone = ;
        $this->email = ;
        $this->password = ;
        $this->state = ;
        $this->city = ;
        $this->district = ;
        $this->village = ;
        $this->street_address = ;
        $this->zip_code = ;

    }

    public function render()
    {
        return view('livewire.my-account-page',[

        ]);
    }
}
