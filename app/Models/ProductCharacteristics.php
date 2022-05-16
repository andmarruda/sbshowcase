<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCharacteristics extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'characteristics_types_id', 'description'];
}
