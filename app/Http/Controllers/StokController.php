<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;

class StokController extends Controller
{
    public function index(Request $request)
    {
        // =======================
        // SMART DATE DEFAULT
        // =======================
        $isFirstLoad = $request->query->count() === 0;

        $startDate = $request->get('date_from');
        $endDate   = $request->get('date_to');

        if ($isFirstLoad) {
            $startDate = Carbon::parse('2026-01-01 00:00:00')->toDateString();
            $endDate   = Carbon::today()->toDateString();
        }

        $allowedColumns = ['date','name','status','created_at','updated_at'];
        $orderBy  = $request->input('order_by', 'date');
        $orderDir = $request->input('order_dir', 'desc');

        if (!in_array($orderBy, $allowedColumns)) $orderBy = 'date';
        if (!in_array($orderDir, ['asc','desc'])) $orderDir = 'desc';

        // Tentukan kolom tanggal berdasarkan orderBy
        $dateColumn = match ($orderBy) {
            'created_at' => 'order_items.created_at',  // tambah prefix
            'updated_at' => 'order_items.updated_at',  // tambah prefix
            default      => 'order_items.date',         // tambah prefix
        };

        $status = $request->get('status');
        $viewMode = $request->get('view', 'list'); // 'list' atau 'grouped'

        // =======================
        // BASE QUERY
        // =======================
        $baseQuery = OrderItem::query()->with(['branch','userCre','userUpd','itemable'])
            ->where('order_items.branch_id', Auth::user()->branch_id)
            ->when(
                $status,
                fn ($q) => $q->where('order_items.status', $status),
                fn ($q) => $q->where('order_items.status', '!=', 'canceled')
            )
            ->when($startDate, fn ($q) => $q->whereDate($dateColumn, '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate($dateColumn, '<=', $endDate));


        // =======================
        // FILTER PRODUCT
        // =======================
        if ($request->filled('product_id')) {
            $baseQuery->where('product_id', $request->product_id);
        }

        // =======================
        // FILTER FLAG (polymorphic)
        // =======================
        if ($request->filled('flag')) {
            $flag = $request->flag;
            $baseQuery->whereHasMorph(
                'itemable',
                [
                    \App\Models\Order::class,
                    \App\Models\PurchaseOrder::class,
                    \App\Models\AdjustmentStock::class
                ],
                fn ($m) => $m->where('flag', $flag)
            );
        }

        // =======================
        // FILTER USER ADMIN
        // =======================
        if ($request->filled('user_admin')) {
            $baseQuery->where(function ($q) use ($request) {
                $q->where('created_by', $request->user_admin)
                ->orWhere('updated_by', $request->user_admin);
            });
        }

        // =======================
        // GROUPED VIEW
        // =======================
        if ($viewMode === 'grouped') {
            $groupedData = $this->getGroupedData($baseQuery);

            return Inertia::render('Stok/Index', [
                'admins' => User::where('branch_id', Auth::user()->branch_id)->whereIsAdmin(true)->get(['id', 'name']),
                'stokList' => null,
                'summary'  => null,
                'groupedData' => $groupedData,
                'products' => Product::query()
                    ->where('branch_id', Auth::user()->branch_id)
                    ->orderBy('stock','desc')
                    ->when($request->filled('product_search'), function ($q) use ($request) {
                        $q->where('name', 'like', "%{$request->product_search}%")
                          ->orWhere('id', $request->product_search);
                    })
                    ->limit(20)
                    ->get(['id','name','stock']),
                'filters'  => [
                    'product_id'     => $request->product_id,
                    'product_search' => $request->product_search,
                    'date_from'      => $startDate,
                    'date_to'        => $endDate,
                    'flag'           => $request->flag,
                    'status'         => $status,
                    'order_by'       => 'name',
                    'order_dir'      => 'asc',
                    'user_admin'     => $request->user_admin,
                    'view'           => $viewMode,
                ],
            ]);
        }

        // =======================
        // LIST VIEW (existing logic)
        // =======================
        $baseQuery->orderBy($orderBy, $orderDir);

        // SUMMARY
        $summaryQuery = clone $baseQuery;
        $summary = [
            'total_qty_plus' => $summaryQuery->sum('quantity_plus'),
            'total_qty_mins' => $summaryQuery->sum('quantity_mins'),
            'total_totalcost' => (clone $summaryQuery)->sum('totalcost'),
            'total_subtotal' => (clone $summaryQuery)->sum('subtotal'),
        ];

        // PAGINATION
        $stokList = $baseQuery
            ->paginate(10)
            ->through(function ($item) {
                $item->itemable_url = match ($item->itemable_type) {
                    \App\Models\Order::class => route('penjualan.show', $item->itemable_id),
                    \App\Models\PurchaseOrder::class => route('pembelian.show', $item->itemable_id),
                    \App\Models\AdjustmentStock::class => route('penyesuaian-stok.edit', $item->itemable_id),
                    \App\Models\Product::class => route('produk.preview', $item->itemable_id),
                    default => null,
                };
                $item->flag = $item->itemable?->flag;
                $item->code = $item->itemable?->code ?? '-';
                return $item;
            })
            ->withQueryString();

        $products = Product::query()
            ->where('branch_id', Auth::user()->branch_id)
            ->orderBy('stock','desc')
            ->when($request->filled('product_search'), function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->product_search}%")
                  ->orWhere('id', $request->product_search);
            })
            ->limit(20)
            ->get(['id','name','stock']);

        return Inertia::render('Stok/Index', [
            'admins' => User::where('branch_id', Auth::user()->branch_id)->whereIsAdmin(true)->get(['id', 'name']),
            'stokList' => $stokList,
            'summary'  => $summary,
            'groupedData' => null,
            'products' => $products,
            'filters'  => [
                'product_id'     => $request->product_id,
                'product_search' => $request->product_search,
                'date_from'      => $startDate,
                'date_to'        => $endDate,
                'flag'           => $request->flag,
                'status'         => $status,
                'order_by'       => $orderBy,
                'order_dir'      => $orderDir,
                'user_admin'     => $request->user_admin,
                'view'           => $viewMode,
            ],
        ]);
    }

