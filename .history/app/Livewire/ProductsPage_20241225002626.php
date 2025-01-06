<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - TaibahShop')]

class ProductsPage extends Component
{
    use LivewireAlert;

    use WithPagination;

    #[Url()]
    public $selected_categories = [];

    #[Url()]
    public $selected_brands = [];

    #[Url()]
    public $featured = [];

    #[Url()]
    public $on_sale = [];

    #[Url()]
    public $price_range = 150000;

    public $sort = 'latest';

    #[Url()]
    public $cari = '';

    #[Url()]
    public $branch;

    #[Url()]
    public $page = '';

    public function mount()
    {
        if (Auth::check()) {
            if (auth()->user()->branch != '') {
                $this->branch = auth()->user()->branch_id;
            } else {
                $this->branch = '';
            }
        } else {
            $this->branch = 1;
        }
    }

    // add product to cart method
    public function addToCart($product_id)
    {
        if (Auth::check()) {
            CartManagement::addItemToCart($product_id);
            $this->dispatch('update-cart-count', total_count: count(CartManagement::getCartItemsFromCart()))->to(Navbar::class);
            // $this->dispatch('products-page');

            $this->alert('success', 'Added to the Cart', [
                'position' => 'bottom',
                'timer' => 3000,
                'toast' => true,
            ]);
        } else {
            redirect('/login');
        }
    }

    // change Branch in User
    public function changeBranch()
    {
        $data = User::where('id', auth()->user()->id);

        if (auth()->user()->is_admin == 1) {
            $update = [
                'branch_id' => auth()->user()->branch_id,
            ];
        } else {
            $update = [
                'branch_id' => $this->branch,
            ];
        }
        $data->update($update);
    }

    public function render()
    {
        if (Auth::check()) {
            $isadmin = auth()->user()->is_admin;
        } else {
            $isadmin = 0;
        }

        $orderitems = OrderItem::all();
        if ($isadmin == 1) {
            $productQuery = Product::query()->orderBy('updated_at','desc');
        } else {
            $productQuery = Product::query()->where('is_active', 1)->orderBy('updated_at','desc');

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }
        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }
        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }
        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
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
                    $query->orWhere('variant', 'LIKE', '%' . $pencarian . '%');
                    $query->orWhere('description', 'LIKE', '%' . $pencarian . '%');
                    $query->orWhere('tags', 'LIKE', '%' . $pencarian . '%');
                });
        }

        if ($this->page == "" && $this->cari == null && $this->selected_categories == null && $this->selected_brands == null && $this->featured == null && $this->on_sale == null) {
            $url = 0;
        } else {
            $url = 1;
        }

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(500),
            'orderitem' => $orderitems,
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
            'branches' => Branch::where('is_active', 1)->get(['id', 'name', 'slug']),
            'url' => $url,
        ]);
    }
}
