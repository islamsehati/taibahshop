<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $total_count = 0;
    public $cari = '';

    public function mount()
    {
        $this->total_count = count(CartManagement::getCartItemsFromCart());
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count)
    {
        $this->total_count = $total_count;
    }

    public function cariProduk()
    {
        $cari = $this->cari;
        redirect('/products?cari={$cari}');
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
