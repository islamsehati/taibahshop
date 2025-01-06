<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porder extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_tr',
        'user_id',
        'sales_type',
        'payment_method',
        'is_paid',
        'status',
        'currency',
        'shipping_amount',
        'shipping_method',
        'discount',
        'grand_total',
        'notes',
        'date_order',
        'created_by',
        'updated_by',
        'branch_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
