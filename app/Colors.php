<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class   Colors  extends Model {

    
    protected $table= 'productcolor';

    protected $fillable =array('color');
    public $timestamps = false;

    
   

}
