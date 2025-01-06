<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $total_count = 0;

    public function mount()
    {
        $this->total_count = count(Cart::all()->where('created_by', auth()->user()->id));
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count)
    {
        $this->total_count = $total_count;
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
