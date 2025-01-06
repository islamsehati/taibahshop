<?php

namespace App\Exports;

use App\Models\OrderItem;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductsExport implements FromCollection, WithMapping, WithHeadings
{
    protected $category;

    function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * @return \Illuminate\Support\Collection
     */

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
            'Stok Terbeli',
            'Stok Terjual',
            'Total Beli',
            'Total Jual',
        ];
    }

    public function map($product): array
    {
        $orderitems = OrderItem::leftJoin('orders', 'order_items.id', '=', 'orders.id')->get()->where('order.status', '!=', 'canceled');
        $stokterbeli = $orderitems->where('product_id', $product->id)->sum('p_quantity');
        $stokterjual = $orderitems->where('product_id', $product->id)->sum('quantity');
        $stokterkini = $stokterbeli - $stokterjual;
        return [
            $product->category->name,
            $product->brand->name,
            $product->sku,
            $product->name,
            $product->variant,
            $product->alias,
            $product->slug,
            $product->description,
            $product->images,
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
