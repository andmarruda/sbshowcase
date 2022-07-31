<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
