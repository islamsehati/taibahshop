<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderNowController extends Controller
{
    public function index(Request $request, Branch $branch = null)
    {
        $query = Product::query()->where('is_active', true)->where('is_public', true);

        $perpage = (int) $request->get('per_page', 100);
        $sortBy = $request->get('sort_by', 'updated_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        if (!$branch) {
            $storeId = (int) $request->get('store', 1);
            $branch = Branch::with('partner')
                ->where('is_active', true)
                ->find($storeId);
        } else {
            $branch->load('partner');
            if (!$branch->is_active) {
                return redirect()->route('partner.index');
            }
        }

        if (!$branch) {
            return redirect()->route('partner.index');
        }

        $storeId = $branch?->id ?? 1;

        $query->where('branch_id', $storeId);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('categories')) {
            $categoryIds = explode(',', $request->categories);
            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            });
        }

        if ($request->filled('brands')) {
            $brandIds = explode(',', $request->brands);
            $query->whereIn('brand_id', $brandIds);
        }

        $products = $query
            ->whereIsActive(true)
            ->with(['categories:id,name', 'brand:id,name'])
            ->when($sortBy === 'random', fn($q) => $q->inRandomOrder(),
                fn($q) => $q->orderBy($sortBy, $sortDirection))
            ->paginate($perpage)
            ->withQueryString();

        $userName = Auth::check() ? Auth::user()->username : '';

        return Inertia::render('OrderNow/Index', [
            'userName'     => $userName,
            'products'     => $products,
            'search'       => $request->get('search', ''),
            'categories'   => Category::whereIn('id',
                DB::table('category_product')
                    ->join('products', 'products.id', '=', 'category_product.product_id')
                    ->where('products.branch_id', $storeId)
                    ->select('category_product.category_id')
                    ->distinct()
                    ->pluck('category_id')
            )->select('id', 'name')->get(),
            'brands'       => Brand::whereIn('id',
                Product::where('branch_id', $storeId)
                    ->select('brand_id')
                    ->distinct()
                    ->pluck('brand_id')
            )->select('id', 'name')->get(),
            'stores'       => Branch::with('partner')->where('is_active', true)->get(),
            'currentStore' => $branch,
        ]);
    }
}
