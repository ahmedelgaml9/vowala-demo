<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specific extends Model
{

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'specfications';
    protected $fillable = array('spec', 'spec_ar', 'value', 'value_ar', 'product_id');
    public $timestamps = false;
}
