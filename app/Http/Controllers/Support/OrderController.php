<?php

namespace App\Http\Controllers\Support;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Order;
use App\Order_details;
use App;
use Session;
use Redirect;

//use Auth;
class OrderController extends Controller {

//=======  request and model and view file =============//
    public function __construct(Request $request, Order $model) {
        App::setLocale(Session::get('local'));
        $this->request = $request;
        $this->model = $model;
        $this->view = '/support/orders/';

    }

    public function create() {
        abort(404);
    }

    public function edit($id, Request $request) {
        $order = Order::find($id);
        if($order){
            return view($this->view . 'edit', compact('order'));
        }
        return redirect()->back();
    }


    public  function sendToSeller(Request $request){
        $order = Order_details::find($request['id']);
        if (!empty($order)) {
            if ($request['status'] == 1 || $request['status'] == 2) {
                $order->status = $request['status'];
                $order->save();
                return redirect()->back();
            }
        } else {
            abort(404);
        }
    } 
    public function index() {
        if (is_null($this->request->value)) {
            $orders = $this->model->orderBy('id','desc')->paginate(25);
        } else {
          //  $this->request->flash();
            $orders = $this->model->where('phone', 'like', "{$this->request->value}%")
                                  ->orWhere('id', 'like', "{$this->request->value}%")
                                  ->orWhere('email', 'like', "{$this->request->value}%")
                                  ->orderBy('id','desc')
                                  ->paginate(25);
            }
             $orders->setPath('orders');
           if ($this->request->ajax()) {
               return response()->json(view($this->view . 'loop', compact('orders'))->render());
           }
        
            return View($this->view . 'index', compact('orders'));
        }

    public function show($id) {
        $order = $this->model->where('id', $id)->first();
         
        if (!empty($order)) {
            return View($this->view . 'order', compact('order'));
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request) {
        $order = $this->model->find($id);
        if ($request['status'] == 1) { //Confirm
            $ok = 1;
//            $order->status = 1;
//             $order->deliver_date = date("Y-m-d");
//            $order->save();
            foreach ($order->products as $det) {
                $requiredsize = App\ProductSize::where('product_id', $det->product->id)->where('size', $det->Size)->first();
                if (!empty($requiredsize)) {
                    if ($requiredsize->qu >= $det->quntity ) {
                        $ok =1;
                    } else {
//                        $det->status = 0;
//                        $det->save;
                        $ok = 0;
                        break;
                    }
                } else {
                       $ok = 0;
                        break;
                }
            }
            if ($ok == 1) {
                 foreach ($order->products as $det) {
                    $requiredsize = App\ProductSize::where('product_id', $det->product->id)->where('size',$det->Size)->first();
                    if (!empty($requiredsize)) {
                        if ($requiredsize->qu >= $det->quntity || $det->status == 2) {
                            $requiredsize->qu = -$det->quntity; //remove el quantity mn el kol
                            $requiredsize->save();
                        }
                    }
                }
                $order->status = 1;
                $order->save(); //Order Is Confirmed
            } else {
                Session::flash('error', 'das');
            }
        } else if ($request['status'] == 0 || $request['status'] == 2 || $request['status'] == 3 ) {
            $order->status = $request['status'];
            $order->save();
        }else if($request['status'] == 4){
            //when the order  is canceled
            $order->status = $request['status'];
            if(isset($request['comments'])){
                $order->comments = $request['comments'];
            }
               $order->save();
          }
        
          else if($request['status'] == 5){
                //when the order  is canceled
                $order->status = $request['status'];
                $order->order_return = 0 ;
                if(isset($request['comments'])){
                    $order->comments = $request['comments'];
                }
                $order->save();
            } 
            
            else {
            }

               return Redirect::back();
    }

    public function destroy($id) {
        $delete = $this->model->destroy($id);
        if ($delete) {
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => trans('lang.deletedsuccessfully')));

            return redirect()->back()->with('failed', trans('lang.deletedsuccessfully'));
        }
        else {
            if ($this->request->ajax())
                return response()->json(array('status' => 'false', trans('lang.deletedfailed')));
            return redirect()->back()->with('failed', trans('lang.deletedfailed'));
        }
    }

}
