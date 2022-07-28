<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ShowcaseController extends Controller
{
    /**
     * Prepare informations for showcase template
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          Array
     */
    public function templateInfo()
    {
        return [
            'categories' => Category::orderBy('id')->get(),
        ];
    }

    /**
     * Show main page sbshowcase
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('template.public')->with('template', $this->templateInfo());
    }
}
