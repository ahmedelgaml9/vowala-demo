<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Order;
use App\Weights;
use App\Shipment;
use App\ShipmentPrice;
use App\Code;
use App\Order_details;
use App\Main;
use App\Slider;
use App\Category;
use App\Subcat;
use App\Add;
use App\Block;
use App\Faqs;
use App\Brand;
use App\BlogCat;
use App\Blog;
use Session;
use App\Zone;
use Validator;
use App\ProductSize;
use App\ProductColor;
use App\Http\Controllers\Controller;

class OrdersController extends Controller {

           protected $total_price = 0, $sales_tax = 0, $discount = 0, $payment_price =0  , $shipping_price=0 , $shipping_tax = 0 ; 
            public function order(Request  $request){
       
          $price = 0 ;
          $weights = 0;
          $product_js = $request['products'];
          $products = $product_js; 
    
           if (isset($request['products']) && is_array($products))    {
               
            foreach ($products as $ob) {
            $pro = Product::find($ob);
            if (empty($pro)) {
               return response()->json(array('status' => 'false', 'message' =>"this products not found"));
            }
              else{
            
                   $validator = Validator::make($request->all(), [
                  
                    'user_id' => 'required',
                    'shipment_id' => 'required',
                    'payment_method' => 'required',
                    'address_id'=>'required',
                     
                    ]);
             
                if (!$validator->passes()) {
                      $messages = $validator->errors();
                          return response()->json(array('status' => 'false', 'message' => $messages->all()));
                }
               
              foreach ($products as $ob) {
                $main= Main::find(1);
                $shipment = Shipment::where('id', $request->shipment_id)->first();
                $pro = Product::find($ob);
                 $x= settype($products['qu'],"integer"); 

                if (!empty($pro)) {
                     $weights += $pro->weight * $x;
                     $shippment_price = ShipmentPrice::select('value','extra')->where('shipment_id',$request->shipment_id)->where('from',$pro->Seller->city)->where('to',$request->city)->first();
                     if(count($shippment_price ) < 1 )
                     {
                         $shipping_price = 0; 
                     }
                     
                     else{
                         
                      $shippingvalue = round(( $weights - 1)) * $shippment_price->extra;
                      $t = $shippingvalue + (1 * $shippment_price->value);
                      $this->shipping_price += $t;
                      $this->shipping_price += ($shipment->shipping_tax /100 * $this->shipping_price );
                      $this->shipping_tax = $shipment->shipping_tax; 
                     }
                    if ($pro->offer > 0) {
                        $price += ($pro->price - ($pro->price * ($pro->offer / 100)))* $x;
                    } else {
                            $price += $pro->price *  $x;
                            $price += ($main->sales_tax /100 * $price  );
                            $this->sales_tax=$main->sales_tax /100 * $price ;
                    }
                }
             }
            
                if($request->payment_method)
                   {
                
                    $paymentprice = \App\Payment::where('id',$request->payment_method)->first();
                    $this->payment_price= $paymentprice->value;
                    
                   }
                     $this->total_price = $price +  $this->shipping_price + $this->payment_price ;
                  
                    if($request->address_id){
                        
                       $addressdata =\App\Shipmentaddress::find($request->address_id);  
                        $street_name  = $addressdata->street_name;
                        $floor_number =  $addressdata->floor_number;
                        $flat_number  =  $addressdata->flat_num;
                        $city  =  $addressdata->city;
                        $country =  $addressdata->country;
                        $address = $addressdata->address;
                    }
                 
                        if($request->user_id){
                        
                       $addressdata  =\App\User::find($request->user_id);  
                        $name =  $addressdata->name;
                        $phone =  $addressdata->phone;
                        $email = $addressdata->email ;
                        }
                 
              $order = new Order();
              $order->name   =$name;
              $order-> email   = $email;      
              $order-> phone      = $phone;
              $order-> address      = $address ;
              $order->street_name  =  $street_name  ;
              $order->floor_number  = $floor_number ;
              $order->flat_number   = $flat_number ;
              $order-> city        =  $city ;
              $order-> country     =   $country  ;
              $order-> user_id   =  $request->input('user_id');
              $order-> shipment_id  = $request->input('shipment_id');
              $order-> total_price  = $this->total_price;
              $order->payment_price = $this->payment_price;
              $order->payment_method =  $request->input('payment_method');
              $order->shipping_price = $this->shipping_price ;
              $order->sales_tax = $this->sales_tax;
              $order->shipping_tax = $this->shipping_tax;
              $order->status = 0;
              $order->order_paid = 1;
              $order-> delivery_date = date('Y-m-d', strtotime("+7 days"));
              $order->save();
                if ($order) {
                 if ($this->Savedetails($order, $products)) {
                           $order->total_price = $this->total_price; 
                           $order->save();
                          return response()->json(array('status' => 'true', 'message' => "Your Orders Submited Successfully :)"));
                 }
                      else {
                      return response()->json(array('status' => 'false', 'message' => "There Are an Error (fe id mn products 8lt :( )"));
                    }
                }
                else {
                       return response()->json(array('status' => 'false', 'message' => "Sorry ! your order Weight can't shiped )"));
               }
           }
        
            } 
        }
        
        return response()->json(array('status' => 'false', 'message' => "there are no products)"));
    }
    


       public function Savedetails($order, $array) {
      
             foreach ($array as $b){
           
               $pro = Product::find($b);
            if (!empty($pro)) {
                    $order_det = new Order_details();
                    $order_det->product_id =$b;
                    if(isset($array['sizename'])){
                    $order_det->size= $array['sizename'];
                       }
                      if(isset( $array['colorname'])){
                    $order_det->color = $array['colorname'];}
                    $order_det->quantity =$array['qu'] ;
                  if ($pro->offer > 0) {
                     $order_det->price = ($pro->price - ($pro->price * ($pro->offer / 100)));
                    } else {
                     $order_det->price = $pro->price;
                    }
                       $order_det->order_id = $order->id;
                       $order_det->save();
                       if($pro->Quantity()>0){
                       $q= ProductSize::where('product_id',$order_det->product_id)->where('size',$order_det->size)->first();
                        if($q){
                        $q->qu-$array['qu'] ;
                        $q->save(); 

                        }
                       }
                        else{
                            
                        $q= ProductColor::where('product_id',$order_det->product_id)->where('color',$order_det->color)->first();
                        if($q)
                         {

                         $q->qu-$array['qu'] ;
                         $q->save(); 
                         }
                        }
                          
                        
                       } else {
                       return   'yqwyqyyqw';
                   }
                 }
            
          
       }
       
}    
               
               
               
