<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;

class UsersEditPage extends Component
{
    use LivewireAlert;

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

    public function mount($id)
    {
        $users = User::all();
        $prov = Province::where('code', $users->where('id', $id)->value('state'))->value('name');
        $kab = City::where('code', $users->where('id', $id)->value('city'))->value('name');
        $kec = District::where('code', $users->where('id', $id)->value('district'))->value('name');
        $desa = Village::where('code', $users->where('id', $id)->value('village'))->value('name');
    }

    // update user
    public function userEdit()
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

    public function render()
    {
        $states = Province::all();
        $cities = City::all()->where('province_code', $this->state)->sortByDesc('name');
        $districts = District::all()->where('city_code', $this->city)->sortBy('name');
        $villages = Village::all()->where('district_code', $this->district)->sortBy('name');
        $users = User::all();
        return view('livewire.users-edit-page', [
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages,
            'users' => $users,
        ]);
    }
}
