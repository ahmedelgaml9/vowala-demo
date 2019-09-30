<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class  Benefits extends Model {
     /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'benefits';
    protected $fillable = array('name','desc','name_ar','desc_ar','icon');
    public $timestamps = false;
   
  

}
