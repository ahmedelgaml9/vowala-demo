<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $fillable = array('name', 'ar_name', 'title', 'ar_title', 'custom_url', 'ar_custom_url', 'meta_title', 
        'ar_meta_title', 'meta_keyword', 'ar_meta_keyword', 'photo_alt', 'ar_photo_alt', 'photo', 'meta_description', 'ar_meta_description', 'section_id');
    public $timestamps = false;
    protected $attributes = array(
        'photo' => 'default.png'
    );
     public function section() {
        return $this->belongsTo('App\Section', 'section_id');
    }

    public function subcats() {
        return $this->hasMany('App\Subcat', 'cat_id');
    }

    public function setPhotoAttribute($photo) {
        if ($photo) {
            $dest = 'admin-assets/images/cats/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }

}
