<?php

namespace App\Livewire;

use App\Models\OrderItem;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

#[Title('Items')]
class ItemsPage extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $isadmin = auth()->user()->is_admin;
        if ($isadmin == 0) {
            return redirect('/my-orders');
        }
    }

    public function render()
    {

        $my_items = Product::where('branch_id', auth()->user()->branch_id)->orderBy('updated_at', 'desc')->paginate(500);
        $orderitems = OrderItem::where('branch_id', auth()->user()->branch_id)
            ->whereNull('deleted_at')
            ->where('updated_at', 'like', "%$today%")
            ->orderBy('product_id', 'asc')->get()
            ->groupBy('product_id');
        // $orderitems = OrderItem::leftJoin('orders', 'order_items.id', '=', 'orders.id')
        //     ->leftJoin('porders', 'order_items.id', '=', 'porders.id')
        //     ->get()
        //     ->where('order.status', '!=', 'canceled')->where('porder.status', '!=', 'canceled');

        return view('livewire.items-page', [
            'items' => $my_items,
            'orderitems' => $orderitems
        ]);
    }
}
