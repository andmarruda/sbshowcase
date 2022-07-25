<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    /**
     * Errors messages
     * @var array
     */
    private array $error = [
        'name.required' => 'O campo nome é obrigatório',
        'name.min'  => 'O campo nome deve ter no mínimo 3 caracteres',
        'name.max'  => 'O campo nome deve ter no máximo 50 caracteres',
        'hex_code.required' => 'O campo código hexadecimal é obrigatório',
        'hex_code.min' => 'O campo código hexadecimal deve ter no mínimo 4 caracteres',
        'hex_code.max' => 'O campo código hexadecimal deve ter no máximo 7 caracteres'
    ];

    /**
     * Returns the view of color form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
       $color = is_null($id) ? NULL : Color::withTrashed()->find($id);
       return view('admin.color', ['Color' => $color]);
    }

    /**
     * Find color by his name
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $request
     * @return          \Illuminate\Http\Response
     */
    public function searchColor(Request $request)
    {
        $finded = ($request->input('searchType') == '' || $request->input('searchType') == '1') 
            ? Color::withTrashed()->where('name', 'ilike', '%'. $request->input('searchInput'). '%')->get() 
            : Color::where('name', '=', '%'. $request->input('searchInput'). '%')->get();

        return response()->json($finded->toArray());
    }

    /**
     * Enable or disable color depending on his current status
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $request
     * @return          \Illuminate\Http\Response
     */
     public function deleteColor(Request $request)
     {
            $color = Color::withTrashed()->find($request->input('id'));
            if(!is_null($color->deleted_at))
            {
                $color->restore();
            }
            else
            {
                $color->delete();
            }
            return response()->json(['success' => true]);
     }

    /**
     * Save color
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $request
     * @return          \Illuminate\Http\Response
     */
    public function saveColor(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'hex_code' => 'required|min:4|max:7'
        ], $this->error);
        $color = is_null($request->input('id')) ? new Color() : Color::find($request->input('id'));
        $color->fill([
            'name' => $request->input('name'),
            'hex_code' => $request->input('hex_code')
        ]);
        $saved = $color->save();
        return redirect()->route('color')->with('saved', $saved);
    }
}
