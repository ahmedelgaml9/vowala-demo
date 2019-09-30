<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Product;
use App\Order_details;
use Auth;

//use Auth;
class OrderController extends Controller {

    //=======  request and model and view file =============//
    public function __construct(Request $request, Order_details $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'seller/orders/';
    }

    public function index() {
        
        $products = Product::where('user_id', Auth::user()->id)->get()->pluck('id');
        if (is_null($this->request->value)) {
              $orders =  $this->model->wherein('product_id', $products)->where('status','<>',0)->paginate(25);
        } else {
            $this->request->flash();
              $orders =  $this->model->wherein('product_id',$products)->where('status','<>',0)
                                     ->where('phone', 'like', "{$this->request->value}%")
                                     ->orWhere('id', 'like', "{$this->request->value}%")
                                     ->orWhere('email', 'like', "{$this->request->value}%")
                                    ->get();
        }
     
         $orders->setPath('orders');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('products'))->render());
        }
        return View($this->view . 'index', compact('orders'));
    }
     public function pending() {
        $products = Product::where('user_id', Auth::user()->id)->get()->pluck('id');
        if (is_null($this->request->value)) {
              $orders =  $this->model->wherein('product_id',$products)->where('status',1)->paginate(25);
        } else {
            $this->request->flash();
              $orders =  $this->model->wherein('product_id',$products)->where('status',1)->where('name', 'like', "%{$this->request->value}%")
                    ->get();
        }
     
         $orders->setPath('orders');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('products'))->render());
        }
        return View($this->view . 'index', compact('orders'));
    }
 
    

  
    

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
       $row=  $this->model->find($id);
       $row->status=2;
       $row->save();
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
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
