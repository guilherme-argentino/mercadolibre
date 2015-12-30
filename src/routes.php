<?php

// Routers Mercado Libre (Meli)
Route::group(['prefix' => 'meli' ], function () {
    Route::get('/notifications', 'javiertelioz\mercado-libre\MercadoLibreController@notifications');
});