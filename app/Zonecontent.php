<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zonecontent extends Model {

    protected $table = 'zone_content';
    protected $fillable = array('zone_id', 'country_id');
    public $timestamps = false;

    public function country() {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function zone() {
        return $this->belongsTo('App\Zone', 'zone_id');
    }
}
