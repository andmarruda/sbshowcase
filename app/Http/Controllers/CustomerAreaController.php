<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerAreaController extends Controller
{
    /**
     * Show main page sbshowcase
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerLogin() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('customer-login');
    }
}
