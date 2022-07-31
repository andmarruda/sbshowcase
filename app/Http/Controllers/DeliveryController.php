<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliverySettings;

class DeliveryController extends Controller
{
    /**
     * default country id for the system
     * @var int
     */
    private int $defaultCountryId = 1058;

    /**
     * Require validate's messages
     * @var array
     */
    private array $requestMessages = [
        'state_id.required' => 'O campo UF é obrigatório',
        'city_id.required' => 'O campo cidade é obrigatório',
        'price.required' => 'O campo preço é obrigatório',
        'price.min' => 'O campo preço deve conter no mínimo 4 dígitos, por exemplo: 0.00'
     ];

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
            $allCity = new CityController();
            $allCity = $allCity->allCity($selected_state_id);
        }

        return view('admin.delivery', ['Delivery' => DeliverySettings::all(), 'States' => $allState, 'selected_state_id' => $selected_state_id, 'Cities' => $allCity ?? NULL]);
    }

    /**
     * Delete some existing delivery settings
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\JsonResponse
     */
    public function deleteDelivery(Request $r) : \Illuminate\Http\JsonResponse
    {
        $delivery = DeliverySettings::find($r->input('id'));
        if(!is_null($delivery))
            $delivery->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Save delivery settings
     * @version        1.0.0
     * @author         Anderson Arruda < andmarruda@gmail.com >
     * @param          Request $r
     * @return         \Illuminate\Http\RedirectResponse
     */
    public function saveDelivery(Request $r) : \Illuminate\Http\RedirectResponse
    {
        $r->validate([
            'state_id' => 'required',
            'city_id'  => 'required',
            'price'    => 'required|min:4'
        ], $this->requestMessages);

        $devSearch = DeliverySettings::where('city_id', '=', $r->input('city_id'));
        $dev = $devSearch->count() > 0 ? $devSearch->first() : new DeliverySettings();
        $dev->fill([
            'city_id' => $r->input('city_id'),
            'price'   => $r->input('price')
        ]);
        $saved = $dev->save();
        
        return redirect()->route('delivery')->with('saved', $saved);
    }
}
