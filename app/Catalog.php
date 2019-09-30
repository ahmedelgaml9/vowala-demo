<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog';
    protected $fillable = array(  
    'photo','meta_description', 'meta_description_ar', 
    'meta_keyword', 'meta_keyword_ar', 'name', 'name_ar', 'meta_title', 'meta_title_ar','cat_id',
      'model', 'sku','weight', 'brand_id','desc','desc_ar','photo_alt','photo_alt_ar','tax','active','return_policy','return_policy_ar','active');

      public $timestamps =true;

    public function cat()
    {
        return $this->belongsTo('App\Subcat', 'cat_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'catalog_id');
    }

    public function Specs()
    {
        return $this->hasMany('App\Specific', 'catalog_id');
    }

    public function photoes()
    {
        return $this->hasMany('App\ProductGalary', 'catalog_id');
    }
    
    public function setPhotoAttribute($photo)
    {
        if ($photo) {
            $dest = 'admin-assets/images/products/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }
}
