<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;

#[Title('Register')]
class RegisterPage extends Component

{

    public $name;
    public $phone;
    public $email;
    public $password;

    public $state;
    public $city;
    public $district;
    public $village;
    public $street_address;
    public $zip_code;

    // regiter user
    public function register()
    {
        // dd($this->name, $this->email, $this->password);

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

        // save to database
        $user = new User();
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->created_oleh = 1;
        $user->updated_oleh = 1;

        $user->state = $this->state;
        $user->city = $this->city;
        $user->district = $this->district;
        $user->village = $this->village;
        $user->street_address = $this->street_address;
        $user->zip_code = $this->zip_code;
        $user->save();

        // login user
        Auth::login($user, true);
        // Auth::login($user);

        // redirect to homepage
        return redirect()->intended();
        // return redirect('/');
        // redirect()->route('login');
    }

    public function render()
    {
        $states = Province::all();
        $cities = City::all()->where('province_code', $this->state)->sortByDesc('name');
        $districts = District::all()->where('city_code', $this->city)->sortBy('name');
        $villages = Village::all()->where('district_code', $this->district)->sortBy('name');

        return view('livewire.auth.register-page', [
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages,
        ]);
    }
}
