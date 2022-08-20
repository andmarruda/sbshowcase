<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailProvider;

class EmailController extends Controller
{
    /**
     * Returns blade of email providers template
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function providers(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('admin.providers', ['EmailProvider' => NULL]);
    }

    /**
     * Saves the email provider
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           \Illuminate\Http\Request $request
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function saveProviders(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'host' => 'required|string|max:200',
            'port' => 'required|integer|between:1,65535',
            'username' => 'required|string|max:250',
            'pass' => 'required|string|max:50',
            'secure' => 'required|string|max:10',
        ], [
            'host.required' => 'O campo host é obrigatório',
            'host.string' => 'O campo host deve ser um texto',
            'host.max' => 'O campo host deve ter no máximo 200 caracteres',
            'port.required' => 'O campo port é obrigatório',
            'port.integer' => 'O campo port deve ser um número inteiro',
            'port.between' => 'O campo port deve estar entre 1 e 65535',
            'username.required' => 'O campo username é obrigatório',
            'username.string' => 'O campo username deve ser um texto',
            'username.max' => 'O campo username deve ter no máximo 250 caracteres',
            'pass.required' => 'O campo password é obrigatório',
            'pass.string' => 'O campo password deve ser um texto',
            'pass.max' => 'O campo password deve ter no máximo 50 caracteres',
            'secure.required' => 'O campo secure é obrigatório',
            'secure.string' => 'O campo secure deve ser um texto',
            'secure.max' => 'O campo secure deve ter no máximo 10 caracteres'
        ]);

        $provider = $request->input('id') != '' ? EmailProvider::find($request->input('id')) : new EmailProvider();
        $provider->fill([
            'host' => $request->input('host'),
            'port' => $request->input('port'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'secure' => $request->input('secure')
        ]);
        $saved = $provider->save();
        return redirect()->route('email.providers')->with('saved', $saved);
    }

    /**
     * Returns blade of email notification template
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notifications(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('admin.notifications', ['EmailNotificate' => NULL]);
    }
}
