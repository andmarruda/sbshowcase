<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'phone', 'address', 'number', 'complement', 'neighborhood', 'zip_code', 'state_id', 'city_id'];
}
