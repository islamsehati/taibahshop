<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumboTron extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'link', 'image', 'is_active'];
}
