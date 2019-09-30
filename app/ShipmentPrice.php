<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentPrice extends Model
{
    protected $table = 'shipment_price';
    protected $fillable = array('from', 'to', 'value','extra','shipment_id');
    public $timestamps = false;

    public function  fromzone(){
        return $this->belongsTo('App\Zone', 'from');        
    }

    public function  tozone(){
        return $this->belongsTo('App\Zone', 'to');        
    }

   
  public function   shipment(){
        return $this->belongsTo('App\Shipment', 'shipment_id');        
    }
 
}