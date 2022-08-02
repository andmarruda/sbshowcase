<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Number of products per page
     * @var integer
     */
    private int $productsPerPage = 12;

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

    /**
     * Shows a list of the last products registered and a possibility to filter products
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           string $search
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchProduct(?string $search=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        /**$products = Product::withTrashed()->orderBy('id', 'desc');
        if(!is_null($search)){
            $products = $products->where('name', 'ilike', '%'.$search.'%');
        }
        $products = $products->paginate($this->productsPerPage);
        return view('admin.product-list', ['Products' => $products, 'Search' => $search]);**/
        return view('admin.product-list', ['search' => $search]);
    }
}
