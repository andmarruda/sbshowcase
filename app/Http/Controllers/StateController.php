<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    /**
     * Getting all state ordered by state name and filtered by country id
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $country_id
     * @return          \Illuminate\Database\Eloquent\Collection
     */
    public function allState(int $country_id) : \Illuminate\Database\Eloquent\Collection
    {
        return \App\Models\State::where('country_id', $country_id)->orderBy('state_name', 'asc')->get();
    }

    /**
     * Getting all available states
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Support\Collection
     */
    public function allAvailableStates() : \Illuminate\Support\Collection
    {
        return DB::table('delivery_settings', 'ds')
                    ->join('cities as c', 'c.id', '=', 'ds.city_id')
                    ->join('states as s', 's.id', '=', 'c.state_id')
                    ->select('s.id', 's.state_name')
                    ->groupBy('s.id')
                    ->get();
        ;
    }
}
