<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {
    protected $table = 'zone';
    protected $fillable = array('name','name_ar','country_id');
    public $timestamps = false;

}
