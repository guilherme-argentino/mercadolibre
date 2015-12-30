<?php

namespace Javiertelioz\MercadoLibre;

use Illuminate\Support\ServiceProvider;
use Javiertelioz\MercadoLibre\Meli;

class MeliServiceProvider extends ServiceProvider
{

    protected $client_id;
    protected $client_secret;
    protected $urls;
    protected $curl_opts;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load views
        //$this->loadViewsFrom(__DIR__ . '/views', 'mercadolibre');
        // Load Config
        $this->publishes([__DIR__ . '/config/mercadolibre.php' => config_path('mercadolibre.php')]);

        $this->client_id     = config('mercadolivre.client_id');
        $this->client_secret = config('mercadolivre.client_secret');
        $this->urls          = config('mercadolivre.urls');
        $this->curl_opts     = config('mercadolivre.curl_opts');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //Register Routers
        include __DIR__. '/routes.php';
        $this->app->make('Javiertelioz\MercadoLibre\MeliController');

        $this->app->singleton('meli', function() {
            return new Meli($this->client_id, $this->client_secret, $this->urls, $this->curl_opts);
        });
    }
}
