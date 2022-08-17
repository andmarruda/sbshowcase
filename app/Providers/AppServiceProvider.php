<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\PublicTemplateComposer;
use App\Http\View\Composers\ProductFormComposer;
use App\Http\View\Composers\EligibleDeliveryComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Paginator::defaultSimpleView('pagination.simple-bootstrap-5');
        Paginator::defaultView('pagination.bootstrap-5');
        //Public template informations
        View::composer(['template.public', 'homepage', 'product-detail', 'product-list', 'template.customer', 'template.includes.product', 'admin.dashboard'], PublicTemplateComposer::class);
        View::composer('admin.product', ProductFormComposer::class);
        View::composer('template.includes.eligible-delivery', EligibleDeliveryComposer::class);
    }
}
