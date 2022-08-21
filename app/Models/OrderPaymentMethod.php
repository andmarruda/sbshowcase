<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'payment_method_id', 'installments', 'installment_price'];

    /**
     * get informations about payment methods
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_method() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
