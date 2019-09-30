<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryGalary extends Model {

    protected $table = 'category_gallary';
    protected $fillable = array('photo','category_id');
    public $timestamps = false;
 
}
