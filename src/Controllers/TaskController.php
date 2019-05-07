<?php 

namespace Javiertelioz\MercadoLibre\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Javiertelioz\MercadoLibre\Models\Order;

class TaskController extends Controller {
	protected $_result = [];

	public function showall() {
		if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}

		return view('mercadolibre::admin.task');
		//->with('task', $this->_result);
    }

    public function show($id) {
    	if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}
		return view('mercadolibre::admin.task.details');
		//->with('details', $this->_result);
    }
}
