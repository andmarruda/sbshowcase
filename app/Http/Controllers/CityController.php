<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Getting all cities from a state ordered by city name and filtered by state id
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $state_id
     * @return          \Illuminate\Database\Eloquent\Collection
     */
    public function allCity(int $state_id) : \Illuminate\Database\Eloquent\Collection
    {
        return \App\Models\City::where('state_id', $state_id)->orderBy('city_name', 'asc')->get();
    }
}
