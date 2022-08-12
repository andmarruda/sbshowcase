<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'cpf_cnpj', 'birth_date', 'phone', 'email', 'address', 'number', 'complement', 'neighborhood', 'zip_code', 'gender', 'password', 'state_id', 'city_id'];
}
