<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'blog';
    protected $fillable = array('title', 'title_ar', 'custom_url', 'custom_url_ar','photo', 'photo_alt', 'photo_alt_ar', 'desc', 'desc_ar', 'blog', 'blog_ar',
      'photo','active','cat_id');

    public function cat() {
        return $this->belongsTo('App\BlogCat', 'cat_id');
    }
    
    
   public function photoes()
    {
         return $this->hasMany('App\BlogGalary', 'blog_id');
    }

    public function setPhotoAttribute($photo) {
        if ($photo) {
            $dest = 'admin-assets/images/blogs/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }

}
