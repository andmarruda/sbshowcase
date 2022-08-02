<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\PublicTemplateComposer;
use App\Http\View\Composers\ProductFormComposer;
use Illuminate\Support\Facades\View;

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
        //Public template informations
        View::composer('template.public', PublicTemplateComposer::class);
        View::composer('product', ProductFormComposer::class);
    }
}
