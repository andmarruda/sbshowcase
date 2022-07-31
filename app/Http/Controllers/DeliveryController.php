<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * default country id for the system
     * @var int
     */
    private int $defaultCountryId = 1058;

    /**
     * Returns the view of template form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $selected_state_id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $selected_state_id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $allState = new StateController();
        $allState = $allState->allState($this->defaultCountryId);
        if(!is_null($selected_state_id)){

        }

        return view('admin.delivery', ['Delivery' => null, 'States' => $allState, 'selected_state_id' => $selected_state_id, 'Cities' => NULL]);
    }
}
