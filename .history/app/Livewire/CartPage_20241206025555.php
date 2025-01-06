<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Branch;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart - TaibahShop')]
class CartPage extends Component
{

    public $cart_items = [];
    public $grand_total;
    public $quantity = [];

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromCart();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function clearItem()
    {
        $this->cart_items = CartManagement::clearCartItems();
        return redirect('/cart');
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
        $this->dispatch('cart-page');
    }

    public function increaseQty($product_id)
    {
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('cart-page');
    }
    public function decreaseQty($product_id)
    {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('cart-page');
    }

    public function typeQty($product_id, $quantity)
    {
        dd($quantity);

        $this->cart_items = CartManagement::typingQuantityToCartItem($product_id, $quantity);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('cart-page');
    }

    public function render()
    {
        $branches = Branch::all();
        return view('livewire.cart-page', [
            'branches' => $branches,
        ]);
    }
}
