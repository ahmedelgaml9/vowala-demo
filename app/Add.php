<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Add extends Model
{

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'adds';
    protected $fillable = array('title','title_ar','photo','photo_alt','photo_alt_ar','link');
    public $timestamps = false;
    public function setPhotoAttribute($photo)
    {
        if ($photo) {
            $dest = 'admin-assets/images/adds/';
            $name = str_random(6) . '_' . $photo->getClientOriginalName();
            $photo->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }
}
