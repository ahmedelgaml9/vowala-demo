<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Seller extends  Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name', 'l_name', 'email', 'photo', 'country', 'city', 'address', 'phone','birthdate','gender','status'
    ];
   
}
