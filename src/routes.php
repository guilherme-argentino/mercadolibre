<?php
/**
 * Routers Mercado Libre (Meli)
 */
Route::group(['prefix' => 'meli' ], function () {
	// Login Page
	Route::get('/login', 'Javiertelioz\MercadoLibre\Controllers\MeliController@login');
    // Logout Page
    Route::get('/admin/logout', 'Javiertelioz\MercadoLibre\Controllers\MeliController@logout');
	// Callback Page
	Route::get('/callback', 'Javiertelioz\MercadoLibre\Controllers\MeliController@callback');
	// Notifications Page
    Route::post('/notifications', 'Javiertelioz\MercadoLibre\Controllers\MeliController@notifications');
    Route::get('/admin/get_notifications', 'Javiertelioz\MercadoLibre\Controllers\MeliController@getNotifications');
    //Admin Page
    Route::get('/admin', 'Javiertelioz\MercadoLibre\Controllers\MeliController@admin');
    //Admin Ajax
    Route::get('/ajax-admin', 'Javiertelioz\MercadoLibre\Controllers\MeliController@ajax');

    // Order Controllers 
    Route::get('/admin/orders', 'Javiertelioz\MercadoLibre\Controllers\OrderController@showall');
    Route::get('/admin/order/{id}', 'Javiertelioz\MercadoLibre\Controllers\OrderController@show');
    Route::get('/admin/recent_orders', 'Javiertelioz\MercadoLibre\Controllers\OrderController@getRecentOrders');
    Route::post('/admin/get_orders', 'Javiertelioz\MercadoLibre\Controllers\OrderController@getAllOrders');

    // Product Controllers 
    Route::get('/admin/products', 'Javiertelioz\MercadoLibre\Controllers\ProductController@showall');
    Route::get('/admin/product/{id}', 'Javiertelioz\MercadoLibre\Controllers\ProductController@show');
    Route::post('/admin/get_products', 'Javiertelioz\MercadoLibre\Controllers\ProductController@getAllProducts');
    

    // Product Controllers 
    Route::get('/admin/questions', 'Javiertelioz\MercadoLibre\Controllers\QuestionController@showall');
    Route::get('/admin/question/{id}', 'Javiertelioz\MercadoLibre\Controllers\QuestionController@show');
    
    // Stores Controllers
    Route::get('/admin/stores', 'Javiertelioz\MercadoLibre\Controllers\StoreController@showall');
    Route::get('/admin/store/{id}', 'Javiertelioz\MercadoLibre\Controllers\StoreController@show');
});