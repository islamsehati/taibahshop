<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Support\Number;

#[Title('POS - TaibahShop.com')]
class PosPage extends Component
{

    use WithPagination;

    #[Url()]
    public $selected_categories = [];

    #[Url()]
    public $selected_brands = [];

    #[Url()]
    public $featured = [];

    #[Url()]
    public $promo = [];

    #[Url()]
    public $price_range = 10000000;

    public $sort = 'latest';

    #[Url()]
    public $cari = '';

    #[Url()]
    public $branch;

    #[Url()]
    public $page = '';

    public $cart_items = [];
    public $grand_total;
    public $quantity = [];
    public $thisqty;


    public function mount()
    {
        if (Auth::check()) {
            if (auth()->user()->is_admin == 1) {
                $this->cart_items = CartManagement::getCartItemsFromCart()->where('branch_id', auth()->user()->branch_id);
                $this->grand_total = CartManagement::calculateGrandTotalByBranch($this->cart_items);
            } else {
                return redirect('/products');
            }
        } else {
            return redirect('/login');
        }

        if (Auth::check()) {
            if (auth()->user()->branch != '') {
                $this->branch = auth()->user()->branch_id;
            } else {
                $this->branch = '';
            }
        }
    }

    #[On('pos-page-list')]
    public function updateCartList($items_list)
    {
        $this->cart_items = $items_list;
        $this->grand_total = CartManagement::calculateGrandTotalByBranch($this->cart_items);
    }

    // add product to cart method
    public function addToCart($product_id)
    {
        if (Auth::check()) {
            CartManagement::addItemToCartWithQtyOnPos($product_id, $this->thisqty);
            $this->dispatch('pos-page-list', items_list: CartManagement::getCartItemsFromCart()->where('branch_id', auth()->user()->branch_id));
            $this->thisqty = '';
            // $this->dispatch('pos-page');
        } else {
            redirect('/login');
        }
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotalByBranch($this->cart_items);
        $this->dispatch('pos-page-list', items_list: CartManagement::getCartItemsFromCart()->where('branch_id', auth()->user()->branch_id));
    }

    public function clearItemByBranch($branch_id)
    {
        $this->cart_items = CartManagement::clearCartItemsOnBranch($branch_id);
        return redirect('/pos');
    }

    public function refreshPage()
    {
        $this->dispatch('pos-page');
    }

    public function resetProductsTile()
    {
        $this->page = "";
        $this->cari = "";
        $this->selected_categories = [];
        $this->selected_brands = [];
        $this->featured = [];
        $this->promo = [];
        $this->price_range = 10000000;
    }

    public function render()
    {
        if (Auth::check()) {
            $isadmin = auth()->user()->is_admin;
        } else {
            $isadmin = 0;
        }

        if ($isadmin == 1) {
            $productQuery = Product::query();
        } else {
            $productQuery = Product::query()->where('is_active', 1);
        }

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }
        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }
        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }
        if ($this->promo) {
            $productQuery->where('promo', 1);
        }
        if ($this->price_range) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }
        if ($this->sort == 'latest') {
            $productQuery->latest();
        }
        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        if (empty($this->branch)) {
            $productQuery->where('branch_id', 1);
        } else {
            $productQuery->where('branch_id', $this->branch);
        }

        if (!empty($this->cari)) {
            $pencarian = $this->cari;
            $productQuery->where('branch_id', $this->branch)
                ->where(function ($query) use ($pencarian) {
                    $query->where('name', 'LIKE', '%' . $pencarian . '%');
                    $query->orWhere('sku', 'LIKE', '%' . $pencarian . '%');
                    $query->orWhere('variant', 'LIKE', '%' . $pencarian . '%');
                    $query->orWhere('description', 'LIKE', '%' . $pencarian . '%');
                    $query->orWhere('tags', 'LIKE', '%' . $pencarian . '%');
                });
        }

        if ($this->page == "" && $this->cari == null && $this->selected_categories == null && $this->selected_brands == null && $this->featured == null && $this->promo == null && $this->price_range == 10000000) {
            $url = 0;
        } else {
            $url = 1;
        }

        $cartcek = Cart::all();

        if (Auth::check()) {
            if (auth()->user()->is_admin == 0) {
                $branches = Branch::all()->where('is_active', 1)->get();
            } else {
                $branches = Branch::all()->where('partner_id', auth()->user()->partner_id)->where('is_active', 1);
            }
        } else {
            $branches = Branch::all()->where('is_active', 1);
        }

        $users = User::all();
        $productsAllModal = Product::query()->where('branch_id', auth()->user()->branch_id)->get();

        return view('livewire.pos-page', [
            'productsAllModal' => $productsAllModal,
            'products' => $productQuery->paginate(1000000000)->withQueryString(),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
            'branches' => $branches,
            'url' => $url,
            'cartcek' => $cartcek,
            'cart_items' => $this->cart_items,
            'grand_total' => $this->grand_total,
            'users' => $users,
        ]);
    }
}
