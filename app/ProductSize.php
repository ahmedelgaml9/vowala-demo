<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sizes';
    protected $fillable = array('size','product_id');
    public $timestamps = false;

}
