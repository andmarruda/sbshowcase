<?php

namespace App\Providers;

//use App
use Illuminate\Mail\Mailer;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mailer\Transport;

use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\PublicTemplateComposer;
use App\Http\View\Composers\ProductFormComposer;
use App\Http\View\Composers\EligibleDeliveryComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\EmailProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('custom.mailer', function($app, $parameters){
            $ep = EmailProvider::where('email', '=', $parameters['email'])->first();
            if(is_null($ep))
                throw new \Exception('Email provider not found with parameter email: '. $parameters['email']);

            $mailer = new Mailer('custom-mailer', $app->get('view'), transport::fromDsn('smtp://'. $ep->email. ':'. $ep->password. '@'. $ep->host. ':'. $ep->port), $app->get('events'));
            $mailer->alwaysFrom($ep->email, $parameters['name']);
            $mailer->alwaysReplyTo($ep->email, $parameters['name']);

            return $mailer;
        });
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
        View::composer(['template.public', 'homepage', 'product-detail', 'product-list', 'template.customer', 'template.includes.product', 'admin.dashboard', 'email.order-receive', ], PublicTemplateComposer::class);
        View::composer('admin.product', ProductFormComposer::class);
        View::composer('template.includes.eligible-delivery', EligibleDeliveryComposer::class);
    }
}
