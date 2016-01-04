<?php

namespace Javiertelioz\MercadoLibre\Facades;

use Illuminate\Support\Facades\Facade;

class Meli extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'meli';
    }
}