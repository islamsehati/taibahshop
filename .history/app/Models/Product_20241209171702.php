<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'sku',
        'name',
        'variant',
        'alias',
        'slug',
        'unit_name',
        'contain',
        'description',
        'images',
        'category_id',
        'brand_id',
        'tags',
        'cogs',
        'price',
        'strikethroughprice',
        'low_alert',
        'is_active',
        'in_stock',
        'is_featured',
        'on_sale',
        'rating',
        'created_by',
        'updated_by',
        'branch_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // public function pquantities()
    // {
    //     return $this->hasMany(OrderItem::class, 'product_id', 'id');
    // }
    // public function quantities()
    // {
    //     return $this->hasMany(OrderItem::class, 'product_id', 'id');
    // }

    // public function ptquantities()
    // {
    //     return $this->hasMany(OrderItem::class, 'product_id', 'id');
    // }
    // public function tquantities()
    // {
    //     return $this->hasMany(OrderItem::class, 'product_id', 'id');
    // }


    protected static function boot()
    {
        parent::boot();
        static::updating(function ($model) {
            if ($model->isDirty('images') && ($model->getOriginal('images') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('images'));
            }
        });
    }
}
