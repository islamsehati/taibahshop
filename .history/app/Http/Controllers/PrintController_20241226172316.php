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
use Illuminate\Support\Str;

class PrintController extends Controller
{
    public function prinprview($id)
    {
        $order = Order::find($id);
        $orderitems = OrderItem::all()->where('order_id', $id);
        $address = Address::all()->where('order_id', $id)->take(1);
        $states = Province::all();
        $cities = City::all();
        $districts = District::all();
        $villages = Village::all();
        $paymentlast = Payment::orderBy('date_payment', 'desc')->get();
        $user = User::where('id', $order->user_id)->get();
        $data = [
            'date' => date('d/m/Y'),
            'order' => $order,
            'orderitems' => $orderitems,
            'address' => $address,
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages,
            'paymentlast' => $paymentlast,
            'user' => $user,
        ];
        return view('printorder', $data);;
    }
    public function prinprviewkitchen($id)
    {
        $order = Order::find($id);
        $orderitems = OrderItem::all()->where('order_id', $id);
        $data = [
            'date' => date('d/m/Y'),
            'order' => $order,
            'orderitems' => $orderitems,
        ];
        return view('printorder-kitchen', $data);;
    }
}
