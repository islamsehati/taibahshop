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

class PrintController extends Controller
{
    public function prinprview($id)
    {
        $order = Order::find($id);
        $orderitems = OrderItem::all()->where('order_id', $id);
        $addresses = Address::all()->where('order_id', $id)->take(1);
        $states = Province::all();
        $cities = City::all();
        $districts = District::all();
        $villages = Village::all();
        $paymentlast = Payment::latest()->get();
        $data = [
            'date' => date('d/m/Y'),
            'order' => $order,
            'orderitems' => $orderitems,
            'addresses' => $addresses,
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages,
            'paymentlast' => $paymentlast,
        ];
        return view('printorder', $data);;
    }
    public function prinprviewkitchen($id)
    {
        $order = Order::find($id);
        $orderitems = OrderItem::all()->where('order_id', $id);
        $contains = $orderitems->value('contain')->get();
        $data = [
            'date' => date('d/m/Y'),
            'order' => $order,
            'orderitems' => $orderitems,
            'contains' => $contains,
        ];
        return view('printorder-kitchen', $data);;
    }
}
