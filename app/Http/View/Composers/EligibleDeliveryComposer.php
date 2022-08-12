<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Http\Controllers\DeliveryController;

class EligibleDeliveryComposer{
    public function compose(View $view)
    {
        $dc = new DeliveryController();
        $view->with('eligible', $dc->searchFreeDelivery());
    }
}