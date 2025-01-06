<?php

namespace App\Livewire;

use App\Models\Order;
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
            $my_orders = Order::latest()->paginate(10);
        }
        if ($isadmin == 0) {
            $my_orders = Order::where('user_id', auth()->id())->latest()->paginate(5);
        }
        $my_orders_all = Order::where('user_id', auth()->id());
        $my_orders_sum = $my_orders_all->sum(value('grand_total'));
        $today = Carbon::now()->format('Y-m-d');
        $my_orders_sum_today = Order::where('date_order', 'like', "%$today%")->sum(value('grand_total'));
        return view('livewire.my-orders-page', [
            'orders' => $my_orders,
            'my_orders_sum' => $my_orders_sum,
            'my_orders_sum_today_cash' => $my_orders_sum_today_cash,
            'my_orders_sum_today_transfer' => $my_orders_sum_today_transfer,
            'my_orders_sum_today_unpaid' => $my_orders_sum_today_unpaid,
            'my_orders_sum_today_unpaid_count' => $my_orders_sum_today_unpaid_count,
            'isadmin' => $isadmin,
            'today' => $today,
        ]);
    }
}
