<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Order;
use App\Weights;
use App\Shipment;
use App\ShipmentPrice;
use App\Code;
use App\Order_details;
use App\Http\Requests\ContactusRequest;
use App\Main;
use App\ProductSize;
use App\Slider;
use App\Category;
use App\Subcat;
use App\ProductColor;
use App\Add;
use App\Block;
use App\Faqs;
use App\Brand;
use App\BlogCat;
use App\Blog;
use Session;
use App\Zone;
use App;
use DB;
use Charts;

use App\Http\Controllers\Controller;

class OrdersController extends Controller {

     public function __construct()
       {
        
        $data= Main::find(1);
        $lang =$data->setlang;
        if ($lang == 1) {

            App::setLocale('en');
        }

        else{

            App::setLocale('ar');
        }
    }

    protected $total_price = 0, $sales_tax = 0, $discount = 0, $payment_price= 0 ,  $shipping_price=0 , $shipping_tax=0;

    public function postcheckout(ContactusRequest $data) {
      //  $product_js = json_decode($data['products'], true);
      //  $products = $product_js['data']; //List Of Products id With Quantity
        
         if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) &&count($_SESSION['cart'])>0) {
             $products=$_SESSION['cart'];
             $this->Total($products);
            $value = $this->Shipment_price($data['shipment_id']);
            if ($value != "no") {
                $this->discount = $this->cal_discount($data['promocode']);
                $model = new Order();
                $data['user_id']=Auth::user()->id;
                $insert = $model->create($data->all());
                if ($insert) {
                    if ($this->Savedetails($insert, $products)) {
                        $insert->total_price = $this->total_price; //Total In Dolars Befor Discount
                        $insert->discount = $this->discount; //Discount %
                        $insert->shipment = $value;
                         if ($this->discount > 0) {
                            $insert->total_discount = $value + $this->total_price - ($this->total_price * ($this->discount / 100));
                        } else {
                            $insert->total_discount = $value + $this->total_price; //
                        }
                        $insert->save();
                        

                        return response()->json(array('status' => 'true', 'message' => "Your Orders Submited Successfully :)"));
                    } else {
                        return response()->json(array('status' => 'false', 'message' => "There Are an Error (fe id mn products 8lt :( )"));
                    }
                   }
                }else{
                     return response()->json(array('status' => 'false', 'message' => "Sorry ! your order Weight can't shiped )"));
               }
             }
                  return response()->json(array('status' => 'false', 'message' => "there are no products)"));
             }
    
         public function CheckOut(Request $request, Order $order)
          {
              $products= $_SESSION['cart'];
              if(empty($products)){
                  return redirect('/');;
              }
              
              $this->Total($products,$request);
              $carts = $_SESSION['cart'];
              $order->name   = $request->input('name');
              $order-> email        = $request->input('email');
              $order-> phone        = $request->input('phone');
              $order-> address      = $request->input('address');
              $order->area  = $request->input('area');
              $order->building_number = $request->input('building_number');
              $order->street_name   = $request->input('street_name');
              $order->floor_number  = $request->input('floor_number');
              $order->flat_number   = $request->input('flat_number');
              $order-> city         = $request->input('city');
              $order-> comments     = $request->input('comments');
              $order-> country      = $request->input('country');
              $order-> user_id      =  Auth::user()->id;
              $order-> shipment_id  = $request->input('shipment_id');
              $order-> total_price  = $this->total_price;
              $order->payment_price = $this->payment_price;
              $order->payment_method =  $request->input('payment_method');
              $order->shipping_price = $this->shipping_price ;
              $order->sales_tax = $this->sales_tax;
              $order->shipping_tax = $this->shipping_tax;

              $order->order_paid = 0;
              $order-> delivery_date = date('Y-m-d', strtotime("+7 days"));
              $order->save();
              if( empty(Auth::user()->phone) ){
                  Auth::user()->update(['phone' => $request->input('phone')]);
              }

              if( empty(Auth::user()->address) ){
                   Auth::user()->update(['address' => $request->input('address')]);
              }

              if($request->payment_method  == 2)
                {
                   $order->order_paid= 1;
                   $order->active_order=0;
                }

          if ($this->Savedetails($order, $products))
            {
             $order->total_price = $this->total_price; 
             $order->discount = $this->discount; 
                        
             $order->shipment = $order-> shipment_id;
             if ($this->discount > 0) 
             {
                $order->total_discount = $order-> shipment_id + $this->total_price - ($this->total_price * ($this->discount / 100));
              } else 
              {
                $order->total_discount = $order-> shipment_id + $this->total_price;
              }

             if($order->save()){
                 \Session::flash('message',trans('lang.successOrder').'-'.date('F d, Y', strtotime($order->created_at))
             );
            
                   return $this->successOrder($order);
             }else{
                   return abort(404);
                 }
             }else
             {
                  return redirect('/')->with('message', 'There Are an Error Try again');
             }
           }

          public function  paymentcheckout(Request $request, Order $order)
            {
              $products= $_SESSION['cart'];

              if(empty($products)){
                   return redirect('/');;
              }
          
              $this->Total($products,$request);
          
              $carts = $_SESSION['cart'];
              $order-> first_name   = $request->input('first_name');
              $order-> email        = $request->input('email');
              $order-> phone        = $request->input('phone');
              $order-> address      = $request->input('address');
              $order->street_name   = $request->input('street_name');
              $order->floor_number  = $request->input('floor_number');
              $order->flat_number   = $request->input('flat_number');
              $order-> city         = $request->input('city');
              $order-> comments     = $request->input('comments');
              $order-> country      = $request->input('country');
              $order-> user_id      =  Auth::user()->id;
              $order-> shipment_id  = $request->input('shipment_id');
              $order-> total_price  = $this->total_price;
              $order->payment_method =  $request->input('payment_method');
              $order->shipping_price = $this->shipping_price ;
              $order->sales_tax = $this->sales_tax;
              $order->order_paid= 0;

              $order-> delivery_date = date('Y-m-d', strtotime("+7 days"));
              $order->save();
              if( empty(Auth::user()->phone) ){
                  Auth::user()->update(['phone' => $request->input('phone')]);
              }
    
              if( empty(Auth::user()->address) ){
                Auth::user()->update(['address' => $request->input('address')]);
              }

              if ($this->Savedetails($order, $products))
                {
                 $order->total_price = $this->total_price;
                 $order->discount = $this->discount; 
                            
                 $order->shipment = $order-> shipment_id;
                 if ($this->discount > 0) 
                 {
                    $order->total_discount = $order-> shipment_id + $this->total_price - ($this->total_price * ($this->discount / 100));
                  } else 
                  {
                    $order->total_discount = $order-> shipment_id + $this->total_price;
                  }

                 if($order->save()){
                     $_SESSION['cart']=null;
                    \Session::flash('message',trans('lang.successOrder').'-'.date('F d, Y', strtotime($order->created_at))
                  );
                       return $this->orderpayment($order);
                       
                 }else{      
                          return abort(404);
                    }
                  }else
                  {
                     return redirect('/')->with('message', 'There Are an Error Try again');
                   }
    
                 }
    
         public function Total( $array, request $request) {
             
                $price = 0;
                $weights = 0;
              foreach ($array as $ob) {
                $main= Main::find(1);
                $shipment = \App\Shipment::where('id',$request->shipment_id)->first();
                $pro = Product::find($ob['productid']);
                if (!empty($pro)) {
                     $weights += $pro['weight'] * $ob['quantity'];
                     
                     $shippment_price = App\ShipmentPrice::select('value','extra')->where('shipment_id',$request->shipment_id)->where('from',$pro->Seller->city)->where('to',$request->city)->first();
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
                        $price += ($pro->price - ($pro->price * ($pro->offer / 100))) * $ob['quantity'];
                    } else {
                            $price += $pro->price * $ob['quantity'];
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
                  }

 
    public function Savedetails($order, $array) {
           foreach ($array as $ob) {
             $pro = Product::find($ob['productid']);
               if (!empty($pro)) {
                    $order_det = new Order_details();
                    $order_det->product_id = $ob['productid'];
                    if(isset($ob['sizename'])){
                    $order_det->size= $ob['sizename'];}
                      if(isset( $ob['colorname'])){
                    $order_det->color = $ob['colorname'];}
                    $order_det->quantity = $ob['quantity'];
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
                        $q->qu --;
                        $q->save(); 

                        }
                       }
                        else{
                            
                        $q= ProductColor::where('product_id',$order_det->product_id)->where('color',$order_det->color)->first();
                        if($q)
                         {

                         $q->qu--;
                         $q->save(); 
                         }
                        }
                          
                           unset($ob);
                       } else {
                       return false;
                   }
                 }
                   return TRUE;
               }

    public  function successOrder($order){
        
        $main = Main::find(1);
        $headercats = Subcat::select(array('id', 'name', 'custom_url', 'photo', 'name_ar'))->where('header', 1)->get()->take(4); //header
        $newcats = Subcat::select(array('id', 'name', 'custom_url', 'photo', 'name_ar'))->where('new', 1)->get()->take(2); //header
        $popular = Product::select('id', 'offer', 'price', 'custom_url', 'custom_url_ar', 'catalog_id', 'status')->where('status', 1)->orderBy('viewers', 'desc')->get()->take(3); //header
        $brands = Brand::all(); 
        $blocks = Block::all();
        Session::put('country',$order->country);
        Session::put('city',$order->city);
        Session::put('total_price',$order->total_price);
        Session::put('order_id',$order->order_id);
        Session::put('salestax',$order->sales_tax);
        Session::put('shipping_tax',$order->shipping_tax);
        Session::put('shipping_price',$order->shipping_price);
        Session::put('payment_price',$order->payment_price);

           return view('buyer.successOrder', compact('main','headercats','newcats', 'popular','brands', 'order', 'blocks', 'cats', 'card'));
    }
    
      public  function orderpayment($order){
        
        $main = Main::find(1);
        $headercats = Subcat::select(array('id', 'name', 'custom_url', 'photo', 'name_ar'))->where('header', 1)->get()->take(4);
        $newcats = Subcat::select(array('id', 'name', 'custom_url', 'photo', 'name_ar'))->where('new', 1)->get()->take(2);
        $popular = Product::select('id', 'offer', 'price', 'custom_url', 'custom_url_ar', 'catalog_id', 'status')->where('status', 1)->orderBy('viewers', 'desc')->get()->take(3); //header
        $blocks = Block::all(); 
       
         return view('site.checkout_purchase', compact('main', 'headercats','newcats', 'popular', 'brands', 'order', 'blocks', 'cats', 'card'));
      }
    
      public function myorder() {
          
        $main = Main::find(1);
        $headercats = Subcat::select(array('id', 'name', 'custom_url', 'photo', 'ar_name', 'photo_alt'))->where('header', 1)->get()->take(4); //header
        $newcats = Subcat::select(array('id', 'name', 'custom_url', 'photo', 'ar_name', 'photo_alt'))->where('new', 1)->get()->take(2); //header
        $popular = Product::select('id', 'offer', 'price', 'custom_url', 'ar_custom_url', 'catalog_id', 'status')->where('status', 1)->orderBy('viewers', 'desc')->get()->take(3); //header
        $brands = Brand::select('id', 'name', 'ar_name', 'photo', 'photo_alt', 'ar_photo_alt', 'custom_url', 'ar_custom_url')->where('home', 1)->get(); //header
        $blocks = Block::all(); //footer
        $new_blogs = Blog::select('id', 'title', 'ar_title', 'photo', 'photo_alt', 'custom_url', 'ar_custom_url')->orderBy('created_at', 'desc')->get()->take('6'); //header
        // featured
        $recent_viewed = Product::select('offer', 'id', 'price', 'custom_url', 'ar_custom_url', 'catalog_id')->where('status', 1)->orderBy('last_view', 'desc')->get()->take(3);
        $recent_products = Product::select('offer', 'id', 'price', 'custom_url', 'ar_custom_url', 'catalog_id')->where('status', 1)->orderBy('created_at', 'desc')->get()->take(3);
        $orders = \App\Order::where('user_id', Auth::user()->id)->get();
        return view('buyer.myorders', compact('main', 'recent_viewed', 'new_blogs', 'recent_products', 'headercats', 'newcats', 'popular', 'brands', 'blocks', 'cats', 'card', 'orders'));
    }

    public  function  editOrder($id){
        $order = \App\Order::find($id);
            if($order->status == null && $order->status == 0){
            $main = Main::find(1);
            $headercats = Subcat::select(array('id', 'name', 'custom_url', 'photo', 'ar_name', 'photo_alt'))->where('header', 1)->get()->take(4); //header
            $newcats = Subcat::select(array('id', 'name', 'custom_url', 'photo', 'ar_name', 'photo_alt'))->where('new', 1)->get()->take(2); //header
            $popular = Product::select('id', 'offer', 'price', 'custom_url', 'ar_custom_url', 'catalog_id', 'status')->where('status', 1)->orderBy('viewers', 'desc')->get()->take(3); //header
            $brands = Brand::all(); //header
            $blocks = Block::all(); //footer
            $shipmethods = \App\Shipment::all();

            if (!empty($order) && $order->user_id == Auth::user()->id) {
                return view('buyer.editOrder', compact('main', 'headercats', 'newcats', 'popular', 'brands', 'order', 'blocks', 'cats', 'card', 'orders', 'shipmethods'));
            } else {
                abort(404);
            }
        }

        \Session::flash('message', 'This  order can\'t  be edit');
        return redirect()->back()->with('failed', 'This  order can\'t  be edit'); 
    }
    
    public  function  updateOrder($id, Request $request){
        $request->except('_token');
        $input =  $request->except('_token');
        
        $update=  Order::where('id', $id)->update($input);
        
        if ($update) {
            \Session::flash('message', 'Update Section Done');
            return redirect()->back()->with('success', 'Update Section Done');
        }else {
            return redirect()->back()->with('failed', 'Update Failed');
        }
    }
    
     public  function  returnorder($id, Request $request){
      
          $update=  Order::where('id', $id)->update(['order_return'=> 1]) ;
         if ($update) {
            \Session::flash('message', 'Update Order Done');
            return redirect()->back()->with('success', 'Update Section Done');
        }else {
            return redirect()->back()->with('failed', 'Update Failed');
        }}
    
        public  function orderschart(){
            
             $orders= Order::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
    				->get();
              $chart = Charts::database($orders, 'bar', 'highcharts')
			      ->title("Monthly Orders")
			      ->elementLabel("Total Users")
			      ->dimensions(1000, 500)
			      ->responsive(false)
			      ->groupByMonth(date('Y'), true);
             return view('admin.counters', compact('chart'));
        }}
