<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Returns the view of payment methods form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('admin.payment-method', ['PaymentMethod' => PaymentMethod::withTrashed()->get()]);
    }

    /**
     * Saves all configurations of payment methods
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           \Illuminate\Http\Request $request
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function savePaymentMethods(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $paymentMethods = $request->input('payment_method');
        foreach ($paymentMethods as $key => $installment) {
            $paymentMethod = PaymentMethod::find($key);
            $paymentMethod->installments = $installment;
            $paymentMethod->save();
        }
        return redirect()->route('payment-methods')->with('saved', true);
    }
}
