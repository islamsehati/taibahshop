<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Illuminate\Support\Facades\Auth;
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

    public function mount($slug)
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

    public function increaseQty()
    {
        $this->quantity++;
    }
    public function decreaseQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    // add product to cart method 
    public function addToCart($product_id)
    {
        if (Auth::check()) {
            CartManagement::addItemToCartWithQty($product_id, $this->quantity);
            $this->dispatch('update-cart-count', total_count: count(CartManagement::getCartItemsFromCart()))->to(Navbar::class);

            $this->alert('success', 'Cart Updated', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        } else {
            redirect('/login');
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
        return view(
            'livewire.partials.navbar',
            [
                'product' => Product::where('slug', $this->slug)->firstOrFail(),
                'orderitem' => $orderitems,
                'variants' => $variants,
            ]
        );
    }
}
