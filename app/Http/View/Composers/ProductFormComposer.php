<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Http\Controllers\ProductController;

class ProductFormComposer{
    public function compose(View $view)
    {
        $pc = new ProductController();
        $view->with('infos', $pc->productFormInfo());
    }
}