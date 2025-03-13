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
            'unit_name' => $row[5],
            'contain' => $row[6],
            'description' => $row[7],
            'images' => $row[8],

            'branch_id' => $row[9],
            'category_id' => $row[10],
            'brand_id' => $row[11],
            'tags' => $row[12],

            'cogs' => $row[13],
            'price' => $row[14],
            'strikethroughprice' => $row[15],

            'low_alert' => $row[16],
            'is_active' => $row[17],
            'in_stock' => $row[18],
            'is_featured' => $row[19],
            'promo' => $row[20],
            'rating' => $row[21],
            'created_by' => $row[22],
            'updated_by' => $row[23],

        ]);
    }
}
