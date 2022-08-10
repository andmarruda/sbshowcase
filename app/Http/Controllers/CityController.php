<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * Getting all available cities
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Support\Collection
     */
    public function allAvailableCities() : \Illuminate\Support\Collection
    {
        return DB::table('delivery_settings', 'ds')
                    ->join('cities as c', 'c.city_id', '=', 'ds.city_id')
                    ->select('c.city_id', 'c.city_name', 'c.state_id')
                    ->distinct()
                    ->get();
    }
}
