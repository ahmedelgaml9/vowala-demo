<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'brands';
    protected $fillable = array('name','name_ar','title','title_ar','custom_url','custom_url_ar','meta_title','home',
        'meta_title_ar','meta_keyword','meta_keyword_ar','photo_alt','photo_alt_ar', 'photo','meta_description','meta_description_ar','active');
    public $timestamps = false;
    protected $attributes = array(
        'photo' => 'default.png'
    );
     public function new_producst() {
        return $this->hasMany('App\Product', 'brand_id')->select('name','ar_name','id','custom_url','ar_custom_url')->get()->take(12);
    }

    public function product() {
        return $this->hasMany('App\Product', 'brand_id');
    }
    
    public function setPhotoAttribute($photo) {
        if ($photo) {
            $dest = 'admin-assets/images/brands/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }

}