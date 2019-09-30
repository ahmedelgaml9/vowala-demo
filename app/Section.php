<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

   
    protected $table = 'sections';
    protected $fillable = array('name','name_ar','custom_url','custom_url_ar','photo_alt','photo_alt_ar', 'photo','active','meta_description', 'meta_description_ar',
        'meta_keyword', 'meta_keyword_ar', 'meta_title', 'meta_title_ar', );
    public $timestamps = false;
   
    public function cats()
    {
        return $this->hasMany('App\Subcat', 'section_id')->where('active','=', '1')->orderby('id')->take(3);
    }
    public function setPhotoAttribute($photo)
    {
        if ($photo) {
            $dest = 'admin-assets/images/sections/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }
}
