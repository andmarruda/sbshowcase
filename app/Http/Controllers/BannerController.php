<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display the banner's view
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       ?int $id
     * @return      \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $banner = !is_null($id) ? Banner::find($id) : NULL;
        return view('admin.banner', ['Banner' => $banner]);
    }
}
