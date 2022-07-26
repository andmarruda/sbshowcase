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
    private array $requestMessages = [];

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
            'category' => 'required|min:3|max:100'
        ], $this->requestMessages);
        $store = is_null($r->input('id')) ? new Store() : Store::find($r->input('id'));
        $store->fill([
            'name' => $r->input('category')
        ]);

        $saved = $store->save();
        return redirect()->route('store')->with('saved', $saved);
    }
}
