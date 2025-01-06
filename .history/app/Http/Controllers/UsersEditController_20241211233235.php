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
    public function prinprview($id)
    {
        $states = Province::all();
        $cities = City::all();
        $districts = District::all();
        $villages = Village::all();
        $data = [
            'date' => date('d/m/Y'),
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages,
        ];
        return view('printorder', $data);;
    }
}
