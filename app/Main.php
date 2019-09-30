<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Main extends Model {
    protected $table = 'main';
    public $timestamps = false;
    protected $fillable = array('title', 'title_ar', 'aboutusphoto', 'logo', 'photo_alt', 'ar_photo_alt', 'phone', 'email', 'fb', 'tw', 'gp', 'be', 'linkedin', 'sky', 'apple', 'whatsapp', 'background', 'meta_title','meta_title_ar',
        'tw', 'vision','vision_ar', 'mission','mission_ar','return_policy','return_policy_ar' ,'address', 'address_ar', 'aboutus', 'aboutus_ar', 'meta_description', 'meta_description_ar', 'meta_auther', 'meta_keyword', 'meta_keyword_ar','map','mobile','categoryphoto','chosetemplate','productsphoto','working_hours','working_hours2','page_title','page_title_ar','home_title','home_link','homebanner','home_title_ar','welcome','welcome_ar','favicon','iconsfooter','default_currency','sales_tax','welcome_ar');

    public function setLogoAttribute($image) {
        if ($image) {
            $dest = 'adminstyle/assets/images/gallery/';
            $name = str_random(6) . '_' . $image->getClientOriginalName();
            $image->move($dest, $name);
            $this->attributes['logo'] = $name;
        }
    }

    public function setAboutusphotoAttribute($image) {
        if ($image) {
            $dest = 'adminstyle/assets/images/gallery/';
            $name = str_random(6) . '_' . $image->getClientOriginalName();
            $image->move($dest, $name);
            $this->attributes['aboutusphoto'] = $name;
        }
    }
    public function setCategoryphotoAttribute($image) {
        if ($image) {
            $dest = 'adminstyle/assets/images/gallery/';
            $name = str_random(6) . '_' . $image->getClientOriginalName();
            $image->move($dest, $name);
            $this->attributes['categoryphoto'] = $name;
        }
    }

    public function setProductsphotoAttribute($image) {
        if ($image) {
            $dest = 'adminstyle/assets/images/gallery/';
            $name = str_random(6) . '_' . $image->getClientOriginalName();
            $image->move($dest, $name);
            $this->attributes['productsphoto'] = $name;
        }
    }
    
    public function setFaviconAttribute($image) {
        if ($image) {
            $dest = 'adminstyle/assets/images/gallery/';
            $name = str_random(6) . '_' . $image->getClientOriginalName();
            $image->move($dest, $name);
            $this->attributes['favicon'] = $name;
        }
    }
    
     public function setIconsfooterAttribute($image) {
        if ($image) {
            $dest = 'adminstyle/assets/images/gallery/';
            $name = str_random(6) . '_' . $image->getClientOriginalName();
            $image->move($dest, $name);
            $this->attributes['iconsfooter'] = $name;
        }
    }
    
    public function setHomebannerAttribute($image) {
        if ($image) {
            $dest = 'adminstyle/assets/images/gallery/';
            $name = str_random(6) . '_' . $image->getClientOriginalName();
            $image->move($dest, $name);
            $this->attributes['homebanner'] = $name;
        }
    }
     
    
}
