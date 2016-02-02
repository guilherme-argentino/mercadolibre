<?php

namespace Javiertelioz\MercadoLibre\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model {
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "mercadolibre_notifications";
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function saveNotification($notitication) {
        $resource = explode('/', $notitication->resource);

        $flag = Notifications::where('resource_id', $resource[2])->first();
        
        if(isset($flag->id)) {
            $notification = Notifications::find($flag->id);
            $notification->attempts = $notification->attempts + 1;
            $notification->save();
        } else {
            $this->resource = $notitication->resource;
            $this->resource_id = $resource[2];
            $this->type = $resource[1];
            $this->user_id = $notitication->user_id;
            $this->application_id = $notitication->application_id;
            $this->attempts = $notitication->attempts;
            $this->status = (int) $notitication->process;
            $this->sent = date('Y-m-d H:i:s', strtotime($notitication->sent));
            $this->received = date('Y-m-d H:i:s', strtotime($notitication->received));
            $this->save();
        }


    }
}