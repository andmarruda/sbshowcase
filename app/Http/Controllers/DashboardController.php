<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\General;
use App\Models\OrderStatus;
use \DateTime;

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
        $status = OrderStatus::orderBy('id')->get();
        $initial_date = new DateTime("first day of this month");
        $final_date = new DateTime("last day of this month");

        return view('admin.dashboard', ['Products' => $product, 'General' => $general, 'OrderStatus' => $status, 'initial_date' => $initial_date->format('Y-m-d'). ' 00:00:00', 'final_date' => $final_date->format('Y-m-d'). ' 23:59:59']);
    }

    /**
     * Update highlight product at dashboard
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $request
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function updateHighlightProduct(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|integer',
            'highlight_target' => 'required|integer'
        ]);

        $general = General::find(1);
        switch($request->input('highlight_target')){
            case '1':
                $general->highlight_product_1 = $request->input('product_id');
            break;

            case '2':
                $general->highlight_product_2 = $request->input('product_id');
            break;

            case '3':
                $general->highlight_product_3 = $request->input('product_id');
            break;
        }        
        $general->save();
        return redirect()->route('dashboard');
    }
}
