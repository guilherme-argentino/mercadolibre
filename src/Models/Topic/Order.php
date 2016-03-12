<?php

namespace Javiertelioz\MercadoLibre\Models\Topic;

use Illuminate\Database\Eloquent\Model;
use Javiertelioz\MercadoLibre\Models\Topic\Topic;

class Order extends Model implements Topic {
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "mercadolibre_orders";
	/**
	 * Source Data
	 */
	protected $source = null;
	/**
	 * Order Data
	 */
	protected $order;

	protected $products = [];
	protected $payment = [];

	public function __construct($order) {
		$this->source = $order;
		$this->get();
	}

	public function send() {
		// Send Order in Magento
		$emilia = \Emilia::call("meli_order.create", [
			'order' => $this->order
		]);
		var_dump($emilia);die;
		return $emilia;
	}

	public function get() {
		
		$_firstname = isset($this->source->buyer->first_name) ? trim($this->source->buyer->first_name)  : 'First Name';
		$_lastname = isset($this->source->buyer->last_name) ?trim($this->source->buyer->last_name): 'Last Name';
		$_email = isset($this->source->buyer->email) ? strtolower(trim($this->source->buyer->email)) : 'customer@mercadolibre.com.mx';
		$_phone = isset($this->source->buyer->phone->number) ? $this->source->buyer->phone->number : '55-55-55-55';
		$_fax = !empty($this->source->buyer->alternative_phone->number) ? $this->source->buyer->alternative_phone->number : '';
		
		// set Ordes Status
		$this->order['status'] = $this->source->status;
		//Set Customer
		$this->order['customer'] = [
			'firstname' => $_firstname,
			'lastname' => $_lastname,
			'email' => $_email,
			'website_id' => 1,
			'group_id' => 1,
			'store_id' => 1,
			'mode' => 'guess', //'guess',
			'taxvat' => ''
		];
		// Set Items 
		foreach ($this->source->order_items as  $item) {
			$this->products[] = [
				'sku' => $item->item->id,
				'custom_sku' => $item->item->seller_custom_field,
				'name' => $item->item->title,
				'option' => $item->item->variation_id,
				'quantity' => $item->quantity,
				'price' => $item->unit_price,
			];
		}
		$this->order['products'] = $this->products;
		// Set Shipping Address
		$this->order['address']['shipping'] = [
			'mode' => 'shipping',
			'firstname' => $_firstname,
			'lastname' => $_lastname,
			'company' => '',
			'street' => !empty($this->source->shipping->receiver_address->street_name) ?  trim($this->source->shipping->receiver_address->street_name) : '',
			'city' => !empty($this->source->shipping->receiver_address->city->name) ? $this->source->shipping->receiver_address->city->name : '',
			'region' => !empty($this->source->shipping->receiver_address->state->name) ? $this->source->shipping->receiver_address->state->name : '',
			'postcode' => !empty($this->source->shipping->receiver_address->zip_code) ? $this->source->shipping->receiver_address->zip_code : '',
			'colony' => !empty($this->source->shipping->receiver_address->neighborhood->name) ? $this->source->shipping->receiver_address->neighborhood->name : '',
			'municipality' => !empty($this->source->shipping->receiver_address->municipality->name) ? $this->source->shipping->receiver_address->municipality->name : '',
			'country_id' => !empty($this->source->shipping->receiver_address->country->id) ? $this->source->shipping->receiver_address->country->id : 'MX',
			'telephone' => !empty($_phone) ? $_phone : '',
			'fax' => !empty($_fax) ? $_fax : '',
			'street_number' => !empty($this->source->shipping->receiver_address->street_number) ? $this->source->shipping->receiver_address->street_number : '',
			//'inside_number' => !empty(var) ? : '',
			'referencias' => !empty($this->source->shipping->receiver_address->comment) ? $this->source->shipping->receiver_address->comment : '',
			'is_default_shipping' => 0,
			'is_default_billing' => 0,
		];
		// Set Payment
		if(!empty($this->source->payments)) {
			foreach ($this->source->payments as $payment) {
				$this->payment = [
					'id' => $payment->id,
					'payer_id' => $payment->payer_id,
					'reason' => $payment->reason,
					'site_id' => $payment->site_id,
					'payment_method_id' => $payment->payment_method_id,
					'installments' => $payment->installments,
					'currency_id' => $payment->currency_id,
					'activation_uri' => $payment->activation_uri,
					'operation_type' => $payment->operation_type,
					'payment_type' => $payment->payment_type,
					'transaction_amount' => $payment->transaction_amount,
					'status' => $payment->status,
					'status_detail' => $payment->status_detail,
					'shipping_cost' => $payment->shipping_cost,
					'total_paid_amount' => $payment->total_paid_amount,
					'overpaid_amount' => $payment->overpaid_amount,
					'installment_amount' => $payment->installment_amount,
					'deferred_period' => $payment->deferred_period,
					'date_approved' => $payment->date_approved,
					'authorization_code' => $payment->authorization_code,
					'transaction_order_id' => $payment->transaction_order_id,
				];
			}
		}
		$this->order['payments'] = $this->payment;
		// Set Cupon
		$this->order['coupon'] = [
			'id' => $this->source->coupon->id,
			'amount' => $this->source->coupon->id
		];
		// Set Shipping Method Magento
		$this->order['shipping_method'] = 'petsymarketplace_mercadolibre';
		// Set Payment Method Magento
		$this->order['payment_method'] = 'petsy_marketplace_mercadolibre';
		// Set Totals
		$this->order['total_amount'] = $this->source->total_amount;
		$this->order['total_amount_with_shipping'] = $this->source->total_amount_with_shipping;
		$this->order['paid_amount'] = $this->source->paid_amount;
	}
}
