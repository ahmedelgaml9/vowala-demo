<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class  Related extends Model {

    protected $table = 'relatedproduct';
    public $timestamps = false;
      public function Relatedphoto() {
            
          return $this->belongsTo('App\Catalog', 'catalog_id');}
}
