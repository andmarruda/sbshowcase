<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Errors messages
     * @var array
     */
    private array $requestMessages = [
        'name.required' => 'O campo nome é obrigatório',
        'name.string' => 'O campo nome deve ser uma string',
        'name.max' => 'O campo nome deve ter no máximo: 255 caracteres',
        'email.required' => 'O campo e-mail é obrigatório',
        'email.string' => 'O campo e-mail deve ser uma string',
        'email.email' => 'O campo e-mail deve ser um e-mail válido',
        'email.max' => 'O campo e-mail deve ter no máximo: 255 caracteres',
        'email.unique' => 'O campo e-mail já está cadastrado',
        'password.required' => 'O campo senha é obrigatório',
        'password.string' => 'O campo senha deve ser uma string',
        'password.regex' => 'O campo senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número',
        'password.min' => 'O campo senha deve ter no mínimo: 8 caracteres',
        'password.confirmed' => 'O campo senha deve ser igual ao campo confirmação de senha'
    ];

    /**
     * Returns the blade of login
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       Request $request
     * @return      \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginView() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('admin.login');
    }

    /**
     * Creates a new user
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       string $name
     * @param       string $email
     * @param       string $password
     * @return      bool
     */
    protected function createUser(string $name, string $email, string $password) : bool
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);
    }

    /**
     * Returns the view of users form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $user = is_null($id) ? NULL : User::withTrashed()->find($id);
        return view('admin.user', ['User' => $user]);
    }

    /**
     * Search users inside of admin including disabled users
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\Response
     */
    public function search(Request $r)
    {
        $finded = ($r->input('searchType') == '' || $r->input('searchType') == '1') 
            ? User::withTrashed()->where('name', 'ilike', '%' . $r->input('searchInput') . '%')->get() 
            : User::where('name', 'ilike', '%' . $r->input('searchInput') . '%')->get();

        return response()->json($finded->toArray());
    }

    /**
     * Creates or edit user
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       Request $request
     * @return      \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|regex:/(?=.*[0-9].*)(?=.*[a-z].*)(?=.*[A-Z].*)/|min:8|confirmed'
        ], $this->requestMessages);

        $user = new User();
        $user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $saved = $user->save();
        return redirect()->route('users')->with('saved', $saved);
    }
}
