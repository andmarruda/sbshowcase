<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'cpf_cnpj', 'birth_date', 'phone', 'email', 'address', 'number', 'complement', 'neighborhood', 'zip_code', 'gender', 'password', 'state_id', 'city_id'];

    /**
     * Get city data from this model
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    /**
     * Get state data from this model
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id', 'state_id');
    }
}
