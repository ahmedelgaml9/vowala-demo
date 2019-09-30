<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = "orders";
    protected $fillable = array('user_id', 'shipment_id',
                                'first_name', 'email', 'phone', 'address',
                                'comments','phone','line1',
                                'city','statead','country_code',
                                'total_price', 'status', 'delivery_date',
                                'payment_id', 'last_name', 'code', 'promocode',
                                'currency','total_discount','shipment','discount','street_name','floor_number','flat_number','payment_price','shipping_price');

    public function products() {
        return $this->hasMany('App\Order_details');
    }


    public function customer() {

        return $this->belongsTo('App\Customer');
    }

    public function user() {

        return $this->belongsTo('App\User', 'user_id');
    }

    public function shipmentmethod() {

        return $this->belongsTo('App\Shipment','shipment_id');
    }

   
    public function  paymentmethod() {

         return $this->belongsTo('App\Payment','payment_method');
    }
    
    
    public function getstatus() {

        if($this->status == 0 )
        {
            return trans('lang.pending');
        }
        else if($this->status == 1 )
        {
            return trans('lang.confirmed');
        }
         else if($this->status == 2 )
        {
            return trans('lang.shiped');
        }
         else if($this->status == 3 )
        {
            return trans('lang.delivered');
        }
        else if($this->status == 4 )
        {
            return trans('lang.cancelled');
        }
        else
        {
            return "";
        }
        
    }



}
