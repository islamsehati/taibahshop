<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Livewire\Component;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

#[Title('Order Detail')]
class MyOrderDetailPage extends Component
{

    public $payment_method;
    public $input_payment;
    public $payment_method_edit;
    public $input_payment_edit;

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
        $data = Order::where('id', $id);

        $this->validate([
            'payment_method' => 'required',
            'input_payment' => 'required',
        ]);

        $payment = new Payment();
        $payment->date_payment = date('Y-m-d H:i:s');
        $payment->currency = 'idr';
        $payment->payment_method = $this->payment_method;
        $payment->nominal_plus = Str::replace('.', '', $this->input_payment);
        $payment->mutation_type = 'Sales';
        $payment->created_by = auth()->user()->id;
        $payment->updated_by = auth()->user()->id;
        $payment->branch_id = $data->value('branch_id');
        $payment->order_id = $id;
        $payment->save();

        $input_payment =  Str::replace('.', '', $this->input_payment);

        $grand_total = $data->value('grand_total');
        $total_payment_before = $data->value('total_payment');
        $total_payment = $total_payment_before + $input_payment;
        if ($grand_total - $total_payment <= 0) {
            $paidunpaid = 1;
        } else {
            $paidunpaid = 0;
        }
        $cashback = $total_payment - $grand_total;
        $update = [
            'is_paid' => $paidunpaid,
            'total_payment' => $total_payment,
            'total_cashback' => $cashback,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $data->update($update);
        redirect('/my-orders/' . $id);
    }

    public function editPayment($idpay)
    {
        $datapayment = Payment::where('id', $idpay);
        $data = Order::where('id', $datapayment->value('order_id'));

        $this->validate([
            'payment_method_edit' => 'required',
            'input_payment_edit' => 'required',
        ]);

        $updatepayment = [
            'date_payment' => date('Y-m-d H:i:s'),
            'payment_method' => $this->payment_method_edit,
            'nominal_plus' => Str::replace('.', '', $this->input_payment_edit),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => auth()->user()->id,
        ];

        $datapayment->update($updatepayment);

        $grand_total = $data->value('grand_total');
        $total_payment = $datapayment = Payment::where('id', $idpay)->sum('nominal_plus');
        if ($grand_total - $total_payment <= 0) {
            $paidunpaid = 1;
        } else {
            $paidunpaid = 0;
        }
        $cashback = $total_payment - $grand_total;
        $update = [
            'is_paid' => $paidunpaid,
            'total_payment' => $total_payment,
            'total_cashback' => $cashback,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $data->update($update);
        redirect('/my-orders/' . $datapayment->value('order_id'));
    }

    public function render()
    {
        $order_items = OrderItem::with('product')->where('order_id', $this->order)->get();
        $paymentslast = Payment::where('order_id', $this->order)->latest()->first();
        $address = Address::where('order_id', $this->order)->first();
        $address_firstname = Address::where('order_id', $this->order)->value('first_name');
        $address_lastname = Address::where('order_id', $this->order)->value('last_name');
        $order = Order::where('id', $this->order)->get()->first();
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
