<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;

class MyAccountPage extends Component
{
    use LivewireAlert, WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $photo;

    #[Url()]
    public $name;
    #[Url()]
    public $phone;
    #[Url()]
    public $email;
    public $password = '';

    public $state;
    public $city;
    public $district;
    public $village;
    public $street_address;
    public $zip_code;

    public function mount()
    {

        $this->name = User::where('id', auth()->user()->id)->value('name');
        $this->phone = User::where('id', auth()->user()->id)->value('phone');
        $this->email = User::where('id', auth()->user()->id)->value('email');

        $this->street_address = User::where('id', auth()->user()->id)->value('street_address');
        $this->zip_code = User::where('id', auth()->user()->id)->value('zip_code');

        if (auth()->user()->village != '') {
            $this->village = auth()->user()->village;
        }
        if (auth()->user()->district != '') {
            $this->district = auth()->user()->district;
        }
        if (auth()->user()->city != '') {
            $this->city = auth()->user()->city;
        }
        if (auth()->user()->state != '') {
            $this->state = auth()->user()->state;
        }
    }

    // update user
    public function updateMyAccount()
    {
        $this->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'district' => 'required|max:255',
            'village' => 'required|max:255',
            'street_address' => 'required|max:255',
        ]);

        $data = User::where('id', auth()->user()->id);
        if ($this->password != '') {
            $validate = [
                'image' => $this->photo,
                'name' => $this->name,
                'phone' => $this->phone,
                'password' => Hash::make($this->password),
                'state' => $this->state,
                'city' => $this->city,
                'district' => $this->district,
                'village' => $this->village,
                'street_address' => $this->street_address,
                'zip_code' => $this->zip_code,
            ];
        } else {
            $validate = [
                'image' => $this->photo,
                'name' => $this->name,
                'phone' => $this->phone,
                'state' => $this->state,
                'city' => $this->city,
                'district' => $this->district,
                'village' => $this->village,
                'street_address' => $this->street_address,
                'zip_code' => $this->zip_code,
            ];
        }
        $data->update($validate);

        $this->alert('success', 'Data Updated!', [
            'position' => 'top',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function changeState()
    {
        $this->city = "";
        $this->district = "";
        $this->village = "";
    }
    public function changeCity()
    {
        $this->district = "";
        $this->village = "";
    }
    public function changeDistrict()
    {
        $this->village = "";
    }

    public function render()
    {
        $states = Province::all();
        $cities = City::all()->where('province_code', $this->state)->sortByDesc('name');
        $districts = District::all()->where('city_code', $this->city)->sortBy('name');
        $villages = Village::all()->where('district_code', $this->district)->sortBy('name');
        $kab = City::all()->sortByDesc('name');
        $kec = District::all()->sortBy('name');
        $desa = Village::all()->sortBy('name');

        $users = User::all();

        return view('livewire.my-account-page', [
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages,
            'users' => $users,
            'kab' => $kab,
            'kec' => $kec,
            'desa' => $desa,
        ]);
    }
}
