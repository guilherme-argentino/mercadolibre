<?php

namespace Javiertelioz\MercadoLibre;

use Javiertelioz\MercadoLibre\Meli;
use Illuminate\Support\ServiceProvider;

class MeliServiceProvider extends ServiceProvider
{
    protected $defer = false;
    protected $client_id;
    protected $client_secret;
    protected $authentication_url;
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
        $this->loadViewsFrom(__DIR__ . '/views', 'mercadolibre');
        // Load Config
        $this->publishes([
            __DIR__  . '/config/mercadolibre.php' => config_path('mercadolibre.php'),
            __DIR__ . '/views' => base_path('resources/views/mercadolibre')
            ]);

        $this->client_id     = config('mercadolibre.client_id');
        $this->client_secret = config('mercadolibre.client_secret');
        $this->urls          = config('mercadolibre.urls');
        $this->curl_opts     = config('mercadolibre.curl_opts');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
         // Register Facade
        $this->app->singleton('meli', function () {
            return new Meli($this->client_id, $this->client_secret, $this->urls, $this->curl_opts);
        });
        /*$meli = new Meli($this->client_id, $this->client_secret, $this->urls, $this->curl_opts);
        $this->app->instance('Meli', $meli);*/

        include __DIR__. '/routes.php';
        $this->app->make('Javiertelioz\MercadoLibre\MeliController');
    }
}
