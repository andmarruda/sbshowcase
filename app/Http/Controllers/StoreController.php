<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Require validate's messages
     * @var array
     */
    private array $requestMessages = [
        'name.required' => 'O nome da loja é obrigatório',
        'name.min' => 'O nome da loja deve ter no mínimo 3 caracteres',
        'name.max' => 'O nome da loja deve ter no máximo 50 caracteres',
        'address.required' => 'O endereço da loja é obrigatório',
        'address.min' => 'O endereço da loja deve ter no mínimo 3 caracteres',
        'address.max' => 'O endereço da loja deve ter no máximo 60 caracteres',
        'address_number.required' => 'O número do endereço da loja é obrigatório',
        'address_number.min' => 'O número do endereço da loja deve ter no mínimo 1 caracteres',
        'address_number.max' => 'O número do endereço da loja deve ter no máximo 60 caracteres',
        'address_neighborhood.required' => 'O bairro do endereço da loja é obrigatório',
        'address_neighborhood.min' => 'O bairro do endereço da loja deve ter no mínimo 3 caracteres',
        'address_neighborhood.max' => 'O bairro do endereço da loja deve ter no máximo 60 caracteres',
        'address_city.required' => 'A cidade do endereço da loja é obrigatória',
        'address_city.min' => 'A cidade do endereço da loja deve ter no mínimo 3 caracteres',
        'address_city.max' => 'A cidade do endereço da loja deve ter no máximo 60 caracteres',
        'address_state.required' => 'O estado do endereço da loja é obrigatório',
        'address_state.min' => 'O estado do endereço da loja deve ter no mínimo 2 caracteres',
        'address_state.max' => 'O estado do endereço da loja deve ter no máximo 2 caracteres',
        'address_zipcode.required' => 'O cep do endereço da loja é obrigatório',
        'address_zipcode.max' => 'O cep do endereço da loja deve ter no máximo 10 caracteres',
        'address_country.required' => 'O país do endereço da loja é obrigatório',
        'address_country.min' => 'O país do endereço da loja deve ter no mínimo 3 caracteres',
        'address_country.max' => 'O país do endereço da loja deve ter no máximo 30 caracteres',
        'google_maps_embeded.required' => 'O código do mapa do google é obrigatório',
        'google_maps_embeded.min' => 'O código do mapa do google deve ter no mínimo 50 caracteres',
        'google_maps_embeded.max' => 'O código do mapa do google deve ter no máximo 500 caracteres',
        'phone.required' => 'O telefone da loja é obrigatório',
        'phone.min' => 'O telefone da loja deve ter no mínimo 15 caracteres',
        'phone.max' => 'O telefone da loja deve ter no máximo 20 caracteres'
    ];

    /**
     * Search store inside of admin including disabled store
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\Response
     */
    public function searchStore(Request $r)
    {
        $finded = ($r->input('searchType') == '' || $r->input('searchType') == '1') 
            ? Store::withTrashed()->where('name', 'ilike', '%' . $r->input('searchInput') . '%')->get() 
            : Store::where('name', 'ilike', '%' . $r->input('searchInput') . '%')->get();

        return response()->json($finded->toArray());
    }

    /**
     * Disable store or enable store depending on his actual status
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\Response
     */
    public function deleteStore(Request $r)
    {
        $store = Store::withTrashed()->find($r->input('id'));
        if(!is_null($store->deleted_at))
            $store->restore();
        else
            $store->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Returns the view of store form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
     public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     {
        $store = is_null($id) ? NULL : Store::withTrashed()->find($id);
        return view('admin.store', ['Store' => $store]);
     }

     /**
      * Save a store
      * @version        1.0.0
      * @author         Anderson Arruda < andmarruda@gmail.com >
      * @param          Request $r
      * @return         \Illuminate\Http\RedirectResponse
      */
    public function saveStore(Request $r) : \Illuminate\Http\RedirectResponse
    {
        $r->validate([
            'name' => 'required|min:3|max:50',
            'address' => 'required|min:3|max:60',
            'address_number' => 'required|min:1|max:60',
            'address_neighborhood' => 'required|min:3|max:60',
            'address_city' => 'required|min:3|max:60',
            'address_state' => 'required|min:2|max:2',
            'address_zipcode' => 'required|max:10',
            'address_country' => 'required|min:3|max:30',
            'google_maps_embeded' => 'required|min:50|max:500',
            'phone' => 'required|min:15|max:20',
        ], $this->requestMessages);
        $store = is_null($r->input('id')) ? new Store() : Store::find($r->input('id'));
        $store->fill([
            'name' => $r->input('name'),
            'address' => $r->input('address'),
            'address_number' => $r->input('address_number'),
            'address_complement' => $r->input('address_complement'),
            'address_neighborhood' => $r->input('address_neighborhood'),
            'address_city' => $r->input('address_city'),
            'address_state' => $r->input('address_state'),
            'address_zipcode' => $r->input('address_zipcode'),
            'address_country' => $r->input('address_country'),
            'google_maps_embeded' => $r->input('google_maps_embeded'),
            'phone' => $r->input('phone')
        ]);

        $saved = $store->save();
        return redirect()->route('store')->with('saved', $saved);
    }
}
