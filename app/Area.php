<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Zonecontent;

class Area extends Model {
     /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'areas';
    protected $fillable = array('name','name_ar','zone_id');
    public $timestamps = false;

    public function Zone() {
        return $this->belongTo('App\Zone', 'zone_id');
    }

}
