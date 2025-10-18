<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    $q = $request->query('q');
    $perPage = (int) $request->query('per_page', 50);

    $query = Product::query()->where('branch_id',Auth::user()->branch_id);
    if ($q) {
    $query->where(function ($query) use ($q) {
                    $query->where('name', 'LIKE', '%' . $q . '%');
                    $query->orWhere('sku', 'LIKE', '%' . $q . '%');
                    $query->orWhere('variant', 'LIKE', '%' . $q . '%');
                    $query->orWhere('tags', 'LIKE', '%' . $q . '%');
                });
    }

    if ($categoryIds = $request->query('category_id')) {
        // bisa single value atau array
        $query->whereIn('category_id', (array) $categoryIds);
    }
    if ($brandIds = $request->query('brand_id')) {
        // bisa single value atau array
        $query->whereIn('brand_id', (array) $brandIds);
    }

    $sortBy = $request->get('sort_by', 'name');
    $sortOrder = $request->get('sort_order', 'asc');

    if (!in_array($sortBy, ['name', 'price'])) {
        $sortBy = 'name';
    }
    if (!in_array($sortOrder, ['asc', 'desc'])) {
        $sortOrder = 'asc';
    }

    $products = $query->orderBy($sortBy, $sortOrder)->paginate($perPage)->appends($request->query());

    return response()->json($products);
    
    }


    public function show($id)
    {
    $product = Product::findOrFail($id);
    return response()->json($product);
    }
}