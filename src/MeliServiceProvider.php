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
            __DIR__ . '/views' => base_path('resources/views/mercadolibre'),
            __DIR__ . '/migrations' => base_path('database/migrations')
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

        include __DIR__. '/routes.php';
        $this->app->make('Javiertelioz\MercadoLibre\Controllers\MeliController');
        $this->app->make('Javiertelioz\MercadoLibre\Controllers\OrderController');
        $this->app->make('Javiertelioz\MercadoLibre\Controllers\ProductController');
        $this->app->make('Javiertelioz\MercadoLibre\Controllers\QuestionController');
        $this->app->make('Javiertelioz\MercadoLibre\Controllers\StoreController');
        $this->app->make('Javiertelioz\MercadoLibre\Controllers\TaskController');
    }
}