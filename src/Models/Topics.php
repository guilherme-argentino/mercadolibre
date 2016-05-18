<?php

namespace Javiertelioz\MercadoLibre\Models;

use Javiertelioz\MercadoLibre\Models\Topic\Question;
use Javiertelioz\MercadoLibre\Models\Topic\Order;
use Javiertelioz\MercadoLibre\Models\Topic\Item;
//use Javiertelioz\MercadoLibre\Models\Topic\Payment;
use Javiertelioz\MercadoLibre\Models\Notifications;
use Javiertelioz\MercadoLibre\Models\Queue;

class Topics {
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "mercadolibre_topics";
    /**
     * Topic Data (Notifications Post Data)
     */
    protected $topics;
    /**
     * Set Topic and Process
     */
    public function __construct($topics) {
    	$this->topics = $topics;
    	$this->_processTopic();
    }
    /**
     * get Topic Data 
     */
    private function getTopic() {
    	$token = \Meli::getTokenByConsole();
    	
        $topic = \Meli::get($this->topics->resource, [
			'access_token' => $token['access_token'],
		]);
        //var_dump($topic);die;

        if(isset($topic['body']) 
            && isset($topic['httpCode']) 
                && $topic['httpCode'] == 200) {
			     return $topic['body'];
		}

		return false;
    }
    /**
     * Process all Topic's (items, payments, questions, orders)
     */
    private function _processTopic() {

        $notifications = new Notifications();
        $exist = $notifications->where('resource', '=', $this->topics->resource)->count();

        if($exist) {
            return;
        }
        
    	$classModel = ucfirst($this->topics->topic);
    	
        if(isset($this->topics->resource)) {
    		$topic = $this->getTopic();
    		if($topic) {
    			if($classModel == 'Orders'){
    				$topicModel = new Order($topic);
                    $this->topics->process = $topicModel->send();
                    //var_dump($this->topics->process);die;
    			} else if($classModel == 'Questions') {
    				$topicModel = new Question($topic);
                    $this->topics->process = $topicModel->send();
                    if($this->topics->process == null){
                        return;
                    }
    			} else if($classModel == 'Items') {
    				$topicModel = new Item($topic);
                    $this->topics->process = $topicModel->send();
    			} else if($classModel == 'Payments') {
    				$topicModel = new Payment();
                    $this->topics->process = $topicModel->send();	
    			} else {
    				return;
    			}
    		} else {
    			$this->topics->process = false;
    		}
    	} else {
    		$this->topics->process = false;
    	}

        $notifications->saveNotification($this->topics);
    }

    private function _saveTopic() {
    	$topicArray = get_object_vars($this->topics);
    	$this->save($topicArray);
    }
}