<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dingo\Api\Transformer\Adapter\Fractal;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Setting a default json serializer
        $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app) {
            $fractal = new Manager();
            $serializer = new JsonApiSerializer('https://' . env('API_DOMAIN', 'the-blog.local') . '/' . env('API_PREFIX', 'v1'));
            $fractal->setSerializer($serializer);

            // return a new Fractal instance
            return new Fractal($fractal, 'include', ',', true);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
