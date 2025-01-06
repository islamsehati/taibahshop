<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
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
        $my_items = Product::where('branch_id', auth()->user()->branch_id)->orderBy('updated_at', 'desc')->paginate(500);

        return view('livewire.items-page', [
            'items' => $my_items,
        ]);
    }
}
