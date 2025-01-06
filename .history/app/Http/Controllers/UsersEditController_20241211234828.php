<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;

class UsersEditController extends Controller
{
    public function mount($id)
    {
        $users = User::all();
        $prov = Province::where('code', $users->where('id', $id)->value('state'))->value('name');
        $kab = City::where('code', $users->where('id', $id)->value('city'))->value('name');
        $kec = District::where('code', $users->where('id', $id)->value('district'))->value('name');
        $desa = Village::where('code', $users->where('id', $id)->value('village'))->value('name');
        $data = [
            'date' => date('d/m/Y'),
            'prov' => $prov,
            'kab' => $kab,
            'kec' => $kec,
            'desa' => $desa,
        ];
        return view('livewire.users-edit-page', $data);;
    }
}
