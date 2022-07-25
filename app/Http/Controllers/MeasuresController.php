<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Measure;

class MeasuresController extends Controller
{
    /**
     * Error messages
     * @var array
     */
    private array $errors = [
        'width' => 'O campo largura é obrigatório',
        'height' => 'O campo altura é obrigatório',
        'length' => 'O campo comprimento é obrigatório'
    ];

    /**
     * Returns the view of category form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
       $measure = is_null($id) ? NULL : Measure::withTrashed()->find($id);
        return view('admin.measurement', ['Measurement' => $measure]);
    }

    /**
     * Saves a new measure
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           \Illuminate\Http\Request $request
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function saveMeasurement(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'width' => 'required',
            'height' => 'required',
            'length' => 'required'
        ], $this->errors);

        $measure = ($request->input('id')=='') ? new Measure() : Measure::find($request->input('id'));
        $measure->fill([
            'width' => $request->input('width'),
            'height' => $request->input('height'),
            'length' => $request->input('length')
        ]);
        $saved = $measure->save();
        return redirect()->route('measurement')->with('saved', $saved);
    }
}