<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\OrderItem;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - TaibahShop')]
class ProductDetailPage extends Component
{
    use LivewireAlert;

    public $slug;
    public $name;
    public $quantity = 1;

    public function mount($slug)
    {
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
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Cart Updated', [
            'position' => 'bottom',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function render()
    {
        $varget = Product::where('slug', $this->slug)->get('name');
        $varvalue = $varget->value('name');
        // $variants = Product::where('is_active', 1)->where('name', '=', $varvalue)->where('slug', 'not like', $this->slug)->get();
        $variants = Product::where('is_active', 1)->where('name', '=', $varvalue)->get();
        $orderitems = OrderItem::all();

        return view(
            'livewire.product-detail-page',
            [
                'product' => Product::where('slug', $this->slug)->firstOrFail(),
                'orderitem' => $orderitems,
                'variants' => $variants,
            ]
        );
    }
}
