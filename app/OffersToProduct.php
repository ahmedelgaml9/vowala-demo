<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OffersToProduct extends Model
{
    protected $tabl=['offers_to_products'];
    protected $fillable=array('product_id','offer_id');
}
