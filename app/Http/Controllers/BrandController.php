<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Returns the view of brand form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
       $brand = is_null($id) ? NULL : Brand::withTrashed()->find($id);
       return view('admin.brand', ['Brand' => $brand]);
    }
}
