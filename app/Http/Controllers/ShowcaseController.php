<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Template;
use App\Models\General;
use App\Models\SocialMediaUrl;
use App\Models\PaymentMethod;
use App\Models\Store;
use App\Models\Banner;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Type;

class ShowcaseController extends Controller
{
    /**
     * Prepare informations for showcase template
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          Array
     */
    public function templateInfo()
    {
        return [
            'categories'    => Category::orderBy('id')->get(),
            'templates'     => Template::find(1),
            'general'       => General::find(1),
            'SocialMedia'   => SocialMediaUrl::all(),
            'PaymentMethod' => PaymentMethod::where('installments', '>', 0)->get()
        ];
    }

    /**
     * Show main page sbshowcase
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('template.public');
    }

    /**
     * Show our stores pages
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stores() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('our-stores', ['Stores' => Store::all()]);
    }

    /**
     * Show homepage
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $banners = Banner::all();
        return view('homepage', ['Banner' => $banners]);
    }

    /**
     * Show product details
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productDetail(?int $id=NULL, ?string $name=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $prod = Product::find($id);
        return view('product-detail', ['Product' => $prod]);
    }

    /**
     * Show products by category product list
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $id
     * @param           string $name
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productList(int $id, string $name) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $category = Category::find($id);
        $measures = Measure::all();
        $brand = Brand::all();
        $color = Color::all();
        $type = Type::all();
        return view('product-list', ['Category' => $category, 'Measures' => $measures, 'Brands' => $brand, 'Colors' => $color, 'Types' => $type]);
    }
}
