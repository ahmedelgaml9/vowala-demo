<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    protected $table = 'items';
    protected $fillable = array('length', 'width', 'height', 'weight', 'cover', 'price', 'quantity');
    public $timestamps = false;

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }

}
