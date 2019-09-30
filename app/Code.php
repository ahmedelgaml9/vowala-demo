<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
    protected $table = 'codes';
    protected $fillable = array('code', 'discount', 'status', 'expir','price','created_at', 'updated_at');

}
