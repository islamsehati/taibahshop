<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'porder_code',
        'order_code',
        'mutation_type',
        'date_payment',
        'currency',
        'payment_method',
        'nominal_plus',
        'nominal_mins',
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
