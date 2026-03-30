<?php

namespace App\Http\Controllers;

use App\Models\AccountBalance;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Payment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['categories', 'brand'])
            ->where('branch_id', Auth::user()->branch_id);

        // 🔍 search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🏷 brand
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // 🗂 category (many-to-many)
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // ✅ active status
        if ($request->status === 'active') {
            $query->where('is_active', true);
        } elseif ($request->status === 'nonactive') {
            $query->where('is_active', false);
        } elseif ($request->status === 'public') {
            $query->where('is_public', true);
        } elseif ($request->status === 'private') {
            $query->where('is_public', false);
        }

        // 📦 stock status (low | over)
        if ($request->filled('stock_status')) {

            if ($request->stock_status === 'low') {
                $query->where('low_stock_alert', '!=', 0)
                    ->whereColumn('stock', '<', 'low_stock_alert');

            } elseif ($request->stock_status === 'over') {
                $query->where('overstock_alert', '!=', 0)
                    ->whereColumn('stock', '>', 'overstock_alert');
            }

            // selain itu (all / aman) → TIDAK difilter
        }

        //// SORTING

        $allowedSorts = ['name', 'stock', 'created_at', 'updated_at'];

        $sortBy = in_array($request->sort_by, $allowedSorts)
            ? $request->sort_by
            : 'name';

        $sortDir = $request->sort_dir === 'desc' ? 'desc' : 'asc';

        if ($sortBy === 'stock') {
            $query->where('stock', '!=', 0);
        }

        $query->orderBy($sortBy, $sortDir); 
        
        //// Hitung total asset (stock x cost) jika diminta
        
        $totalAsset = null;

        if ($request->boolean('calculate')) {

            $totalAsset = (clone $query)
                ->where('stock', '!=', 0)
                ->select(DB::raw('SUM(stock * cost) as total'))
                ->value('total');
        }        

        return inertia('Produk/Index', [
            'produk' => $query
                ->orderBy('name')
                ->paginate(60)
                ->withQueryString(), // 🔑 penting
            'totalAsset' => $totalAsset,
            'filters' => $request->only([
                'search',
                'brand',
                'category',
                'status',
                'stock_status',
                'sort_by',
                'sort_dir',
            ]),
            'brands' => Brand::orderBy('name')->get(['id', 'name']),
            'categories' => Category::orderBy('name')->get(['id', 'name']),
        ]);
    }


    public function show(Product $produk)
    {
        $produk->load(['categories', 'brand', 'branch']); // pastikan relasi sudah diset di model
        $variants = Product::where('group', $produk->group)
            ->whereNotNull('group')        // Pastikan tidak NULL
            ->where('group', '!=', '')     // Pastikan bukan string kosong
            ->where('branch_id', $produk->branch_id)
            ->orderBy('name')
            ->get();
        $relatedproduks = Product::where('id', '!=', $produk->id)
            ->where('branch_id', $produk->branch_id)
            ->where(function ($q) use ($produk) {
                $q->whereHas('categories', function ($qc) use ($produk) {
                    $qc->whereIn('categories.id', $produk->categories->pluck('id'));
                })
                ->orWhere('brand_id', $produk->brand_id);
            })
            ->inRandomOrder()
            ->limit(10)
            ->get();

        $branchId = $produk->branch_id;

        // batas aktif (misal 5 menit terakhir)
        $onlineThreshold = Carbon::now()->subMinutes(5)->timestamp;

        $hasOnlineAdmin = DB::table('sessions')
            ->join('users', 'sessions.user_id', '=', 'users.id')
            ->where('users.is_admin', true)
            ->where('users.branch_id', $branchId)
            ->where('sessions.last_activity', '>=', $onlineThreshold)
            ->exists();    
            
        return Inertia::render('Produk/Show', compact(
            'produk',
            'variants',
            'relatedproduks',
            'hasOnlineAdmin',
        ));
        // return response()->json($produk);
    }

    public function preview(Product $product)
    {
        $product->load(['categories', 'brand']); // pastikan relasi sudah diset di model

        // 🔽 RIWAYAT PERUBAHAN HARGA DASAR
        $priceAdjustments = $product->payments()
            ->where('mutation_type', 'like', '%Perubahan Harga Dasar%')
            ->with('userCre:id,name')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        return Inertia::render('Produk/Preview', [
            'product' => $product,
            'priceAdjustments' => $priceAdjustments,
        ]);

        // return response()->json($product);
    }
    
    public function create()
    {
        return Inertia::render('Produk/Create', [
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
            'brands' => Brand::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    public function edit(Product $product)
    {
        $product->load(['categories', 'brand']); // pastikan relasi sudah diset di model
        return Inertia::render('Produk/Edit', [
            'product' => $product,
            'categories' => Category::select('id','name')->orderBy('name')->get(),
            'brands' => Brand::select('id','name')->orderBy('name')->get(),
        ]);

        // return response()->json($product);
    }

public function update(Request $request, Product $product)
{
    $branchId = Auth::user()->branch_id;

    // 1️⃣ VALIDASI INPUT
    $data = $request->validate([
        'sku' => 'required|string|max:255',
        'barcode' => 'nullable|string|max:255',
        'hscode' => 'nullable|string|max:255',
        'slug' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'group' => 'nullable|string|max:255',
        'variant' => 'nullable|string|max:255',
        'unit_name' => 'nullable|string|max:255',
        'contain' => 'nullable|string|max:255',
        'weight' => 'nullable|numeric',
        'cost' => 'nullable|numeric',
        'price' => 'nullable|numeric',
        'strikethroughprice' => 'nullable|numeric',
        'poin' => 'nullable|numeric',
        'rating' => 'nullable|numeric',
        'low_stock_alert' => 'nullable|numeric',
        'overstock_alert' => 'nullable|numeric',
        'stock' => 'nullable|numeric',
        'category_ids'   => 'required|array|min:1',
        'category_ids.*' => 'exists:categories,id',
        'brand_id' => 'required|integer',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean',
        'is_public' => 'required|boolean',
        'in_stock' => 'required|boolean',
        'is_featured' => 'required|boolean',
        'is_promo' => 'required|boolean',
        'images_keep' => 'nullable|string',          // JSON
        'images_new.*' => 'nullable|image|max:5120', // 5MB
    ]);

    // 2️⃣ CEK UNIK PER BRANCH
    if (
        Product::where('branch_id', $branchId)
            ->where('name', $data['name'])
            ->where('id', '!=', $product->id)
            ->exists()
    ) {
        return back()->withErrors(['name' => 'Nama produk sudah ada di cabang ini']);
    }

    if (
        Product::where('branch_id', $branchId)
            ->where('sku', $data['sku'])
            ->where('id', '!=', $product->id)
            ->exists()
    ) {
        return back()->withErrors(['sku' => 'SKU sudah ada di cabang ini']);
    }
    if (
        Product::where('branch_id', $branchId)
            ->where('barcode', $data['barcode'])
            ->where('id', '!=', $product->id)
            ->exists()
    ) {
        return back()->withErrors(['barcode' => 'BARCODE sudah ada di cabang ini']);
    }
    if (
        Product::where('branch_id', $branchId)
            ->where('hscode', $data['hscode'])
            ->where('id', '!=', $product->id)
            ->exists()
    ) {
        return back()->withErrors(['hscode' => 'HSCODE sudah ada di cabang ini']);
    }

    if (
        Product::where('slug', Str::slug($data['slug']))
            ->where('id', '!=', $product->id)
            ->exists()
    ) {
        return back()->withErrors(['slug' => 'Slug sudah digunakan']);
    }

    if ($data['rating'] > 5) {
        return back()->withErrors(['rating' => 'Rating Max 5']);
    }    

    // 3️⃣ PARSE IMAGES YANG DIPERTAHANKAN
    $imagesKeep = [];
    if ($request->filled('images_keep')) {
        $imagesKeep = json_decode($request->input('images_keep'), true) ?? [];
    }

    // pastikan hanya path disk (tanpa /storage)
    $imagesKeep = array_map(fn ($p) => ltrim($p, '/'), $imagesKeep);

    // 4️⃣ UPLOAD IMAGE BARU
    $uploaded = [];
    if ($request->hasFile('images_new')) {
        foreach ($request->file('images_new') as $file) {
            $uploaded[] = $file->store('products', 'public');
        }
    }

    // 5️⃣ HAPUS IMAGE YANG DIHILANGKAN
    $currentImages = $product->images ?? [];

    $toDelete = array_diff($currentImages, $imagesKeep);

    foreach ($toDelete as $path) {
        Storage::disk('public')->delete($path);
    }

    // 6️⃣ FINAL ARRAY IMAGES
    $merged = array_merge($imagesKeep, $uploaded);
    // Jika hasil gabungan kosong, set ke null, jika ada isinya baru di-array_values
    $finalImages = count($merged) > 0 ? array_values($merged) : null;    

    // 7️⃣ UPDATE PRODUK
    $categoryIds = $data['category_ids'];
    unset($data['category_ids']);

    $nilaiSebelum = $product->cost * $product->stock;
    $oldCost = $product->cost;

    $product->update(array_merge($data, [
        'slug'        => Str::slug($data['slug']),
        'images'      => $finalImages,
        'updated_by'  => Auth::id(),
        'is_active'   => (bool) $request->input('is_active'),
        'is_public'   => (bool) $request->input('is_public'),
        'in_stock'    => (bool) $request->input('in_stock'),
        'is_featured' => (bool) $request->input('is_featured'),
        'is_promo'    => (bool) $request->input('is_promo'),
    ]));

    // 8️⃣ CATAT JURNAL PENYESUAIAN HARGA POKOK (JIKA ADA PERUBAHAN)
    if ($product->wasChanged('cost')) {

        $nilaiSesudah = $product->cost * $product->stock;
        $delta = $nilaiSesudah - $nilaiSebelum;
        $selisihCost = $product->cost - $oldCost;

        if ($delta != 0) {

            if ($delta > 0 ) {
                $payment = $product->payments()->create([
                    'branch_id'   => $branchId,
                    'date'        => now(),
                    'mutation_type'        => 'Perubahan Harga Dasar',
                    'notes' => $product->name. ' (Dari: '.$oldCost.' Ke: '.$product->cost.') qty: '.$product->stock. ' x Rp' .$selisihCost,
                    'debit_akun' => 'NR-DB Persediaan',
                    'kredit_akun' => 'LR-KR Harga Dasar Naik',                  
                    'nominal'      => abs($delta),
                    'created_by'  => Auth::id(),
                ]);

                // Debit Persediaan
                $this->mutateAccountBalance(
                    $payment->branch_id,
                    $payment->debit_akun,
                    $payment->nominal,
                    'debit'
                );
                // Kredit
                $this->mutateAccountBalance(
                    $payment->branch_id,
                    $payment->kredit_akun,
                    $payment->nominal,
                    'credit'
                );         
                
                $product->items()->create([
                    'branch_id'   => $branchId,
                    'date'        => now(),
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'cost' => abs($selisihCost),
                    'subtotal' => abs($delta),
                    'totalcost' => 0,
                    'status' => 'applied',                    
                    'created_by'  => Auth::id(),
                ]);                
                
            } else {

                $payment = $product->payments()->create([
                    'branch_id'   => $branchId,
                    'date'        => now(),
                    'mutation_type'        => 'Perubahan Harga Dasar',
                    'notes' => $product->name. ' (Dari: '.$oldCost.' Ke: '.$product->cost.') qty: '.$product->stock. ' x Rp' .$selisihCost,
                    'debit_akun' => 'LR-DB Harga Dasar Turun', 
                    'kredit_akun' =>  'NR-DB Persediaan',
                    'nominal'      => abs($delta),
                    'created_by'  => Auth::id(),
                ]);

                // Debit
                $this->mutateAccountBalance(
                    $payment->branch_id,
                    $payment->debit_akun,
                    $payment->nominal,
                    'debit'
                );   
                // Kredit Persediaan
                $this->mutateAccountBalance(
                    $payment->branch_id,
                    $payment->kredit_akun,
                    $payment->nominal,
                    'credit'
                );     
                
                $product->items()->create([
                    'branch_id'   => $branchId,
                    'date'        => now(),
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'cost' => abs($selisihCost),
                    'subtotal' => 0,
                    'totalcost' => abs($delta),
                    'status' => 'applied',                    
                    'created_by'  => Auth::id(),
                ]);     

            }            

        }
    }

    $product->categories()->sync($categoryIds);

    return redirect()
        ->route('produk.edit', $product->id)
        ->with('success', 'Produk berhasil diperbarui');
}    


    public function store(Request $request)
    {
        // 1️⃣ VALIDASI INPUT
        $data = $request->validate([
            'sku' => 'required|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'hscode' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'group' => 'nullable|string|max:255',
            'variant' => 'nullable|string|max:255',
            'unit_name' => 'nullable|string|max:255',
            'contain' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'cost' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'strikethroughprice' => 'nullable|numeric',
            'poin' => 'nullable|numeric',
            'rating' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'category_ids' => 'required|array|min:1',
            'category_ids.*' => 'exists:categories,id',
            'brand_id' => 'required|integer',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'is_public' => 'required|boolean',
            'in_stock' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'is_promo' => 'required|boolean',
            'images_new.*' => 'nullable|image|max:5120',
        ]);

        // 4️⃣ Pastikan name & sku unik dalam branch yang sama
        $branchId = Auth::user()->branch_id;

        if (Product::where('branch_id', $branchId)->where('name', $request->input('name'))->exists()) {
            return back()->withErrors(['name' => 'Nama produk sudah ada di cabang ini']);
        }

        if (Product::where('branch_id', $branchId)->where('sku', $request->input('sku'))->exists()) {
            return back()->withErrors(['sku' => 'SKU sudah ada di cabang ini']);
        }
        if (Product::where('branch_id', $branchId)->where('barcode', $request->input('barcode'))->exists()) {
            return back()->withErrors(['barcode' => 'BARCODE sudah ada di cabang ini']);
        }
        if (Product::where('branch_id', $branchId)->where('hscode', $request->input('hscode'))->exists()) {
            return back()->withErrors(['hscode' => 'HSCODE sudah ada di cabang ini']);
        }

        if (Product::where('slug', $request->input('slug'))->exists()) {
            return back()->withErrors(['slug' => 'slug sudah ada yang menggunakan']);
        }

        if ($data['rating'] > 5) {
            return back()->withErrors(['rating' => 'Rating Max 5']);
        }            

        // 5️⃣ Upload gambar baru jika ada
        $uploaded = null; // Ubah default dari [] menjadi null
        if ($request->hasFile('images_new')) {
            $uploaded = []; // Inisialisasi jadi array hanya jika ada file
            foreach ($request->file('images_new') as $file) {
                $path = $file->store('products', 'public');
                $uploaded[] = '/storage/' . $path;
            }
        }

        $data['is_active']    = (bool) $request->input('is_active');
        $data['is_public']    = (bool) $request->input('is_public');
        $data['in_stock']     = (bool) $request->input('in_stock');
        $data['is_featured']  = (bool) $request->input('is_featured');
        $data['is_promo']     = (bool) $request->input('is_promo');

        // 6️⃣ Simpan product baru
        $product = Product::create(array_merge($data, [
            'slug' => Str::slug($data['slug']),
            'branch_id' => $branchId,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            'images' => $uploaded, // pastikan di model Product: protected $casts = ['images' => 'array'];
        ]));

        $product->categories()->sync($data['category_ids']);

        // Langsung redirect ke halaman preview
        return redirect()->route('produk.preview', $product->id)
                        ->with('success', 'Produk berhasil dibuat');
    }

    public function toggleActive(Product $product)
    {
        $product->update([
            'is_active' => ! $product->is_active,
            'updated_by' => Auth::id(),
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['deleted'=>true]);
    }


    private function mutateAccountBalance(
        int $branchId,
        string $akun,
        float $amount,
        string $type // 'debit' | 'credit'
    ) {
        $account = AccountBalance::where('branch_id', $branchId)
            ->where('akun', $akun)
            ->lockForUpdate()
            ->first();

        if (! $account) {
            $account = AccountBalance::create([
                'branch_id' => $branchId,
                'akun'      => $akun,
                'balance'   => 0,
            ]);
        }

        /**
         * Konvensi:
         * debit  => balance + amount
         * credit => balance - amount
         */
        if ($type === 'debit') {
            $account->increment('balance', $amount);
        }

        if ($type === 'credit') {
            $account->decrement('balance', $amount);
        }
    }    
}