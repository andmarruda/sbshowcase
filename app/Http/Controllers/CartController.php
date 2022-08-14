<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Shows the cart interface with all added products and so on
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('cart');
    }
}
