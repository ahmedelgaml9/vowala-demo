<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Auth ;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name', 'l_name', 'email', 'password', 'photo', 'country', 'city', 'address', 'phone', 'permission','f_name','status', 'provider','provider_id','active'
        ];
    protected $attributes = array(
            'photo' => 'profile-image.png'
        );
    
    public function setPhotoAttribute($image)
    {
        if ($image) {
            $dest = 'admin-assets/images/users/';
            $name = str_random(6) . '_' . $image->getClientOriginalName();
            $image->move($dest, $name);
            $this->attributes['photo'] = $name;
        }
    }
    
       public function setPasswordAttribute($date) {
        if (isset($date) && !empty($date)) {
            $this->attributes['password'] = bcrypt($date);
        }
    }  
    
    public function wishlist()
    {
        if (Auth::check()) {
            $list = Wlist::where('user_id', '=', Auth::user()->id)->get();
        } else {
            $list = null;
        }
        return $list;
    }
    
    public function iswashed($product_id)
    {
        $list = $this->wishlist();
        if (count($list) > 0) {
            foreach ($list as $w) {
                if ($w->product_id == $product_id) {
                    return true;
                }
            }
        } else {
            return false;
        }
    }
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            'password', 'remember_token',
        ];
}
