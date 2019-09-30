<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipmentzone extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'shipment_zone';
    protected $fillable = array('shipment_id', 'zone_id');
    public $timestamps = false;

    
    public function zone() {
        return $this->belongsTo('App\Zone','zone_id');
    }
   

}
