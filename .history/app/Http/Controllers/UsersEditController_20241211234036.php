<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;

class UsersEditController extends Controller
{
    public function mount($id)
    {
        $prov = Province::all();
        $kab = City::where('code', $this->state)->vlaue('name');
        $kec = District::all();
        $desa = Village::all();
        $data = [
            'date' => date('d/m/Y'),
            'prov' => $prov,
            'kab' => $kab,
            'kec' => $kec,
            'desa' => $desa,
        ];
        return view('users-edit-page', $data);;
    }
}
