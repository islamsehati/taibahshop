<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Branch;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart - TaibahShop')]
class CartPage extends Component
{

    public $cart_items = [];
    public $grand_total;
    public $quantity = [];
    public $thisqty;

    public function mount()
    {
        if (Auth::check()) {
            $this->cart_items = CartManagement::getCartItemsFromCart();
            $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        } else {
            return redirect('/login');
        }
    }

    public function clearItem()
    {
        $this->cart_items = CartManagement::clearCartItems();
        return redirect('/cart');
    }
    public function clearItemByBranch($branch_id)
    {
        $this->cart_items = CartManagement::clearCartItemsOnBranch($branch_id);
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

    public function typeQty($id)
    {
        $thisqty = $this->thisqty;
        if ($thisqty <= 1) {
            $thisqty = 1;
        }
        $this->cart_items = CartManagement::typingQuantityToCartItem($id, $thisqty);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('cart-page');
    }

    public function render()
    {
        $grup_items = Cart::where('created_by', auth()->user()->id)
            ->groupBy('branch_id')
            ->selectRaw('count(*) as total, branch_id')
            ->get();
        $branches = Branch::all();
        return view('livewire.cart-page', [
            'branches' => $branches,
            'grup_items' => $grup_items,
        ]);
    }
}
