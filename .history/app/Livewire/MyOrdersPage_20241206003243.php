<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Payment;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\PrintController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

#[Title('My Orders')]
class MyOrdersPage extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public $id;

    public function changeStatus($id)
    {
        if (Auth::check()) {
            if (auth()->user()->is_admin == 1) {
                $data = Order::where('id', $id);
                $statusnow = $data->value('status');
                if ($statusnow == 'new') {
                    $update = ['status' => 'processing',];
                }
                if ($statusnow == 'processing') {
                    $update = ['status' => 'shipped',];
                }
                if ($statusnow == 'shipped') {
                    $update = ['status' => 'delivered',];
                }
                if ($statusnow == 'delivered') {
                    $update = ['status' => 'canceled',];
                }
                if ($statusnow == 'canceled') {
                    $update = ['status' => 'new',];
                }
                $data->update($update);
            } else {
                $data = Order::where('id', $id);
                $update = ['status' => 'delivered',];
                $data->update($update);
            }
        }
    }

    public function render()
    {
        $isadmin = auth()->user()->is_admin;
        if ($isadmin == 1) {
            $my_orders = Order::orderBy('is_paid')->orderBy('date_order', 'desc')->paginate(100);
        }
        if ($isadmin == 0) {
            $my_orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
        }
        $my_orders_all = Order::where('user_id', auth()->id());
        $my_orders_sum = $my_orders_all->sum(value('grand_total'));
        $today = Carbon::now()->format('Y-m-d');
        $my_orders_sum_today_unpaid = Order::where('is_paid', 0)->where('status', '!=', 'canceled')->sum(value('total_cashback'));
        $my_orders_sum_today_unpaid_count = Order::where('is_paid', 0)->where('status', '!=', 'canceled')->count();
        $paymentlast = Payment::latest()->get();
        $paymentcash = Payment::where('date_payment', 'like', "%$today%")->where('payment_method', '=', 'cash')->sum(value('nominal_plus'));
        $paymenttf = Payment::where('date_payment', 'like', "%$today%")->where('payment_method', '=', 'transfer')->sum(value('nominal_plus'));
        $my_orders_sum_cashback = Order::where('updated_at', 'like', "%$today%")->where('is_paid', 1)->where('total_cashback', '>', 'cash')->sum(value('total_cashback'));

        return view('livewire.my-orders-page', [
            'orders' => $my_orders,
            'my_orders_sum' => $my_orders_sum,
            'my_orders_sum_cashback' => $my_orders_sum_cashback,
            'my_orders_sum_today_unpaid' => $my_orders_sum_today_unpaid,
            'my_orders_sum_today_unpaid_count' => $my_orders_sum_today_unpaid_count,
            'isadmin' => $isadmin,
            'today' => $today,
            'paymentlast' => $paymentlast,
            'paymentcash' => $paymentcash,
            'paymenttf' => $paymenttf,
        ]);
    }
}
