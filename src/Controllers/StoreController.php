<?php 

namespace Javiertelioz\MercadoLibre\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Javiertelioz\MercadoLibre\Models\Order;

class StoreController extends Controller {
	protected $_result = [];

	public function showall() {
		if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}

		$stores = \Meli::get('users/' . session('profile')->id . '/brands', []);
		//dd($stores);
		$this->_result = $stores['body'];

		return view('mercadolibre::admin.stores')->with('stores', $this->_result);
    }

    public function show($id) {
    	if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}

		$store = \Meli::get('/users/' . session('profile')->id . '/brands/' . $id , []);

		$categories = [];

		if(isset($store['body']->categories_ids) && !empty($store['body']->categories_ids)) {
			foreach ($store['body']->categories_ids as $category) {
				$childrens = [];
				$_category = \Meli::get('/categories/' . $category , []);

				if(isset($_category['body']->children_categories) 
					&& !empty($_category['body']->children_categories)) {

					foreach ($_category['body']->children_categories as $children) {
						$childrens[] = [
							'id' => $children->id,
							'name' => $children->name,
							'total_items' => $children->total_items_in_this_category
						];
					}

				}
				
				$categories[] = [
					'id'=> $_category['body']->id,
					'name'=> $_category['body']->name,
					'picture'=> $_category['body']->picture,
					'permalink'=> $_category['body']->permalink,
					'total_items_in_this_category'=> $_category['body']->total_items_in_this_category,
					'children_categories'=> $childrens,
				];
			}
		}

		$this->_result = [
			'_store' =>$store['body'],
			'_categories' => $categories
		];
		//echo '<pre>';
		//var_dump($this->_result);die;
		
		return view('mercadolibre::admin.stores.details')->with('data', $this->_result);
    }
}
