<?php 

namespace Javiertelioz\MercadoLibre\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Javiertelioz\MercadoLibre\Models\Order;

class QuestionController extends Controller {
	protected $_result = [];

	public function showall() {
		if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}

		return view('mercadolibre::admin.questions');
    }

    public function show($id) {
    	if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}

    	$product = \Meli::options('/items/'. $id, [
			'access_token' => session('access_token'),
		]);

		$this->_result = $product['body'];
		
		//echo '<pre>';
		//var_dump($this->_result);die;

		return view('mercadolibre::admin.questions.details')->with('product', $this->_result);
    }
}
