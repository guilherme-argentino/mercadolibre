<?php 

namespace Javiertelioz\MercadoLibre\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Javiertelioz\MercadoLibre\Models\Order;

class OrderController extends Controller {
	protected $_result = [];

	public function showall() {
		if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}
		
		return view('mercadolibre::admin.orders'); //->with('orders', $this->_result);
    }

    public function getAllOrders(Request $request) {
    	$orderBy = $request->input('order');
    	$orderBy = !empty($orderBy[0]['dir']) ? $orderBy[0]['dir'] : 'asc';

    	$status = $request->input('order_status'); 
    	$status = !empty($status) ? $status : '';

    	$length = $request->input('length'); 
    	$length = !empty($length) ? ($length > 50  ? 50 : $length) : 50;

    	$status_list = [
    		"confirmed" => "info",
    		"payment_required" => "warning",
    		"payment_in_process" => "info",
    		"paid" => "success",
    		"cancelled" => "danger"
    	];

    	$order = \Meli::get('/orders/search', [
			'access_token' => session('access_token'),
			'seller' => session('profile')->id,
			'sort' => 'date_' . $orderBy,
			'tags' => $status,
			'limit' => $length
		]);

		if(isset($order['body']->results) && empty($order['body']->results)) {
			$this->_result['data'] = [];
		} else {
			foreach ($order['body']->results as $order) {
				$this->_result['data'][] = [
					'<input type="checkbox" name="id[]" value="'. $order->id .'">',
					$order->id,
					date('Y/m/d H:i', strtotime($order->date_last_updated)),
					$order->buyer->first_name . ' ' . $order->buyer->last_name,
					$order->buyer->first_name . ' ' . $order->buyer->last_name,
					'$' . number_format($order->total_amount, 2),
					'$' . number_format($order->total_amount, 2),
					'<span class="label label-sm label-'.( $status_list[$order->status]).'">'. $order->status .'</span>',
					'<a href="'. url('/meli/admin/order', ['id'=> $order->id]) . '" class="btn btn-sm btn-circle btn-default btn-editable"><i class="fa fa-search"></i> View</a>',
				];
			}
		}
		return response()->json($this->_result);
    }

    public function show($id) {
    	if(!session('profile')) {
			return \Redirect::to('/meli/login');
		}
		
		$order = \Meli::get('orders/' . $id, [
			'access_token' => session('access_token')
		]);
		/*echo '<pre>';
		var_dump($order);die;*/
		
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
			'sort' => 'date_desc',
			'limit' => 50
			]);

		$orderList = [];
		if(isset($orders['body']->results) && !empty($orders['body'])) {
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
