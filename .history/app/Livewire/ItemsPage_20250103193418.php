<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Payment;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\PrintController;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

#[Title('Items')]
class ItemsPage extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $isadmin = auth()->user()->is_admin;
        if ($isadmin == 1) {
            $my_orders = Order::where('branch_id', auth()->user()->branch_id)->where('is_paid', 1)->orderBy('date_order', 'desc')->paginate(500);
        }
        if ($isadmin == 0) {
            $my_orders = Order::where('user_id', auth()->id())->latest()->paginate(100);
        }
        $orders_all = Order::all();

        return view('livewire.items-page', [
            'orders' => $my_orders,
            'orders_all' => $orders_all,
            'isadmin' => $isadmin,
        ]);
    }
}
