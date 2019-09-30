<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class   Sizes  extends Model {

    
    protected $table= 'productsizes';
    protected $fillable =array('size');
    public $timestamps = false;

    
   

}
