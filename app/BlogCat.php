<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCat extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
     protected $table = 'blogcats';
     protected $fillable = array('name', 'name_ar');
     public  $timestamps = false;
     public function blogs() {
        return $this->hasMany('App\Blog','cat_id');
    
     }
  
}
