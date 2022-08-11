<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\CnpjCpf;

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
        $state = new StateController();
        $city = new CityController();
        return view('customer-register', ['State' => $state->allAvailableStates(), 'City' => $city->allAvailableCities()]);
    }

    /**
     * Creates a new customer
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function createCustomer(Request $r) : \Illuminate\Http\RedirectResponse
    {
        $r->validate([
            'name'          => 'required|min:5|max:100',
            'gender'        => 'required',
            'cpf_cnpj'      => ['required', 'min:11', 'max:14', new CnpjCpf(), 'unique:customers'],
            'email'         => 'required|email|unique:customers',
            'password'      => 'required|min:8|regex:/(?=.*[0-9].*)(?=.*[a-z].*)(?=.*[A-Z].*)/|confirmed',
            'cep'           => 'required|min:9|max:9',
            'address'       => 'required|min:5|max:150',
            'number'        => 'required|min:1|max:10',
            'neighborhood'  => 'required|min:3|max:50',
            'state'         => 'required',
            'city'          => 'required',
            'phone'         => 'required|min:14|max:15',
            'birthdate'     => 'required|date'
        ], $this->requestMessages);

        return redirect()->route('change-password')->withErrors('oldPassword', 'Senha atual incorreta!');
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
