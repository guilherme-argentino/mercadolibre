<?php 

namespace Javiertelioz\MercadoLibre\Controllers;

use Illuminate\Http\Request;
use Petsy\Http\Controllers\Controller;
use Javiertelioz\MercadoLibre\Models\Order;

class ProductController extends Controller {
	protected $_result = [];

	public function showall() {
		
		if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}
		
		$items = \Meli::get('/sites/MLM/search', [
			'access_token' => session('access_token'),
			'seller_id' => session('profile')->id,
			'limit' => 50,
			//'order' => 'desc',
			'offset' => 20,

		]);

		//echo '<pre>';
		//var_dump($items);die;
		//dd($items);

		$this->_result = $items['body'];
		return view('mercadolibre::admin.products')->with('products', $this->_result);
    }

    public function show($id) {
    	if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}

		/*$product = \Meli::get('/myfeeds', [
			//'access_token' => session('access_token'),
			'app_id' => env('ML_APP_ID')
		]);dd($product)*/;
		dd(\Meli::get('/items/'. $id, [
			'access_token' => session('access_token'),
			'seller' => session('profile')->id,
			'order' => 'asc'
		]));

		dd($product);
		
		
		$product = \Meli::get('/items/' . $id, [
			'access_token' => session('access_token'),
		]);
		//var_dump($order);die;

		$this->_result = $product['body'];

		dd($this->_result);

		// echo '<pre>';
		// var_dump($this->_result->shipping);
		// echo '</pre>';

		//dd($this->_result);
		
		return view('mercadolibre::admin.product.details')->with('product', $this->_result);
    }
}