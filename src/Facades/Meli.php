<?php

namespace Javiertelioz\MercadoLibre;

use Illuminate\Support\Facades\Facade;

class Meli extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'meli';
    }
}