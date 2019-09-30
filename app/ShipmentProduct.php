<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentProduct extends Model {
     /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'shipment_product';
    protected $fillable = array('method_id', 'product_id');
     
    public $timestamps = false;
    public function method() {
        return $this->belongsTo('App\Shipment','method_id');
    }
    
  }
