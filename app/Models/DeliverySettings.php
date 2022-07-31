<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySettings extends Model
{
    use HasFactory;
    protected $fillable = ['city_id', 'price'];

    /**
     * Get the city associated with the delivery settings.
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param          
     * @return      \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}
