<?php 

namespace Javiertelioz\MercadoLibre\Controllers;

use Illuminate\Http\Request;
use Petsy\Http\Controllers\Controller;
use Javiertelioz\MercadoLibre\Models\Order;

class QuestionController extends Controller {
	protected $_result = [];

	public function showall() {
		if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}
		$order = \Meli::get('/orders/search/recent', [
			'access_token' => session('access_token'),
			'seller' => session('profile')->id,
			'order' => 'asc'
		]);
		$this->_result = $order['body'];		
		return view('mercadolibre::admin.orders')->with('orders', $this->_result);
    }

    public function show($id) {
    	if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}
		
		$order = \Meli::get('orders/' . $id, [
			'access_token' => session('access_token')
		]);
		
		$this->_result = $order['body'];
		
		return view('mercadolibre::admin.order.details')->with('order', $this->_result);
    }

    public function getRecentOrders() {
    	if(!session('profile')) {
    		return \Redirect::to('/meli/login');
    	}
		
		$orders = \Meli::get('/orders/search/recent', [
			'access_token' => session('access_token'),
			'seller' => session('profile')->id,
			'order' => 'desc',
			]);

		$orderList = [];
		if(!empty($orders['body']) && isset($orders['body']->results)) {
			foreach ($orders['body']->results as $order) {
				$orderList[] = array(
					'<a href="' . url("/meli/admin/order", ["id"=> $order->id]) . '" target="_blank">' . $order->id .'</a>',
					$order->status,
					$order->buyer->first_name . ' ' . $order->buyer->last_name,
					$order->buyer->email,
					$order->buyer->phone->number,
					'$ ' . number_format($order->total_amount, 2),
					//date('Y-m-d H:i', strtotime($order->date_last_updated)),
					date('Y-m-d', strtotime($order->date_created))
				);
				$this->_result = $orderList;
			}
		}
		$this->_result = $orderList;

		return response()->json([ 'data' => $this->_result]);
    }
}