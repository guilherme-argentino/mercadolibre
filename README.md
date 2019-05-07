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

To be continued ...