    /**
     * Get grouped data by product with flag aggregation
     */
    private function getGroupedData($baseQuery)
    {
        // Clone query untuk join dengan itemable
        $query = clone $baseQuery;

        // Join dengan tabel Order untuk mendapatkan flag
        $query->leftJoin('orders', function ($join) {
            $join->on('order_items.itemable_id', '=', 'orders.id')
                 ->where('order_items.itemable_type', '=', \App\Models\Order::class);
        })
        ->leftJoin('purchase_orders', function ($join) {
            $join->on('order_items.itemable_id', '=', 'purchase_orders.id')
                 ->where('order_items.itemable_type', '=', \App\Models\PurchaseOrder::class);
        })
        ->leftJoin('adjustment_stocks', function ($join) {
            $join->on('order_items.itemable_id', '=', 'adjustment_stocks.id')
                 ->where('order_items.itemable_type', '=', \App\Models\AdjustmentStock::class);
        });

        $query->from('order_items');

        // Grouping dengan conditional SUM
        $grouped = $query->select([
            'order_items.product_id',
            'order_items.name as product_name',

            DB::raw("SUM(CASE WHEN COALESCE(orders.flag, purchase_orders.flag, adjustment_stocks.flag) = 'Penjualan'
                THEN order_items.quantity_mins ELSE 0 END) as qty_jual"),

            DB::raw("SUM(CASE WHEN COALESCE(orders.flag, purchase_orders.flag, adjustment_stocks.flag) = 'Pembelian'
                THEN order_items.quantity_plus ELSE 0 END) as qty_beli"),

            DB::raw("SUM(CASE WHEN COALESCE(orders.flag, purchase_orders.flag, adjustment_stocks.flag) = 'opname'
                THEN order_items.quantity_plus ELSE 0 END) as qty_opname_plus"),
            DB::raw("SUM(CASE WHEN COALESCE(orders.flag, purchase_orders.flag, adjustment_stocks.flag) = 'opname'
                THEN order_items.quantity_mins ELSE 0 END) as qty_opname_mins"),

            DB::raw("SUM(CASE WHEN COALESCE(orders.flag, purchase_orders.flag, adjustment_stocks.flag) = 'production'
                THEN order_items.quantity_plus ELSE 0 END) as qty_production_plus"),
            DB::raw("SUM(CASE WHEN COALESCE(orders.flag, purchase_orders.flag, adjustment_stocks.flag) = 'production'
                THEN order_items.quantity_mins ELSE 0 END) as qty_production_mins"),

            DB::raw("SUM(CASE WHEN COALESCE(orders.flag, purchase_orders.flag, adjustment_stocks.flag) = 'tf_out'
                THEN order_items.quantity_mins ELSE 0 END) as qty_tf_out"),

            DB::raw("SUM(CASE WHEN COALESCE(orders.flag, purchase_orders.flag, adjustment_stocks.flag) = 'tf_in'
                THEN order_items.quantity_plus ELSE 0 END) as qty_tf_in"),

            DB::raw("SUM(order_items.quantity_plus) as total_qty_plus"),
            DB::raw("SUM(order_items.quantity_mins) as total_qty_mins"),
            DB::raw("SUM(CASE WHEN order_items.status NOT IN ('new', 'canceled')
                THEN order_items.quantity_plus - order_items.quantity_mins ELSE 0 END) as total_gudang"),

        ])
        ->groupBy('order_items.product_id', 'order_items.name')
        ->orderByDesc('qty_jual')  
        ->orderBy('order_items.name', 'asc')
        ->get();


        return $grouped;
    }
}