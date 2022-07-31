<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Returns the view of product form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $prod = is_null($id) ? NULL : Product::withTrashed()->find($id);
        return view('admin.product', ['Product' => $prod]);
    }
}
