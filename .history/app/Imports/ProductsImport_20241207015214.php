<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([

            'sku' => $row[0],
            'name' => $row[1],
            'variant' => $row[2],
            'alias' => $row[3],
            'slug' => $row[4],
            'description' => $row[5],
            'images' => $row[6],

            'branch_id' => $row[7],
            'category_id' => $row[8],
            'brand_id' => $row[9],
            'tags' => $row[10],

            'cogs' => $row[11],
            'price' => $row[12],
            'strikethroughprice' => $row[13],

            'is_active' => $row[14],
            'is_active' => $row[15],
            'in_stock' => $row[16],
            'is_featured' => $row[17],
            'on_sale' => $row[18],
            'rating' => $row[19],
            'created_by' => $row[20],

        ]);
    }
}
