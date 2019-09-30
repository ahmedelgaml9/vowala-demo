<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Rate;
use App\User;
use App\Subscribe;
use App\Product;
use App\Wlist;
use App\Message;
use App;
use App\Order;
use App\Main;
use App\Order_details; 
use App\Http\Controllers\Controller;



class AjaxController extends Controller {

    public function __construct() {
        $data= Main::find(1);
        $lang =$data->setlang;
        if ($lang == 1) {

            App::setLocale('en');
        }

        else{

            App::setLocale('ar');
        }
    }

    public function postcontactus(Request $data) {
        //  dd($data->all());
           $validator = Validator::make($data->all(), ['name' => 'required|max:255',
                    'email' => 'required|email',
                    'message' => 'required|min:3']
        );
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        } else {
            $message = new Contact();
            $message->name = $data['name'];
            $message->email = $data['email'];
            $message->message = $data['message'];
            $message->save();
            Session::flash('done', 'Sucess!');
            return Redirect::back();
        }
    }

    public function addreview(Request $data) {
        if (Auth::check()) {
            $old = Rate::where('product_id', $data['product_id'])->where('user_id', Auth::user()->id)->get()->first();
            try {
                if (empty($old)) {
                    $review = new Rate();
                    $review->value = $data['rate'];
                    $review->product_id = $data['product_id'];
                    $review->user_id = Auth::user()->id;
                    $review->save();
                } else {
                    $old->value = $data['rate'];
                    $old->save();
                }
                return 'success';
            } catch (Exception $e) {
                return error;
            }
        } else {
            
        }
    }

    public function login(Request $data) {
        
              $email = $data['email'];
              $password = $data['password'];
              $validator = Validator::make($data->all(), [
                       'email' => 'required|email',
                       'password' => 'required'
             ]);
           if (!$validator->passes()) {
                  $messages = $validator->errors();
                    return response()->json(array('status' => 'false', 'message' => $messages->all()));
           }
              if (Auth::attempt(['email' => $email, 'password' => $password])) {
                   return response()->json(array('status' => 'true', 'message' => trans('lang.logindone')));
             } else {
                    return response()->json(array('status' => 'false', 'message' => trans('lang.loginerror')));
               }
             } 

      public function register(Request $data) {

        $validator = Validator::make($data->all(), [
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6']
        );
        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(array('status' => 'false', 'message' => $messages->all()));
        } else {
            $main = new User();
            $main->name = $data['name'];
            $main->email = $data['email'];
            $main->password = bcrypt($data['password']);
            $main->save();
            Auth::login($main);
            return response()->json(array('status' => 'true', 'message' => trans('lang.logindone')));
        }
    }

    public function smallcartcontent() {
        $card = $_SESSION['cart'];
        // dd($card);
        return view('site.smallcartcontent')->with('card', $card);
    }

           public function addtocartmore($poid, Request $data) {
                $product = Product::find($poid);
                $size = \App\ProductSize::find($data['sizeid']); //if user send his size
              if (empty($size)) { //if user don't send his size (Get First Size As Defult)
                    $size = \App\ProductSize::where('product_id', $poid)->first();
                  }
                   $color = \App\ProductColor::find($data['colorid']); //if user send his size
                  if (count($color) < 1) { //if user don't send his size (Get First Size As Defult)
                       $color = \App\ProductColor::where('product_id', $poid)->first();
                  }
                   
                  if(isset($data)){
                     $q = $data['qu'];
                    }
                     else{
                         $q =1; 
                     }
        
            if (isset($_SESSION['cart'])) {
                if (is_array($_SESSION['cart'])) {
                   $i = $this->product_exists($poid);
                    if ($i >= 0) {//if producr already in shop cart
                       if ($product->Quantity() < ($_SESSION['cart'][$i]['quantity'] + 1)) {
                           return $product->Quantity();
                      } 
                     $_SESSION['cart'][$i]['quantity'] ++;
                     if ($product->offer > 0) {
                        $_SESSION['total']+=$product->price - (($product->price * $product->offer / 100));
                     } else {
                        $_SESSION['total']+=$product->price;
                     }
                    } else {
                     if ($product->Quantity() < 1) {
                         return $product->Quantity();
                     }
                       $max = count($_SESSION['cart']);
                       $_SESSION['cart'][$max]['productid'] = $poid;
                       $_SESSION['cart'][$max]['quantity'] = $q;
                    if (count($size) >0 ) { 
                       $_SESSION['cart'][$max]['size'] = $size->id;
                       $_SESSION['cart'][$max]['sizename'] = $size->size;
                       }
                 
                     if (count($color) > 0 ) { 
                       $_SESSION['cart'][$max]['color'] = $color->id;
                       $_SESSION['cart'][$max]['colorname'] = $color->color;
                     }
                      
                    if ($product->offer > 0) {
                        $_SESSION['total']+=$product->price - (($product->price * $product->offer / 100));
                      } else {
                        $_SESSION['total']+=$product->price;
                        }
                      }
                    }
                } else {

                $_SESSION['cart'] = array();
                $_SESSION['cart'][0]['productid'] = $poid;
                $_SESSION['cart'][0]['quantity'] = $q;

             if ($product->offer > 0) {
                    $_SESSION['total']+=($product->price - (($product->price * $product->offer / 100)));
                } else {
                    $_SESSION['total']+=$product->price;
                }
            }
            return "done";
        }
    
      public function addtocart($poid) {
        $product = Product::find($poid);
            $q = 1; 
        
        if (isset($_SESSION['cart'])) {
            if (is_array($_SESSION['cart'])) {
                $i = $this->product_exists($poid);
                if ($i >= 0) {//if producr already in shop cart
                    if ($product->Quantity() < ($_SESSION['cart'][$i]['quantity'] + 1)) {
                        return $product->Quantity();
                    }
                    $_SESSION['cart'][$i]['quantity'] ++;
                    if ($product->offer > 0) {
                        $_SESSION['total']+=$product->price - (($product->price * $product->offer / 100));
                    } else {
                        $_SESSION['total']+=$product->price;
                    }
                } else {
                    if ($product->Quantity ()< 1) {
                        return $product->Quantity();
                    }
                    
                    $max = count($_SESSION['cart']);
                    $_SESSION['cart'][$max]['productid'] = $poid;
                    $_SESSION['cart'][$max]['quantity'] = $q;
                    if ($product->offer > 0) {
                        $_SESSION['total']+=$product->price - (($product->price * $product->offer / 100));
                    } else {
                        $_SESSION['total']+=$product->price;
                    }
                }
            }
        } else {

            $_SESSION['cart'] = array();
            $_SESSION['cart'][0]['productid'] = $poid;
            $_SESSION['cart'][0]['quantity'] = $q;
            
            if ($product->offer > 0) {
                $_SESSION['total']+=($product->price - (($product->price * $product->offer / 100)));
            } else {
                $_SESSION['total']+=$product->price;
            }
        }
        return "done";
    }
    

    public function product_exists($pid) {
        //check if product exist in cart or not
        $pid = intval($pid);
        $max = count($_SESSION['cart']);
        $flag = -1;
        for ($i = 0; $i < $max; $i++) {
            if ($pid == $_SESSION['cart'][$i]['productid']) {
                $flag = $i;
                return $i;
            }
        }
             return $flag;
    }

    public function getcartcontent() {
        $card = $_SESSION['cart'];
        return view('site.cartcontent')->with('card', $card);
    }


    public function removfromcart($pid) {
        
        $product = Product::find($pid);
        $max = count($_SESSION['cart']);
        for ($i = 0; $i < $max; $i++) { 
            if ($pid == $_SESSION['cart'][$i]['productid']) {
                if ($product->offer > 0) {
                    $_SESSION['total'] -=$_SESSION['cart'][$i]['quantity'] * ($product->price - (($product->price * $product->offer / 100)));
                } else {
                    $_SESSION['total'] -=$_SESSION['cart'][$i]['quantity'] * $product->price;
                }
                
                   unset($_SESSION['cart'][$i]);
                   
                     break;
            }
        }

             $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    public function UpdateCart($pid, $new_q) {
        $pid = intval($pid);
        $product = Product::find($pid);
        $max = count($_SESSION['cart']);
        for ($i = 0; $i < $max; $i++) {
            if ($pid == $_SESSION['cart'][$i]['productid']) {
                if ($product->quantity < $new_q) {
                    return $product->quantity;
                }
                if ($product->offer > 0) {
                    $_SESSION['total'] -=$_SESSION['cart'][$i]['quantity'] * ($product->price - (($product->price * $product->offer / 100)));
                } else {
                    $_SESSION['total'] -=$_SESSION['cart'][$i]['quantity'] * $product->price;
                }
                $_SESSION['cart'][$i]['quantity'] = $new_q;
                 if ($product->offer > 0) {
                    $_SESSION['total'] +=$new_q * ($product->price - (($product->price * $product->offer / 100)));
                } else {
                    $_SESSION['total'] +=$new_q* $product->price;
                }
                break;
            }
        }
             $_SESSION['cart'] = array_values($_SESSION['cart']);
             return "done";
    }

    public function subscribe(Request $data) {
          $validator = Validator::make($data->all(), [
            'email' => 'required|email|max:255|unique:subscribers']
         );
        if ($validator->fails()) {
            $messages = $validator->errors();
            return $messages->all();
        } else {
            $sub = new Subscribe();
            $sub->email = $data['email'];
            $sub->save();
            return "done";
        }
    }

    public function addtowishlist($id) {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $check = Wlist::where('user_id', '=', $user_id)->where('product_id', '=', $id)->first();

            if (count($check) >= 1) {
                $check->delete();
                return "unlike";
            } else {

                $item = new Wlist();
                $item->user_id = $user_id;
                $item->product_id = $id;
                $item->save();
                return "like";
            }
        }
    }
    
   
   public function Addtocompare($id) {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $check = CompareList::where('user_id', '=', $user_id)->where('product_id', '=', $id)->first();

            if (count($check) >= 1) {
                $check->delete();
                return "unlike";
            } else {

                $item =new CompareList();
                $item->user_id = $user_id;
                $item->product_id = $id;
                $item->save();
                return "like";
            }
        }
    }
    
   
     public function removeall() {
     
         unset($_SESSION['cart']);
          return Redirect::to('Cart');
     
       
    }
    
    function removefromwlist($id) {
        
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $check = Wlist::where('user_id', '=', $user_id)->where('product_id', '=', $id)->first();
            if (count($check) >= 1) {
                $check->delete();
                return ("done");
            }
        }
        return 'error';
    }

          public function postcheckout(Request $data) {
                 $validator = Validator::make($data->all(), [
                    'first_name' => 'required|max:255',
                    'email' => 'required|email', 'phone' => 'required',
                    'address' => 'required', 'city' => 'required',
                    'country' => 'required', 'code' => 'required'
        ]);

        if ($validator->passes()) {
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->first_name = $data['first_name'];
            $order->last_name = $data['las_name'];
            $order->email = $data['email'];
            $order->phone = $data['phone'];
            $order->address = $data['address'];
            $order->city = $data['city'];
            $order->country = $data['country'];
            $order->code = $data['code'];
            $card = $_SESSION['cart'];
            if (count($card) < 1) {
                return Redirect::to('Cart');
            }
            $total = 0;
            foreach ($card as $p) {
                $pro = Product ::find($p['productid']);
                $total +=($pro->price - ($pro->price * ($pro->offer / 100)))*$p['quantity'];
            }
            $order->total_price = $total;
            $order->save();
            foreach ($card as $p) {
                $order_det = new Order_details();
                $order_det->product_id = $p['productid'];
                $order_det->quantity = $p['quantity'];
                $order_det->order_id = $order->id;
                $order_det->save();
            }
            unset($_SESSION['cart']);
            Session::flash('done', 'hh');
            return Redirect::to('Cart');
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    public function   total(){
        $card = $_SESSION['cart'];
        $total = 0;
        
        $main=App\Main::find(1);
        $currency= App\Currencies::where('id',$main->default_currency)->first();
        foreach ($card as $p) {
            $pro = App\Product::where('id',$p['productid'])->first();
            if ($pro->offer != 0) {
                $total+=($pro->price - ($pro->price * ($pro->offer / 100))) * $p['quantity'];
         }else {
                $total+=$pro->price * $p['quantity'];  }
        }
            if ($total == 0) {
                return "0";
            } else {
             return $total ;
        }
    }

    public function quantity() {
        $card = $_SESSION['cart'];
        $total = 0;
        foreach ($card as $p) {
          $pro = App\Product::where('id',$p['productid'])->first();
          $total+= $p['quantity'];
            
        }
        if ($total == 0) {
            return "0";
        } else {
           return $total;
        }
    }
    
    public function shipments() {
          $card = $_SESSION['cart'];
          $m=0;
          $total= 0;
          foreach ($card as $p) {
            $pro = App\Product::where('id',$p['productid'])->first();
            $total+= $pro->weight * $p['quantity']; 
                                         
        }
           return $total ;
    }

}
