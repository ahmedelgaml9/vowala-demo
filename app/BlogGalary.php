<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogGalary extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blogs_gallary';
    protected $fillable = array('photo','blog_id');
    public $timestamps = false;
 

}
