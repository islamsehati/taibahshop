<?php

namespace App\Livewire;

use App\Models\OrderItem;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;

#[Title('Items')]
class ItemsPage extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    #[Url()]
    public $date_awal;
    #[Url()]
    public $date_akhir;

    public function mount()
    {
        $isadmin = auth()->user()->is_admin;
        if ($isadmin == 0) {
            return redirect('/my-orders');
        }
    }

    public function render()
    {
        $dateAwal = $this->date_awal . ' 00-00-00';
        $dateAkhir = $this->date_akhir . ' 23-59-59';
        // dd($dateAkhir);

        $my_items = Product::where('branch_id', auth()->user()->branch_id)->orderBy('updated_at', 'desc')->paginate(500);
        $orderitems = OrderItem::query();

        return view('livewire.items-page', [
            'items' => $my_items,
            'orderitems' => $orderitems,
        ]);
    }
}
