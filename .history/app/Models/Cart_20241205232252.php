<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'name',
        'variant',
        'slug',
        'image',
        'quantity',
        'unit_amount',
        'total_amount',
        'mutation_type',
        'created_by',
        'updated_by',
        'branch_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
