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
        'name.min'  => 'O campo nome deve ter no mínimo 3 caracteres',
        'name.max'  => 'O campo nome deve ter no máximo 50 caracteres'
    ];

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
            'name' => 'required|min:3|max:50'
        ], $this->error);

        $brand = is_null($request->input('id')) ? new Brand() : Brand::withTrashed()->find($request->input('id'));
        $brand->fill([
            'name' => $request->input('name')
        ]);
        $saved = $brand->save();
        return redirect()->route('brand')->with('saved', $saved);
    }
}
