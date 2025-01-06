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
    public $orderstatus = '';

    public function mount($order)
    {
        $this->order = $order;
        // $this->orderstatus = $order->status;
    }

    public function update()
    {
        $order = Order::where('id', $this->order);
        $order->update([
            'status' => $this->orderstatus,
        ]);
    }

    public function render()
    {
        $order_items = OrderItem::with('product')->where('order_id', $this->order)->get();
        $paymentslast = Payment::where('order_id', $this->order)->latest()->first();
        $address = Address::where('order_id', $this->order)->first();
        $order = Order::where('id', $this->order)->first();
        $orderstatus = Order::where('id', $this->order)->value('status');
        $user = User::all();
        $states = Province::all();
        $cities = City::all();
        $districts = District::all();
        $villages = Village::all();
        // dd($this->orderstatus);
        return view('livewire.my-order-detail-page', [
            'order_items' => $order_items,
            'paymentslast' => $paymentslast,
            'address' => $address,
            'order' => $order,
            'orderstatus' => $orderstatus,
            'user' => $user,
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages,
        ]);
    }
}
