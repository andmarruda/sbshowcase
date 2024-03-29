<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['customer_id', 'total', 'status', 'order_status_id', 'subtotal', 'shippment_price']; 

    /**
     * get informations about address of the order
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function address() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderDelivery::class);
    }

    /**
     * get informations about payment methods
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payment_method() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderPaymentMethod::class);
    }

    /**
     * get informations about products of the order
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * get informations about order status
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order_status() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * get informations about customer
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
