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
    public $password = '';

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

    public function mount()
    {

        $this->name = User::where('id', auth()->user()->id)->value('name');
        $this->phone = User::where('id', auth()->user()->id)->value('phone');
        $this->email = User::where('id', auth()->user()->id)->value('email');

        if (auth()->user()->state != '') {
            $this->state = Province::where('province_code', User::where('id', auth()->user()->id)->value('state'))->value('name');
        } else {
            $this->state = '';
        }
        if (auth()->user()->city != '') {
            $this->city = City::where('province_code', User::where('id', auth()->user()->id)->value('city'))->value('name');
        } else {
            $this->city = '';
        }
        if (auth()->user()->district != '') {
            $this->district = District::where('province_code', User::where('id', auth()->user()->id)->value('district'))->value('name');
        } else {
            $this->district = '';
        }
        if (auth()->user()->village != '') {
            $this->village = Village::where('province_code', User::where('id', auth()->user()->id)->value('village'))->value('name');
        } else {
            $this->village = '';
        }
        $this->street_address = User::where('id', auth()->user()->id)->value('street_address');
        $this->zip_code = User::where('id', auth()->user()->id)->value('zip_code');
    }

    // update user
    public function updateMyAccount()
    {
        $this->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'district' => 'required|max:255',
            'village' => 'required|max:255',
            'street_address' => 'required|max:255',
        ]);
    }

    public function render()
    {
        $states = Province::all();
        $cities = City::all()->where('province_code', $this->state)->sortByDesc('name');
        $districts = District::all()->where('city_code', $this->city)->sortBy('name');
        $villages = Village::all()->where('district_code', $this->district)->sortBy('name');

        $users = User::all();

        return view('livewire.my-account-page', [
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages,
            'users' => $users,
        ]);
    }
}
