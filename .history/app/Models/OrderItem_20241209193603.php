<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'porder_id',
        'order_id',
        'adj_item_id',
        'product_id',
        'unit_name',
        'contain',
        'p_quantity',
        'quantity',
        'p_unit_amount',
        'unit_amount',
        'p_total_amount',
        'total_amount',
        'notes',
        'mutation_type',
        'stock_before',
        'stock_after',
        'branch_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function porder()
    {
        return $this->belongsTo(Porder::class);
    }
    public function adjItem()
    {
        return $this->belongsTo(AdjItem::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function trStkOut()
    {
        return $this->belongsTo(TrStkOut::class);
    }
    public function trStkIn()
    {
        return $this->belongsTo(TrStkIn::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
