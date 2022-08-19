<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
