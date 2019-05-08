# mercadolibre
Mercado Libre API for laravel

# Install

Run composer requre:

```shell
$ composer require javiertelioz/mercadolibre
```

Add to config/app.php the service provider and alias

```php
    'providers' => [

        /**
         * Other Providers...
         */
        Javiertelioz\MercadoLibre\MeliServiceProvider::class,
    ],
    
    'aliases' => [

        'Meli' => Javiertelioz\MercadoLibre\Facades\Meli::class,

    ],
```

Now, publish configurations, views and migrations

```shell
$ php artisan vendor:publish --provider="Javiertelioz\MercadoLibre\MeliServiceProvider"
```

# Configure

Add the following lines to your .env file:

```
ML_APP_ID=<YOURID>
ML_APP_SECRET=<YOURSECRET>
ML_AUTHENTICATION_URL=https://<YOURHOST>/meli/callback
```

You can obtain your application ID and secret [here](https://developers.mercadolibre.com/).

To be continued ...
