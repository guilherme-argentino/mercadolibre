<?php 

namespace Javiertelioz\MercadoLibre\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function getAllProducts(Request $request) {
    	$products = \Meli::get('/sites/MLM/search', [
			'access_token' => session('access_token'),
			'seller_id' => session('profile')->id,
			'limit' => 100,
			//'order' => 'desc',
			//'offset' => 20,
		]);
		//echo '<pre>';
		//var_dump($products);die;

		if(!empty($products['body']->results)) {
			foreach ($products['body']->results as $product) {
				//dd($products);die;
				$this->_result['data'][] = [
					'<input type="checkbox" name="id[]" value="'.  $product->id .'">',
					'<a href="'. $product->permalink . '" target="_blank">'. $product->id .'</a>',
					$product->title,
					$product->category_id,
					'$' . number_format($product->price, 2),
					$product->available_quantity,
					$product->sold_quantity,
					date('Y-m-d H:i', strtotime($product->stop_time)),
					'<img src="' . $product->thumbnail . '">',
					'<a href="'. url('/meli/admin/product', ['id'=> $product->id]) . '" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-edit"></i> Edit</a>',
				];
			}
		} else {
			$this->_result['data'] = [];
		}
		return response()->json($this->_result);
    }

    public function show($id) {
    	if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}

		/*$product = \Meli::get('/myfeeds', [
			'access_token' => session('access_token'),
			'app_id' => env('ML_APP_ID')
		]);dd($product)*/;
		/*dd(\Meli::get('/items/'. $id, [
			'access_token' => session('access_token'),
			'seller' => session('profile')->id,
			'order' => 'asc'
		]));

		dd($product);*/

		
		
		$product = \Meli::get('/items/' . $id, [
			'access_token' => session('access_token'),
		]);
		
		
		//echo '<pre>';
		//var_dump($product['body']);die;

		$this->_result = $product['body'];

		//dd($this->_result);

		// echo '<pre>';
		// var_dump($this->_result->shipping);
		// echo '</pre>';

		//dd($this->_result);
		
		return view('mercadolibre::admin.product.details')->with('product', $this->_result);
    }
}
