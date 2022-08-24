<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\City;
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
        'state_id.required' => 'O campo estado é obrigatório',
        'city_id.required' => 'O campo cidade é obrigatório',
        'neighborhood.required' => 'O campo bairro é obrigatório',
        'neighborhood.max' => 'O campo bairro deve ter no máximo 50 caracteres',
        'neighborhood.min' => 'O campo bairro deve ter no mínimo 3 caracteres',
        'phone.required' => 'O campo telefone é obrigatório',
        'phone.min' => 'O telefone informado é inválido',
        'phone.max' => 'O telefone informado é inválido',
        'birthdate.required' => 'O campo data de nascimento é obrigatório',
        'birthdate.date' => 'A data de nascimento informada é inválida',
        'birth_date.required' => 'O campo data de nascimento é obrigatório',
        'birth_date.date' => 'A data de nascimento informada é inválida',
        'user.required' => 'O campo Email / CPF / CNPJ é obrigatório',
    ];
    
    /**
     * Available gender for customer
     * @var array
     */
    private array $genders = [1 => 'Feminino', 2 => 'Masculino', 3 => 'Não informar'];

    /**
     * Show view of customer login
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?string $redirect=NULL
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerLogin(?string $redirect=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('customer-login', ['redirect' => $redirect]);
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
        return view('customer-register', ['State' => $state->allAvailableStates(), 'City' => $city->allAvailableCities(), 'Genders' => $this->genders]);
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
     * Update customer data
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $request
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function updateCustomer(Request $r) : \Illuminate\Http\RedirectResponse
    {
        $r->validate([
            'name'          => 'required|min:5|max:100',
            'gender'        => 'required',
            'zip_code'      => 'required|min:9|max:9',
            'address'       => 'required|min:5|max:150',
            'number'        => 'required|min:1|max:10',
            'neighborhood'  => 'required|min:3|max:50',
            'state_id'         => 'required',
            'city_id'          => 'required',
            'phone'         => 'required|min:14|max:15',
            'birth_date'     => 'required|date'
        ], $this->requestMessages);
        $customer = Customer::find($_SESSION['sbcustomer-area']['id']);
        $customer->name = $r->input('name');
        $customer->gender = $r->input('gender');
        $customer->zip_code = $r->input('zip_code');
        $customer->address = $r->input('address');
        $customer->number = $r->input('number');
        $customer->neighborhood = $r->input('neighborhood');
        $customer->state_id = $r->input('state_id');
        $customer->city_id = $r->input('city_id');
        $customer->phone = $r->input('phone');
        $customer->birth_date = $r->input('birth_date');
        $customer->complement = $r->input('complement');
        $saved = $customer->save();

        return redirect()->route('customer-registration-data')->with('saved', $saved);
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
        return view('customer-area.orders', ['Orders' => Order::withTrashed()->where('customer_id', '=', $_SESSION['sbcustomer-area']['id'])->get()]);
    }

    /**
     * Returns blade with order details of customer area
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $order_id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderDetail(int $order_id) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $oc = new OrderController();
        return view('customer-area.orderDetail', $oc->getOrderDetails($order_id));
    }

    /**
     * Cancel order if supports for this
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          
     */
    public function cancelOrder(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'id' => 'required'
        ], ['id.required' => 'Selecione um pedido para cancelá-lo']);

        $order = Order::where('customer_id', '=', $_SESSION['sbcustomer-area']['id'])->where('id', '=', $request->input('id'))->first();
        if(is_null($order))
            return redirect()->route('customer-order-detail', ['id' => $request->input('id')])->withErrors(['id' => 'Não foi encontrado o pedido requerido.']);

        if($order->order_status_id != 1)
            return redirect()->route('customer-order-detail', ['id' => $request->input('id')])->withErrors(['id' => 'Não é possível cancelar esse pedido através do sistema. Por favor entre em contato com a equipe de pós venda.']);

        $order->order_status_id = 5;
        $order->save();
        $order->delete();
        return redirect()->route('customer-order-detail', ['id' => $request->input('id')]);
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
     * Returns data from customer
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return         array
     */
    public function getCustomerAddress() : Customer
    {
        return Customer::select('address', 'number', 'neighborhood', 'zip_code', 'complement', 'city_id', 'state_id', 'phone')->find($_SESSION['sbcustomer-area']['id']);
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
        $ca = Customer::find($_SESSION['sbcustomer-area']['id']);
        $state = new StateController();
        $city = new CityController();
        $stateCities = City::where('state_id', '=', $ca->state_id)->orderBy('city_name', 'ASC')->get();
        return view('customer-area.registration-data', ['Customer' => $ca, 'State' => $state->allAvailableStates(), 'City' => $city->allAvailableCities(), 'Genders' => $this->genders, 'StateCities' => $stateCities]);
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
            if($r->input('redirect') != '' && Route::has($r->input('redirect'))){
                $route = Route::getRoutes()->getByName($r->input('redirect'));
                if(count($route->parameterNames()) == 0)
                    return redirect()->route($r->input('redirect'));
            }

            return redirect()->route('customer-area');
        } else {
            return redirect()->route('customer-login', ['redirect' => $r->input('redirect') ?? ''])->withErrors(['user' => 'E-mail ou senha incorretos']);
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
            return redirect()->route('customer-change-password')->withErrors(['oldPassword' => 'Senha atual incorreta']);
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
