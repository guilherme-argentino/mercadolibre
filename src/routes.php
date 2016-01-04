<?php

// Routers Mercado Libre (Meli)
Route::group(['prefix' => 'meli' ], function () {
	// Login Page
	Route::get('/login', 'Javiertelioz\MercadoLibre\MeliController@login');
	// Callback Page
	Route::get('/callback', 'Javiertelioz\MercadoLibre\MeliController@callback');
	// Notifications Page
    Route::post('/notifications', 'Javiertelioz\MercadoLibre\MeliController@notifications');
});