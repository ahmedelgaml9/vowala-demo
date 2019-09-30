<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGalary extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_galary';
    protected $fillable = array('photo','catalog_id','photo_alt');
    public $timestamps = false;
 

}
