<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

  
    protected $table = 'products';
    protected $fillable = array('price', 'status','cat_id', 'user_id',
        'custom_url', 'custom_url_ar', 'meta_description', 'meta_description_ar', 'price', 'duration',
        'meta_keyword', 'meta_keyword_ar', 'name','name_ar','desc' ,'desc_ar','meta_title', 'meta_title_ar', 'catalog_id',
        'block_id', 'offer', 'model', 'sku','weight', 'brand_id','quantity','type','short_description','short_description_ar','return_policy','return_policy_ar','active');
        public $timestamps = false;

        public function catalog() {
            
          return $this->belongsTo('App\Catalog', 'catalog_id');}
          
          public function  relatedproduct(){
              
            return $this->hasMany('App\Related','product_id');
            
          }
        
           
    public function brand() {
         return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function cat() {
        return $this->belongsTo('App\Subcat', 'cat_id');
    }
       public function Seller() {
           return $this->belongsTo('App\User', 'user_id');
       }

     public function Sizes() {
        return $this->hasMany('App\ProductSize', 'product_id');
    }

  public function colors() {
        return $this->hasMany('App\ProductColor', 'product_id');
    }

    public function rate() {
        return $this->hasMany('App\Rate', 'product_id')->avg('value');
    }

    public function ratecount() {
        return $this->hasMany('App\Rate', 'product_id')->count();
    }
    
    
     public function Quantity() {

        $sum = $this->hasMany('App\ProductSize', 'product_id')->sum('qu');
        if (empty($sum)) {
            return 0;
        } else {
            return $sum;
        }
    }
   
   
   
    public function  colorQuantity(){

        $sum = $this->hasMany('App\ProductColor', 'product_id')->sum('qu');
        if (empty($sum)) {
            return 0;
        } else {
            return $sum;
        }
    }
    
   
}
