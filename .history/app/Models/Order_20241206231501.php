<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_tr',
        'user_id',
        'sales_type',
        'is_paid',
        'status',
        'shipping_amount',
        'shipping_method',
        'discount',
        'grand_total',
        'total_payment',
        'total_cashback',
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
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
