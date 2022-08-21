<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'phone', 'address', 'number', 'complement', 'neighborhood', 'zip_code', 'state_id', 'city_id'];

    /**
     * get informations about city
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    /**
     * get informations about state
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id', 'state_id');
    }
}
