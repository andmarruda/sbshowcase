<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
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
     * Returns the view of type form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
       $type = is_null($id) ? NULL : Type::withTrashed()->find($id);
       return view('admin.type', ['Type' => $type]);
    }

    /**
     * Save type
     * @version        1.0.0
     * @author         Anderson Arruda < andmarruda@gmail.com >
     * @param          Request $request
     * @return         \Illuminate\Http\RedirectResponse
     */
    public function saveType(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|max:50'
        ], $this->error);

        $type = is_null($request->input('id')) ? new Type() : Type::withTrashed()->find($request->input('id'));
        $type->fill([
            'name' => $request->input('name')
        ]);
        $saved = $type->save();
        return redirect()->route('type')->with('saved', $saved);
    }
}
