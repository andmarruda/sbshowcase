<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image', 'price', 'old_price', 'percentage_discount', 'installments_limit', 'quantity', 'promotion_flag', 'category_id', 'measure_id', 'color_id', 'brand_id', 'type_id'];
}
