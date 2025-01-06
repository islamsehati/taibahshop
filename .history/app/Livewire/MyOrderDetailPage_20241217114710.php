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
use Illuminate\Support\Str;

#[Title('Order Detail')]
class MyOrderDetailPage extends Component
{

    public $payment_method;
    public $input_payment;
    public $branch;
    public $grand_total;
    public $total_payment;
    public $total_cashback;

    public function mount($order)
    {
        $this->order = $order;
        $user_id = Order::where('id', $this->order)->value('user_id');
        if ($user_id != auth()->user()->id && auth()->user()->is_admin == 0) {
            return redirect('/my-orders');
        }
    }

    public function addPayment($id)
    {
        $this->validate([
            'payment_method' => 'required',
            'total_payment' => 'required',
        ]);

        $payment = new Payment();
        $payment->date_payment = date('Y-m-d H:i:s');
        $payment->currency = 'idr';
        $payment->payment_method = $this->payment_method;
        $payment->nominal_plus = Str::replace('.', '', $this->total_payment);
        $payment->mutation_type = 'Sales';
        $payment->created_by = auth()->user()->id;
        $payment->updated_by = auth()->user()->id;
        $payment->branch_id = auth()->user()->branch_id;
        $payment->order_id = $id;
        $payment->save();
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
