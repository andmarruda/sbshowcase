<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\General;

class DashboardController extends Controller
{
    /**
     * Returns the view of dashboard
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $product = Product::where('quantity', '<', 5)->orderBy('quantity')->get();
        $general = General::find(1);
        return view('admin.dashboard', ['Products' => $product, 'General' => $general]);
    }
}
