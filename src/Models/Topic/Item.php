<?php
namespace Javiertelioz\MercadoLibre\Models\Topic;

use Illuminate\Database\Eloquent\Model;
use Javiertelioz\MercadoLibre\Models\Topic\Topic;

class Item extends Model implements Topic {

	/**
     * The database table used by the model.
     *
     * @var string
     */    
    protected $table = "mercadolibre_items";
    /**
     * Source Data
     */
	protected $source = null;
	/**
	 * Question Data
	 */
	protected $item;

    public function __construct($item) {
    	$this->source = $item;
    	$this->get();
    }

    public function send() {

	}

	public function get() {
		var_dump($this->source);
	}
}