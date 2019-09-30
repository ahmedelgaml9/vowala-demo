<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {
 
    protected $table = 'slider';
    protected $fillable = array('photo', 'name','name_ar','status', 'title','title_ar', 'link','button_title_ar','button_title','active');
        public $timestamps = false;
    public function setPhotoAttribute($photo) {
        if ($photo) {
            $dest = 'admin-assets/images/slider/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }

}
