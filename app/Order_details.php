<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_details extends Model {

    protected $table = "order_product";

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function order() {
        return $this->belongsTo('App\Order','order_id');
    }

    public $timestamps = false;

}
