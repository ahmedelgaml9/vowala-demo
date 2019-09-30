<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weights extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'weights';
    protected $fillable = array('from', 'to', 'value', 'method_id');
    public $timestamps = false;

   

}
