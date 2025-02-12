<?php

namespace App\Livewire;

use App\Models\OrderItem;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Attributes\Url;

#[Title('Items')]
class ItemsPage extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    #[Url()]
    public $date_awal = '';
    #[Url()]
    public $date_akhir = '';

    public function mount()
    {
        $isadmin = auth()->user()->is_admin;
        if ($isadmin == 0) {
            return redirect('/my-orders');
        }
    }

    public function render()
    {

        if ($this->date_awal == '' || $this->date_akhir == '') {
            $date_awal = Carbon::now()->startOfMonth()->format('Y-m-d');
            $date_akhir = Carbon::now()->endOfMonth()->format('Y-m-d');
            // } else {
            //     $date_awal = $this->date_awal;
            //     $date_akhir = $this->date_akhir;
            $this->date_awal = $date_awal;
            $this->date_akhir = $date_akhir;
        }

        $products = Product::all();
        $orderitems = OrderItem::where('branch_id', auth()->user()->branch_id)
            ->whereBetween('updated_at', [$this->date_awal . ' 00-00-00', $this->date_akhir . ' 23-59-59'])
            ->whereNull('deleted_at')
            ->orderBy('product_id', 'asc')->get()
            ->where('order.status', '!=', 'canceled')->where('porder.status', '!=', 'canceled') # berhasil join dan ambil nilai status
            ->groupBy('product_id');

        return view('livewire.items-page', [
            'products' => $products,
            'items' => $orderitems
        ]);
    }
}
