<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Livewire\Component;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
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
        $grand_total = $data->value('grand_total');
        $totalpaid = Payment::where('order_id', $id)->sum('nominal_plus');
        $this->input_payment = Str::replace('.', '', $this->input_payment);

        if ($this->payment_method == null) {
            $payment_method = 'cash';
        } else {
            $payment_method = $this->payment_method;
        }

        if ($this->input_payment == null) {
            $input_payment = 0;
        } else {
            $input_payment = $this->input_payment;
        }

        if ($payment_method === 'transfer' && (($input_payment + $totalpaid) >= $grand_total)) {
            $payment_method = 'transfer';
            $input_payment = $grand_total - $totalpaid;
        } else {
            $payment_method = $payment_method;
            $input_payment = $input_payment;
        }

        $payment = new Payment();
        $payment->date_payment = date('Y-m-d H:i:s');
        $payment->currency = 'idr';
        $payment->payment_method = $payment_method;
        $payment->nominal_plus = $input_payment;
        $payment->mutation_type = 'Sales';
        $payment->created_by = auth()->user()->id;
        $payment->updated_by = auth()->user()->id;
        $payment->branch_id = $data->value('branch_id');
        $payment->order_id = $id;
        $payment->save();

        $total_payment_before = $data->value('total_payment');
        $total_payment = $total_payment_before + $input_payment;
        if ($grand_total - $total_payment <= 0) {
            $paidunpaid = 1;
            $paidat = date('Y-m-d H:i:s');
        } else {
            $paidunpaid = 0;
            $paidat = null;
        }
        $cashback = $total_payment - $grand_total;
        $update = [
            'is_paid' => $paidunpaid,
            'paid_at' => $paidat,
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
        $orderID = $datapayment->value('order_id');
        $totalpaid = Payment::where('order_id', $orderID)->where('id', '!=', $idpay)->sum('nominal_plus');
        $data = Order::where('id', $orderID);
        $grand_total = $data->value('grand_total');
        $this->input_payment_edit = Str::replace('.', '', $this->input_payment_edit);

        if ($this->payment_method_edit == null) {
            $payment_method_edit = 'cash';
        } else {
            $payment_method_edit = $this->payment_method_edit;
        }

        if ($this->input_payment_edit == null) {
            $input_payment_edit = 0;
        } else {
            $input_payment_edit = $this->input_payment_edit;
        }

        if ($payment_method_edit === 'transfer' && (($input_payment_edit + $totalpaid) >= $grand_total)) {
            $payment_method_edit = 'transfer';
            $input_payment_edit = $grand_total - $totalpaid;
        } else {
            $payment_method_edit = $payment_method_edit;
            $input_payment_edit = $input_payment_edit;
        }

        $updatepayment = [
            'date_payment' => date('Y-m-d H:i:s'),
            'payment_method' => $payment_method_edit,
            'nominal_plus' => $input_payment_edit,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => auth()->user()->id,
        ];

        $datapayment->update($updatepayment);

        $total_payment = Payment::where('order_id', $orderID)->sum('nominal_plus');
        if ($grand_total - $total_payment <= 0) {
            $paidunpaid = 1;
            $paidat = Payment::where('order_id', $orderID)->orderBy('date_payment', 'desc')->latest()->get()->value('date_payment');
        } else {
            $paidunpaid = 0;
            $paidat = null;
        }
        $cashback = $total_payment - $grand_total;
        $update = [
            'is_paid' => $paidunpaid,
            'paid_at' => $paidat,
            'total_payment' => $total_payment,
            'total_cashback' => $cashback,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $data->update($update);
        redirect('/my-orders/' . $orderID);
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
