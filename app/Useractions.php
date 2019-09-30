<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class  Useractions extends Model {
    protected $table='userschanges';
    protected $fillable= array('user_id','order_id','date','status');
    public $timestamps = false;

}
