<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Rules\CnpjCpf;

class CustomerAreaController extends Controller
{
    /**
     * Messages for request validation
     * @var array
     */
    private array $requestMessages = [
        'name.required' => 'O campo nome é obrigatório',
        'name.max' => 'O campo nome deve ter no máximo 100 caracteres',
        'name.min' => 'O campo nome deve ter no mínimo 5 caracteres',
        'gender.required' => 'O campo gênero é obrigatório',
        'cpf_cnpj.required' => 'O campo CPF/CNPJ é obrigatório',
        'cpf_cnpj.unique' => 'O CPF/CNPJ informado já está cadastrado',
        'cpf_cnpj.cnpj_cpf' => 'O CPF/CNPJ informado é inválido',
        'cpf_cnpj.min' => 'O CPF/CNPJ informado é inválido',
        'cpf_cnpj.max' => 'O CPF/CNPJ informado é inválido',
        'email.required' => 'O campo e-mail é obrigatório',
        'email.email' => 'O e-mail informado é inválido',
        'email.unique' => 'O e-mail informado já está cadastrado',
        'password.required' => 'O campo senha é obrigatório',
        'password.min' => 'O campo senha deve ter no mínimo 8 caracteres',
        'password.confirmed' => 'As senhas informadas não conferem',
        'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número',
        'oldPassword.required' => 'O campo senha é obrigatório',
        'oldPassword.min' => 'O campo senha deve ter no mínimo 8 caracteres',
        'oldPassword.confirmed' => 'As senhas informadas não conferem',
        'oldPassword.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número',
        'newPassword.required' => 'O campo senha é obrigatório',
        'newPassword.min' => 'O campo senha deve ter no mínimo 8 caracteres',
        'newPassword.confirmed' => 'As senhas informadas não conferem',
        'newPassword.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número',
        'cep.required' => 'O campo CEP é obrigatório',
        'cep.min' => 'O CEP informado é inválido',
        'cep.max' => 'O CEP informado é inválido',
        'address.required' => 'O campo endereço é obrigatório',
        'address.max' => 'O campo endereço deve ter no máximo 150 caracteres',
        'address.min' => 'O campo endereço deve ter no mínimo 5 caracteres',
        'number.required' => 'O campo número é obrigatório',
        'number.max' => 'O campo número deve ter no máximo 10 caracteres',
        'number.min' => 'O campo número deve ter no mínimo 1 caracteres',
        'state.required' => 'O campo estado é obrigatório',
        'city.required' => 'O campo cidade é obrigatório',
        'neighborhood.required' => 'O campo bairro é obrigatório',
        'neighborhood.max' => 'O campo bairro deve ter no máximo 50 caracteres',
        'neighborhood.min' => 'O campo bairro deve ter no mínimo 3 caracteres',
        'phone.required' => 'O campo telefone é obrigatório',
        'phone.min' => 'O telefone informado é inválido',
        'phone.max' => 'O telefone informado é inválido',
        'birthdate.required' => 'O campo data de nascimento é obrigatório',
        'birthdate.date' => 'A data de nascimento informada é inválida',
        'user.required' => 'O campo Email / CPF / CNPJ é obrigatório',
    ];

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
     * Show view of customer registered
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerRegistered() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('customer-registered');
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
            'zip_code'      => 'required|min:9|max:9',
            'address'       => 'required|min:5|max:150',
            'number'        => 'required|min:1|max:10',
            'neighborhood'  => 'required|min:3|max:50',
            'state'         => 'required',
            'city'          => 'required',
            'phone'         => 'required|min:14|max:15',
            'birthdate'     => 'required|date'
        ], $this->requestMessages);

        $saved = Customer::create([
            'name' => $r->input('name'),
            'gender' => $r->input('gender'),
            'cpf_cnpj' => $r->input('cpf_cnpj'),
            'email' => $r->input('email'),
            'password' => bcrypt($r->input('password')),
            'zip_code' => $r->input('zip_code'),
            'address' => $r->input('address'),
            'number' => $r->input('number'),
            'neighborhood' => $r->input('neighborhood'),
            'state_id' => $r->input('state'),
            'city_id' => $r->input('city'),
            'phone' => $r->input('phone'),
            'birth_date' => $r->input('birthdate'),
            'complement' => $r->input('complement')
        ]);

        return redirect()->route('customer-registered')->with('saved', $saved->wasRecentlyCreated)->with('name', $r->input('name'));
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
     * Makes login of customer
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       Request $r
     * @return      \Illuminate\Http\RedirectResponse
     */
    public function login(Request $r) : \Illuminate\Http\RedirectResponse
    {
        $r->validate([
            'user' => 'required',
            'password' => 'required|min:8|regex:/(?=.*[0-9].*)(?=.*[a-z].*)(?=.*[A-Z].*)/'
        ], $this->requestMessages);

        $customer = Customer::where('email', '=', $r->input('user'))->orWhere('cpf_cnpj', '=', $r->input('user'))->first();

        if(!is_null($customer) && $customer->count() > 0 && password_verify($r->input('password'), $customer->first()->password)){
            session_start();
            $_SESSION['sbcustomer-area']['email'] = $customer->email;
            $_SESSION['sbcustomer-area']['name'] = $customer->name;
            $_SESSION['sbcustomer-area']['id'] = $customer->id;
            return redirect()->route('customer-area');
        } else {
            return redirect()->route('customer-login')->withErrors('error', 'E-mail ou senha incorretos');
        }
    }

    /**
     * Update customer password
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       Request $r
     * @return      \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $r) : \Illuminate\Http\RedirectResponse
    {
        $r->validate([
            'oldPassword' => 'required|min:8|regex:/(?=.*[0-9].*)(?=.*[a-z].*)(?=.*[A-Z].*)/',
            'newPassword' => 'required|min:8|regex:/(?=.*[0-9].*)(?=.*[a-z].*)(?=.*[A-Z].*)/|confirmed'
        ], $this->requestMessages);
        $ca = Customer::find($_SESSION['sbcustomer-area']['id']);
        if(!is_null($ca) && $ca->count() > 0 && password_verify($r->input('oldPassword'), $ca->password)){
            $ca->password = bcrypt($r->input('newPassword'));
            $saved = $ca->save();
            return redirect()->route('customer-change-password')->with('saved', $saved);
        } else {
            return redirect()->route('customer-change-password')->withErrors('error', 'Senha atual incorreta');
        }
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
