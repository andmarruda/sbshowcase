<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
     * Return all measures not disabled
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Database\Eloquent\Collection
     */
    public static function allEnabled() : \Illuminate\Database\Eloquent\Collection
    {
        return Measure::all();
    }

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
     * Search measure inside of admin including disabled measures
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $request
     * @return          \Illuminate\Http\Response
     */
    public function searchMeasurement(Request $request)
    {
        $finded = ($request->input('searchType') == '' || $request->input('searchType') == '1') 
            ? Measure::select(DB::raw('length::varchar || \'x\' || width::varchar || \'x\' || height::varchar AS name, *'))->withTrashed()->where('width', '=', $request->input('searchInput'))->orWhere('height', '=', $request->input('searchInput'))->orWhere('length', '=', $request->input('searchInput'))->get() 
            : Measure::select(DB::raw('length::varchar || \'x\' || width::varchar || \'x\' || height::varchar AS name, *'))->where('width', '=', $request->input('searchInput'))->orWhere('height', '=', $request->input('searchInput'))->orWhere('length', '=', $request->input('searchInput'))->get();

        return response()->json($finded->toArray());
    }

    /**
     * Disable measure or enable measure depending on his actual status
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $request
     * @return          \Illuminate\Http\Response
     */
    public function deleteMeasurement(Request $request)
    {
        $measure = Measure::withTrashed()->find($request->input('id'));
        if(!is_null($measure->deleted_at))
            $measure->restore();
        else
            $measure->delete();

        return response()->json(['success' => true]);
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