<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\General;

class GeneralController extends Controller
{
    /**
     * Require validate's messages
     * @var array
     */
    private array $requestMessages = [
        'primarybg' => 'Preencha o BG primário',
        'primarycolor' => 'Preencha a cor do texto da bg primário',
        'secondarybg' => 'Preencha o BG secundário',
        'secondarycolor' => 'Preencha a cor do texto do bg secundário',
        'highlightbg' => 'Preencha o bg da cor do destaque 1',
        'highlightcolor' => 'Preencha a cor do texto da bg do destaque 1'
    ];

    /**
     * Returns the view of template form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('admin.general', ['General' => General::find(1)]);
    }

    /**
     * Saves the change into template
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function saveTemplate(Request $r) : \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $r->validate([
            'primarybg' => 'required|min:6|max:7',
            'primarycolor' => 'required|min:6|max:7',
            'secondarybg' => 'required|min:6|max:7',
            'secondarycolor' => 'required|min:6|max:7',
            'highlightbg' => 'required|min:6|max:7',
            'highlightcolor' => 'required|min:6|max:7'
        ], $this->requestMessages);

        $general = General::find(1);
        $general->fill([
            'primarybg' => ltrim($r->input('primarybg'), '#'),
            'primarycolor' => ltrim($r->input('primarycolor'), '#'),
            'secondarybg' => ltrim($r->input('secondarybg'), '#'),
            'secondarycolor' => ltrim($r->input('secondarycolor'), '#'),
            'highlightbg' => ltrim($r->input('highlightbg'), '#'),
            'highlightcolor' => ltrim($r->input('highlightcolor'), '#')
        ]);
        $saved = $general->save();
        return redirect()->route('template')->with('saved', $saved);
    }
}
