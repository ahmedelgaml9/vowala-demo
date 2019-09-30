<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model {

    protected $table = 'colors';
    protected $fillable = array('color','product_id');
    public $timestamps = false;

}
