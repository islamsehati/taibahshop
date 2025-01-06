<?php

namespace App\Exports;

use App\Models\OrderItem;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    protected $category;

    function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            'F1'    => ['font' => ['bold' => true]],
            'R1'    => ['font' => ['bold' => true]],
            'S1'    => ['font' => ['bold' => true]],

            // Style the first row as bold text.
            // 1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            //  'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            //  'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function headings(): array
    {
        return [
            'Category',
            'Brand',
            'SKU',
            'Name',
            'Variant',
            'Alias',
            'Slug',
            'Unit Name',
            'Contain',
            'Desc',
            'Images',
            'Tags',
            'COGS',
            'Price',
            'Strikethroughprice',
            'Active',
            'Featured',
            'In Stock',
            'On Sale',
            'Stok Terkini',
            'Nilai Stok',
            'Stok Terbeli',
            'Stok Terjual',
            'Total Beli',
            'Total Jual',
            'Margin',
            'Low Stock Alert',
            'Alert',
        ];
    }

    public function map($product): array
    {
        $orderitems = OrderItem::leftJoin('orders', 'order_items.order_id', '=', 'orders.id')->leftJoin('porders', 'order_items.porder_id', '=', 'porders.id')->get()->where('order.status', '!=', 'canceled')->where('porder.status', '!=', 'canceled');
        $stokterbeli = $orderitems->where('product_id', $product->id)->sum('p_quantity');
        $stokterjual = $orderitems->where('product_id', $product->id)->sum('quantity');
        $stokterkini = $stokterbeli - $stokterjual;
        $is_low = $stokterkini - $product->low_alert;
        if ($is_low <= 0) {
            $alert = 'LOW';
        } else {
            $alert = 'aman';
        }

        return [
            $product->sku,
            $product->name,
            $product->variant,
            $product->alias,
            $product->slug,
            $product->unit_name,
            $product->contain,
            $product->description,
            $product->images,
            $product->category->name,
            $product->brand->name,
            $product->tags,
            $product->cogs,
            $product->price,
            $product->strikethroughprice,
            $product->is_active,
            $product->is_featured,
            $product->in_stock,
            $product->on_sale,
            $stokterkini,
            $stokterkini * $product->cogs,
            $stokterbeli,
            $stokterjual,
            $orderitems->where('product_id', $product->id)->sum('p_total_amount'),
            $orderitems->where('product_id', $product->id)->sum('total_amount'),
            $orderitems->where('product_id', $product->id)->sum('p_total_amount') - $orderitems->where('product_id', $product->id)->sum('total_amount'),
            $product->low_alert,
            $alert,
        ];
    }

    public function collection()
    {
        if ($this->category != null) {
            return Product::where('category_id', $this->category)->get();
        } else {
            return Product::get();
        }
    }
}
