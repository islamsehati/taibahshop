<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrStkIn extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'code_tr',
        'date_order',
        'user_id',
        'from_branch_id',
        'to_branch_id',
        'currency',
        'status',
        'notes',
        'grand_total',
        'created_by',
        'updated_by',
        'updated_at',
        'branch_id',
    ];

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::deleted(function ($model) {
            $model->items()->delete();
        });
        static::restored(function ($model) {
            $model->items()->restore();
        });
    }
}
