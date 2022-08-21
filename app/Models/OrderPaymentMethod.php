<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'payment_method_id', 'installments', 'installment_price'];
}
