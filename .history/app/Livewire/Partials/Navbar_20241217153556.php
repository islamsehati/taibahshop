<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $total_count = 0;
    public $cari = '';

    // produk detail
    use LivewireAlert;

    public $slug;
    public $name;
    public $quantity = 1;

    public function mount()
    {
        $this->total_count = count(CartManagement::getCartItemsFromCart());

        // produk detail
        $this->slug = $slug;

        $cart_items = CartManagement::getCartItemsFromCart();
        foreach ($cart_items as $item) {
            $quantitythis = $item['quantity'];
            if ($item['slug'] == $this->slug && $quantitythis > 0) {
                return $this->quantity = $item['quantity'];
            } else {
                $this->quantity = 1;
            }
        }
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count)
    {
        $this->total_count = $total_count;
    }

    public function cariProduk()
    {
        $cari = $this->cari;
        redirect("/products?cari={$cari}");
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
