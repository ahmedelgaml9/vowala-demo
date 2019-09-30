<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    
    protected $table = 'countries';
    protected $fillable = array('name','name_ar', 'continent_id','photo','active');

    public function Cont() {
        return $this->belongsTo('App\Continent', 'continent_id');
    }
    
    public $timestamps = false;
    
    
   public function setPhotoAttribute($photo) {
        if ($photo) {
            $dest = 'admin-assets/images/countries/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }
    
}
