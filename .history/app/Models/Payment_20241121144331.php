<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'porder_id',
        'order_id',
        'date_payment',
        'currency',
        'payment_method',
        'nominal',
        'created_by',
        'updated_by',
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

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
