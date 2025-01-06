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
    // public $orderstatus;
    public $order;

    public function mount($order)
    {
        $this->order = $order;
    }

    public function update()
    {
        $order = Order::where('id', $this->order);
        $orderstatus = Order::where('id', $this->order)->value('status');
        if ($orderstatus = 'new') {
            $order->update([
                'status' => 'processing',
            ]);
        }
        if ($orderstatus = 'processing') {
            $order->update([
                'status' => 'shipped',
            ]);
        }
        if ($orderstatus = 'shipped') {
            $order->update([
                'status' => 'delivered',
            ]);
        }
        if ($orderstatus = 'delivered') {
            $order->update([
                'status' => 'canceled',
            ]);
        }
        if ($orderstatus = 'canceled') {
            $order->update([
                'status' => 'new',
            ]);
        }
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
        // dd($orderstatus);
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
