<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
  class Galary extends Model 
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'company_galary';
    protected $fillable = array('photo');
        public $timestamps = false;

    /**
     * [setImageAttribute]
     * @return [uplode and create or update one image to service] [to user]
     */
    public function setPhotoAttribute($photo) {
        if ($photo) {
            $dest = 'adminstyle/assets/images/gallery/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }

 }
