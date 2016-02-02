<?php
namespace Javiertelioz\MercadoLibre\Models\Topic;

use Illuminate\Database\Eloquent\Model;
use Javiertelioz\MercadoLibre\Models\Topic\Topic;

class Question extends Model implements Topic {

	/**
     * The database table used by the model.
     *
     * @var string
     */    
    protected $table = "mercadolibre_questions";
    /**
     * Source Data
     */
	protected $source = null;
	/**
	 * Question Data
	 */
	protected $question;

    public function __construct($question) {
    	$this->source = $question;
    	$this->get();
    }
    
    /**
     * Send To Magento (Emilia)
     */
    public function send() {
    	return true;
	}

	public function get() {
		// Set Question
		$this->question['id'] =  $this->source->id;
		$this->question['seller_id'] = $this->source->seller_id;
		$this->question['item_id'] = $this->source->item_id;
		$this->question['text'] = $this->source->text;
		/**
		 * Status List
		 *	UNANSWERED Question is not answered yet
         *	ANSWERED Question was answered.
         *	CLOSED_UNANSWERED The item is closed and the question was never answered.
         *	UNDER_REVIEW The item is under review and the question too.
		 */
		$this->question['status'] = $this->source->status;
		$this->question['from'] = $this->source->from->id;
		$this->question['hold'] = $this->source->hold;
		$this->question['create_at'] = $this->source->date_created;
		$this->question['answer'] = [];
		
		//Set Answer
		if(isset($this->source->answer) && !empty($this->source->answer)) {
			$this->question['answer'] = [
				'text' => $this->source->answer->text,
				'date_created' => $this->source->answer->date_created,
				'status' => $this->source->answer->status,
			];
		}
	}
}