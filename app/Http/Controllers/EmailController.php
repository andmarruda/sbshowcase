<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\EmailProvider;
use App\Models\NotifyEmail;

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
        $provider = is_null($id) ? NULL : EmailProvider::withTrashed()->find($id);
        return view('admin.providers', ['EmailProvider' => $provider]);
    }

    /**
     * Search providers
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           \Illuminate\Http\Request $request
     * @return          \Illuminate\Http\JsonResponse
     */
    public function searchProviders(Request $request) : \Illuminate\Http\JsonResponse
    {
        $providers = EmailProvider::withTrashed()->select(DB::raw('email as name, *'))->where('email', 'ilike', '%'.$request->input('search').'%')->get();
        return response()->json($providers);
    }

    /**
     * Delete provider
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           \Illuminate\Http\Request $request
     * @return          \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request) : \Illuminate\Http\JsonResponse
    {
        $provider = EmailProvider::withTrashed()->find($request->input('id'));
        if(!is_null($provider->deleted_at))
            $provider->restore();
        else
            $provider->delete();

        return response()->json(['success' => true]);
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
            'email' => $request->input('username'),
            'password' => $request->input('pass'),
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
        $notify = is_null($id) ? NULL : NotifyEmail::withTrashed()->find($id);
        return view('admin.notifications', ['EmailNotificate' => $notify]);
    }

    /**
     * Search email to be notifiable
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           \Illuminate\Http\Request $request
     * @return          \Illuminate\Http\JsonResponse
     */
    public function searchNotifications(Request $request) : \Illuminate\Http\JsonResponse
    {
        $notify = NotifyEmail::withTrashed()->where('name', 'ilike', '%'.$request->input('search').'%')->get();
        return response()->json($notify);
    }

    /**
     * Delete email to be notified
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           \Illuminate\Http\Request $request
     * @return          \Illuminate\Http\JsonResponse
     */
    public function deleteNotifications(Request $request) : \Illuminate\Http\JsonResponse
    {
        $notify = NotifyEmail::withTrashed()->find($request->input('id'));
        if(!is_null($notify->deleted_at))
            $notify->restore();
        else
            $notify->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Save a email to be nofitied
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           \Illuminate\Http\Request $request
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function saveNotifications(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:250',
        ], [
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser um texto',
            'name.max' => 'O campo nome deve ter no máximo 100 caracteres',
            'email.required' => 'O campo email é obrigatório',
            'email.string' => 'O campo email deve ser um texto',
            'email.max' => 'O campo email deve ter no máximo 250 caracteres',
        ]);
        
        $notification = $request->input('id') != '' ? NotifyEmail::find($request->input('id')) : new NotifyEmail();
        $notification->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        $saved = $notification->save();
        return redirect()->route('email.notifications')->with('saved', $saved);
    }
}
