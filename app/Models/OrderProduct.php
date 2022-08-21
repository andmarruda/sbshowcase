<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'quantity', 'product_name', 'old_price', 'quantity', 'price'];

    /**
     * get informations about products of the order
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
