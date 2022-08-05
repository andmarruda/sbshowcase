<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Error's messages
     * @var     array
     */
    private array $error = [
        'name.required' => 'O campo nome é obrigatório',
        'name.min'  => 'O campo nome deve ter no mínimo 2 caracteres',
        'name.max'  => 'O campo nome deve ter no máximo 50 caracteres'
    ];

    /**
     * Return all color not disabled
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Database\Eloquent\Collection
     */
    public static function allEnabled() : \Illuminate\Database\Eloquent\Collection
    {
        return Brand::all();
    }

    /**
     * Returns the view of brand form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
       $brand = is_null($id) ? NULL : Brand::withTrashed()->find($id);
       return view('admin.brand', ['Brand' => $brand]);
    }

    /**
     * Save brand
     * @version        1.0.0
     * @author         Anderson Arruda < andmarruda@gmail.com >
     * @param          Request $request
     * @return         \Illuminate\Http\RedirectResponse
     */
    public function saveBrand(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:2|max:50'
        ], $this->error);

        $brand = is_null($request->input('id')) ? new Brand() : Brand::withTrashed()->find($request->input('id'));
        $brand->fill([
            'name' => $request->input('name')
        ]);
        $saved = $brand->save();
        return redirect()->route('brand')->with('saved', $saved);
    }

    /**
     * Search brand inside of admin including disabled brand
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\Response
     */
    public function searchBrand(Request $r)
    {
        $finded = ($r->input('searchType') == '' || $r->input('searchType') == '1') 
            ? Brand::withTrashed()->where('name', 'ilike', '%' . $r->input('searchInput') . '%')->get() 
            : Brand::where('name', 'ilike', '%' . $r->input('searchInput') . '%')->get();

        return response()->json($finded->toArray());
    }

    /**
     * Disable brand or enable brand depending on his actual status
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\Response
     */
    public function deleteBrand(Request $r)
    {
        $brand = Brand::withTrashed()->find($r->input('id'));
        if(!is_null($brand->deleted_at))
            $brand->restore();
        else
            $brand->delete();

        return response()->json(['success' => true]);
    }
}
