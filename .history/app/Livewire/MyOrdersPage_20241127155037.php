<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Payment;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\PrintController;
use Illuminate\Support\Carbon;

#[Title('My Orders')]
class MyOrdersPage extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

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
        $my_orders_sum_today = Order::where('date_order', 'like', "%$today%")->where('is_paid', 1)->sum(value('grand_total'));
        $my_orders_sum_today_unpaid = Order::where('is_paid', 0)->where('status', '!=', 'canceled')->sum(value('grand_total'));
        $my_orders_sum_today_unpaid_count = Order::where('is_paid', 0)->where('status', '!=', 'canceled')->count();
        $payments = Payment::sortBy('date_payment', 'desc');

        return view('livewire.my-orders-page', [
            'orders' => $my_orders,
            'my_orders_sum' => $my_orders_sum,
            'my_orders_sum_today' => $my_orders_sum_today,
            'my_orders_sum_today_unpaid' => $my_orders_sum_today_unpaid,
            'my_orders_sum_today_unpaid_count' => $my_orders_sum_today_unpaid_count,
            'isadmin' => $isadmin,
            'today' => $today,
            'payments' => $payments,
        ]);
    }
}
