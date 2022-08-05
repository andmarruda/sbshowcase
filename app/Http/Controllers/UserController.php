<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;

if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

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
        'password.confirmed' => 'O campo senha deve ser igual ao campo confirmação de senha',
        'oldPassword.required' => 'O campo senha é obrigatório',
        'oldPassword.string' => 'O campo senha deve ser uma string',
        'oldPassword.regex' => 'O campo senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número',
        'oldPassword.min' => 'O campo senha deve ter no mínimo: 8 caracteres',
        'oldPassword.confirmed' => 'O campo senha deve ser igual ao campo confirmação de senha',
        'newPassword.required' => 'O campo senha é obrigatório',
        'newPassword.string' => 'O campo senha deve ser uma string',
        'newPassword.regex' => 'O campo senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número',
        'newPassword.min' => 'O campo senha deve ter no mínimo: 8 caracteres',
        'newPassword.confirmed' => 'O campo senha deve ser igual ao campo confirmação de senha',
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
     * Verify if user are logged in
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       
     * @return      bool
     */
    public function isLogged() : bool
    {
        return session_status() == PHP_SESSION_ACTIVE && (isset($_SESSION['sbshowcase']) && isset($_SESSION['sbshowcase']['email']));
    }

    /**
     * Verify if is the configuration user
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return      bool
     */
    public function isConfig() : bool
    {
        return $_SESSION['sbshowcase']['id']==1;
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
    public function createUser(string $name, string $email, string $password) : bool
    {
        $created = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);
        return $created instanceof User;
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
     * Disable category or enable category depending on his actual status
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\JsonResponse
     */
    public function delete(Request $r) : \Illuminate\Http\JsonResponse
    {
        $user = User::withTrashed()->find($r->input('id'));
        if(!is_null($user->deleted_at))
            $user->restore();
        else
            $user->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Returns the view of change password
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePasswordView() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('admin.change-password');
    }

    /**
     * Execute the user's password change
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $r) : \Illuminate\Http\RedirectResponse
    {
        $r->validate([
            'oldPassword' => 'required|string|regex:/(?=.*[0-9].*)(?=.*[a-z].*)(?=.*[A-Z].*)/|min:8',
            'newPassword' => 'required|string|regex:/(?=.*[0-9].*)(?=.*[a-z].*)(?=.*[A-Z].*)/|min:8|confirmed'
        ]);

        $user = User::find($_SESSION['sbshowcase']['id']);
        if(password_verify($r->input('oldPassword'), $user->password))
        {
            $user->password = bcrypt($r->input('newPassword'));
            $saved = $user->save();
            return redirect()->route('change-password')->with('saved', $saved);
        }
        
        return redirect()->route('change-password')->withErrors('oldPassword', 'Senha atual incorreta!');
    }

    /**
     * Login into the system
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function login(Request $r) : \Illuminate\Http\RedirectResponse
    {
        $r->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|regex:/(?=.*[0-9].*)(?=.*[a-z].*)(?=.*[A-Z].*)/|min:8'
        ], $this->requestMessages);
        $user = User::where('email', '=', $r->input('email'));
        if($user->count() > 0 && password_verify($r->input('password'), $user->first()->password)){
            $user = $user->first();
            $_SESSION['sbshowcase'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ];
            return redirect()->route('dashboard');
        }

        return redirect()->route('admin')->withErrors(['email' => 'Usuário ou senha inválidos']);
    }

    /**
     * Logout of the system
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function logout() : \Illuminate\Http\RedirectResponse
    {
        if($this->isLogged())
            session_destroy();

        return redirect()->route('admin');
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
        $user = is_null($request->input('id')) ? new User() : User::withTrashed()->find($request->input('id'));
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignoreModel($user)],
            'password' => 'required|string|regex:/(?=.*[0-9].*)(?=.*[a-z].*)(?=.*[A-Z].*)/|min:8|confirmed'
        ], $this->requestMessages);

        $user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $saved = $user->save();
        return redirect()->route('users')->with('saved', $saved);
    }
}
