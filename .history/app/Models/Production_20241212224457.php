<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;
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
        'branch_id',
    ];
}
