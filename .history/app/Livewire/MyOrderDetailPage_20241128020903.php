<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;

#[Title('Order Detail')]
class MyOrderDetailPage extends Component
{

    public $order;
    public $status;

    public function mount($order)
    {
        $this->order = $order;
    }

    public function changestatus()
    {
        $orderID = Order::find($this->order);
        $status = Order::where('id', $orderID)->value('status');
        if ($status != 'delivered') {
            $orderID->update([
                'status' => 'delivered',
            ]);
        }
    }

    public function render()
    {
        $order_items = OrderItem::with('product')->where('order_id', $this->order)->get();
        $paymentslast = Payment::where('order_id', $this->order)->latest()->first();
        $address = Address::where('order_id', $this->order)->first();
        $address_firstname = Address::where('order_id', $this->order)->value('first_name');
        $address_lastname = Address::where('order_id', $this->order)->value('last_name');
        $order = Order::where('id', $this->order)->first();
        $user = User::all();
        $states = Province::all();
        $cities = City::all();
        $districts = District::all();
        $villages = Village::all();
        $payments = Payment::all();
        return view('livewire.my-order-detail-page', [
            'order_items' => $order_items,
            'paymentslast' => $paymentslast,
            'payments' => $payments,
            'address' => $address,
            'address_firstname' => $address_firstname,
            'address_lastname' => $address_lastname,
            'order' => $order,
            'user' => $user,
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages,
        ]);
    }
}
