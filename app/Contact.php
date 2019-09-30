<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'contact';
    protected $fillable = array('name','email','subject','message','seen');
    public $timestamps = false;


}