<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'address', 'address_number', 'address_complement', 'address_neighborhood', 'address_city', 'address_state', 'address_zipcode', 'address_country', 'google_maps_embeded', 'phone'];
}
