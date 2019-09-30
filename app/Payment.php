<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class  Payment extends Model {

   
    protected $table = 'payments';
    protected $fillable = array('name','value','photo','active','name_ar');
    public $timestamps= false;
      
    public function setPhotoAttribute($image)
    {
        if ($image) {
            $dest = 'admin-assets/images/payments/';
            $name = str_random(6) . '_' . $image->getClientOriginalName();
            $image->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }
      
}
