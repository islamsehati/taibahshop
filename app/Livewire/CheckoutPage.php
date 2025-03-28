<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Support\Str;

#[Title('Checkout')]
class CheckoutPage extends Component
{

    #[Url()]
    public $sales_type;
    #[Url()]
    public $branch_id;
    #[Url()]
    public $user_id;
    #[Url()]
    public $shipping_method;

    public $discount = 0;
    public $shipping_amount = 0;
    public $total_payment = 0;
    public $payment_method;
    public $notes;

    public $first_name;
    public $last_name;

    public $phone;

    #[Url()]
    public $street_address;
    #[Url()]
    public $village;
    #[Url()]
    public $district;
    #[Url()]
    public $city;
    #[Url()]
    public $state;
    #[Url()]
    public $zip_code;


    public function mount()
    {
        $cartitems = CartManagement::getCartItemsFromCart();
        if (count($cartitems) == 0) {
            return redirect('/products');
        }

        if (auth()->user()->phone != '') {
            $this->phone = auth()->user()->phone;
        }
        if (auth()->user()->street_address != '') {
            $this->street_address = auth()->user()->street_address;
        }
        if (auth()->user()->village != '') {
            $this->village = auth()->user()->village;
        }
        if (auth()->user()->district != '') {
            $this->district = auth()->user()->district;
        }
        if (auth()->user()->city != '') {
            $this->city = auth()->user()->city;
        }
        if (auth()->user()->state != '') {
            $this->state = auth()->user()->state;
        }
        if (auth()->user()->zip_code != '') {
            $this->zip_code = auth()->user()->zip_code;
        }
    }

    public function selectServis()
    {
        if ($this->shipping_method == 'dine_in') {
            $this->sales_type = 'dine_in';
        } elseif ($this->shipping_method == 'self_pickup') {
            $this->sales_type = 'self_pickup';
        } elseif ($this->shipping_method != 'dine_in' || $this->shipping_method != 'self_pickup') {
            $this->sales_type = 'delivery';
        } else {
            $this->sales_type = '';
        }

        $this->validate([
            'sales_type' => 'required',
        ]);
    }

    public function placeOrder()
    {

        $isadmin = auth()->user()->is_admin;

        $this->validate([
            'sales_type' => 'required',
            'payment_method' => 'required',
            'branch_id' => 'required',
        ]);

        if ($isadmin == 1) {
            if ($this->sales_type == 'self_pickup' || $this->sales_type == 'delivery') {
                $this->validate([
                    'user_id' => 'required',
                    'discount' => 'required|min:0',
                    'shipping_method' => 'required',
                    'shipping_amount' => 'required|min:0',
                    'total_payment' => 'required|min:0',
                ]);
            }
            if ($this->sales_type == 'dine_in') {
                $this->validate([
                    'user_id' => 'required',
                    'discount' => 'required|min:0',
                    'shipping_method' => 'required',
                    'shipping_amount' => 'required|min:0',
                    'total_payment' => 'required|min:0',
                ]);
            }
        }

        if ($isadmin == 0) {

            if ($this->sales_type == 'delivery') {
                $this->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'phone' => 'required',
                    'street_address' => 'required',
                    'village' => 'required',
                    'district' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    // 'zip_code' => 'required',
                ]);
            }

