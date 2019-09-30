<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcat extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'subcat';
    protected $fillable = array('name', 'icon', 'name_ar', 'title', 'title_ar', 'custom_url', 'custom_url_ar', 'meta_title', 'home', 'new', 'header',
        'meta_title_ar', 'meta_keyword', 'meta_keyword_ar', 'photo_alt', 'ar_photo_alt', 'photo', 'meta_description','meta_description_ar', 'cat_id','active','section_id');
    public $timestamps = false;
   
    public function cat() {
        return $this->belongsTo('App\Subcat', 'cat_id');
    }


    public function photoes() {
       
        return $this->hasMany('App\CategoryGalary','category_id');
    }

    public function childrens() {
        return $this->hasMany('App\Subcat', 'cat_id');
    }

    public function header_children() {
        return $this->hasMany('App\Subcat', 'cat_id')->select('name', 'ar_name', 'id', 'custom_url', 'ar_custom_url')->get()->take(6);
    }

    public function products() {
       
        return $this->hasMany('App\Product','cat_id');
    }

    public function setPhotoAttribute($photo) {
        if ($photo) {
            $dest = 'admin-assets/images/subcats/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }

     public function setIconAttribute($photo) {
        if ($photo) {
            $dest = 'admin-assets/images/subcats/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['icon'] = $name;
        }
    }

}
