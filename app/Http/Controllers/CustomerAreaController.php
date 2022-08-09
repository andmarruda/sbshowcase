<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerAreaController extends Controller
{
    /**
     * Show view of customer login
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerLogin() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('customer-login');
    }

    /**
     * Show view of customer register
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerRegister() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('customer-register');
    }

    /**
     * Returns blade of customer area "customer dashboard"
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerArea() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('customer-area.orders');
    }

    /**
     * Returns blade of customer area "change password"
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('customer-area.change-password');
    }

    /**
     * Returns blade of customer area "registration data"
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registrationData() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('customer-area.registration-data');
    }

    /**
     * Verify if customer are logged in
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       
     * @return      bool
     */
    public function isLogged() : bool
    {
        return session_status() == PHP_SESSION_ACTIVE && (isset($_SESSION['sbcustomer-area']) && isset($_SESSION['sbcustomer-area']['email']));
    }

    /**
     * Logout of the customer's area
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function logout() : \Illuminate\Http\RedirectResponse
    {
        if($this->isLogged())
            session_destroy();

        return redirect()->route('main');
    }
}