            if ($this->sales_type == 'self_pickup') {
                $this->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'phone' => 'required',
                ]);
            }
            if ($this->sales_type == 'dine_in') {
                $this->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'phone' => 'required',
                ]);
            }
        }

        $cart_items = CartManagement::getCartItemsFromCart()->where('branch_id', $this->branch_id);

        $order = new Order();
        $order->branch_id = $this->branch_id;
        $order->date_order = date('Y-m-d H:i:s');
        $order->code_tr = 'ORD' . date('YmdHis') . '-' . auth()->user()->id;
        $order->created_by = auth()->user()->id;
        $order->updated_by = auth()->user()->id;
        $order->grand_total = Cart::where('created_by', auth()->user()->id)->where('branch_id', $this->branch_id)->sum('total_amount') - Str::replace('.', '', $this->discount) + Str::replace('.', '', $this->shipping_amount);
        $order->sales_type = $this->sales_type;
        if (Str::replace('.', '', $this->total_payment) >= $order->grand_total) {
            $order->is_paid = 1;
            $order->paid_at = date('Y-m-d H:i:s');
        } else {
            $order->is_paid = 0;
            $order->paid_at = null;
        }
        if ($isadmin == 1) {
            $order->status = 'processing';
        } else {
            $order->status = 'new';
        }
        $order->notes =  $this->notes . PHP_EOL . PHP_EOL . 'Order placed by ' . PHP_EOL . auth()->user()->name . ' <' . auth()->user()->email . '>';
        // PHP_EOL untuk enter textarea
        if ($isadmin == 1) {
            $order->user_id = $this->user_id;
            $order->shipping_method = $this->shipping_method;
            $order->shipping_amount = Str::replace('.', '', $this->shipping_amount);
            $order->discount = Str::replace('.', '', $this->discount);
            if ($this->payment_method === 'transfer' && Str::replace('.', '', $this->total_payment) >= $order->grand_total) {
                $order->total_payment = $order->grand_total;
            } else {
                $order->total_payment = Str::replace('.', '', $this->total_payment);
            }
            $order->total_cashback = $order->total_payment - $order->grand_total;
        } else {
            $order->user_id = auth()->user()->id;
            $order->shipping_method = 'kurir_taibah';
            $order->shipping_amount = 0;
            $order->discount = 0;
            $order->total_payment = 0;
            $order->total_cashback = $order->total_payment - $order->grand_total;
        }

        $payment = new Payment();
        $payment->date_payment = date('Y-m-d H:i:s');
        $payment->currency = 'idr';
        $payment->payment_method = $this->payment_method;
        if ($this->payment_method === 'transfer' && Str::replace('.', '', $this->total_payment) >= $order->grand_total) {
            $payment->nominal_plus = $order->grand_total;
        } else {
            $payment->nominal_plus = Str::replace('.', '', $this->total_payment);
        }
        $payment->mutation_type = 'Sales';
        $payment->created_by = auth()->user()->id;
        $payment->updated_by = auth()->user()->id;
        $payment->branch_id = $this->branch_id;


        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->village = $this->village;
        $address->district = $this->district;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;

        $redirect_url = '';

        if ($this->payment_method == 'stripe') {
            $redirect_url = route('success');
        } else {
            $redirect_url = route('success');
        }

        $order->save();
        $payment->order_id = $order->id;
        $payment->save();
        $address->order_id = $order->id;
        $address->save();

        foreach ($cart_items as $item) {
            $order->items()->saveMany([
                new OrderItem([
                    'product_id' => $item['product_id'],
                    'unit_name' => $item['unit_name'],
                    'contain' => $item['contain'],
                    'quantity' => $item['quantity'],
                    'unit_amount' => $item['unit_amount'],
                    'total_amount' => $item['total_amount'],
                    'mutation_type' => 'Sales',
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'branch_id' => $this->branch_id,
                ]),
            ]);
        }

        CartManagement::clearCartItemsOnBranch($this->branch_id);

        if ($isadmin == 0) {
            // Mail::to(request()->user())->send(new OrderPlaced($order));
            Mail::to('taibah.fc@gmail.com')->send(new OrderPlaced($order));
        }

        $this->user_id = '';
        $this->payment_method = '';
        return redirect($redirect_url);
    }

    public function refreshAddress()
    {
        $this->dispatch('checkout-page');
    }
    public function removeItem($product_id)
    {
        CartManagement::removeCartItem($product_id);
        $this->dispatch('$refresh');
    }

    public function changeState()
    {
        $this->city = "";
        $this->district = "";
        $this->village = "";
    }
    public function changeCity()
    {
        $this->district = "";
        $this->village = "";
    }
    public function changeDistrict()
    {
        $this->village = "";
    }


    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCart()->where('branch_id', $this->branch_id);
        $subtotal = Cart::where('created_by', auth()->user()->id)->where('branch_id', $this->branch_id)->sum('total_amount');
        $discount = intval(Str::replace('.', '', $this->discount));
        $shipping_amount = intval(Str::replace('.', '', $this->shipping_amount));
        $grand_total = $subtotal - $discount + $shipping_amount;
        $total_payment =  intval(Str::replace('.', '', $this->total_payment));
        $total_cashback = $total_payment - $grand_total;
        $states = Province::all();
        $cities = City::all()->where('province_code', $this->state)->sortByDesc('name');
        $districts = District::all()->where('city_code', $this->city)->sortBy('name');
        $villages = Village::all()->where('district_code', $this->district)->sortBy('name');

        $users = User::all();
        $branches = Branch::all();
        $products = Product::all();

        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'subtotal' => $subtotal,
            'grand_total' => $grand_total,
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages,
            'users' => $users,
            'branches' => $branches,
            'discount' => $discount,
            'shipping_amount' => $shipping_amount,
            'total_cashback' => $total_cashback,
            'total_payment' => $total_payment,
            'products' => $products,
        ]);
    }
}
