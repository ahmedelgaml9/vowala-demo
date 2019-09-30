<?php

namespace App\Http\Controllers\Coordinators\productCoordinator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Product;
use App\User;
use App\Catalog;
use App\Block;
use App;
use Session;
use Redirect;

//use Auth;
class CoordinatorController extends Controller {

  //=======  request and model and view file =============//
      public function __construct(Request $request, Product $model) {
          $this->request = $request;
          $this->model = $model;
          $this->view = 'coordinators/productCoordinator/products/';
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() {
         if (is_null($this->request->value)) {
             $orders = $this->model->paginate(25);
         } else {
             $orders = $this->model->where('title', 'like', "%{$this->request->value}%")
                     ->paginate(25);
         }
         $orders->setPath('order');
         if ($this->request->ajax()) {
             return response()->json(view($this->view . 'loop', compact('orders'))->render());
         }

         return View($this->view . 'index', compact('orders'));
     }



     public function show($id) {
         $row = $this->model->find($id);
        $user = User::where('id',$row->user_id)->first();
        $catalog = Catalog::where('id', $row->catalog_id)->pluck('name','id')->first();
        $block = Block::where('id', $row->block_id)->pluck('title','id','ar_title')->first();
         if (empty($row)) {
             abort(404);
         }
         return View($this->view . 'single', compact('row','user','catalog','block'));
     }




          public function approveProduct($productId) {
             $update = $this->model->find($productId);
              $update->update(['status'=>'1']);
              if ($update) {
                  if ($this->request->ajax())
                      return response()->json(array('status' => 'true', 'message' => "Update Process done Sucessfully"));

                  return redirect()->back()->with('success', trans('message.updatedsuccessfully'));
              }else {
                  if ($this->request->ajax())
                      return response()->json(array('status' => 'false', 'message' => trans('lang.updatedfailed')));

                  return redirect()->back()->with('failed', trans('message.updatedfailed'));
              }
          }


          public function toggleCanceled($productId) {
             $update = $this->model->find($productId);
              $update->update(['status'=>'2']);
              if ($update) {
                  if ($this->request->ajax())
                      return response()->json(array('status' => 'true', 'message' => "Update Process done Sucessfully"));

                  return redirect()->back()->with('success', trans('message.updatedsuccessfully'));
              }else {
                  if ($request->ajax())
                      return response()->json(array('status' => 'false', 'message' => trans('lang.updatedfailed')));

                  return redirect()->back()->with('failed', trans('message.updatedfailed'));
              }
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



      public function delivered() {

        if (is_null($this->request->value)) {
            $orders = $this->model->where('delivered',1)->paginate(25);
        } else {
            $orders = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $orders->setPath('order');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('orders'))->render());
        }
          return View($this->view . 'delivered', compact('orders'));
      }


      public function pending() {
        if (is_null($this->request->value)) {
            $orders = $this->model->where('delivered',0)->paginate(25);
        } else {
            $orders = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $orders->setPath('order');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('orders'))->render());
        }

          return View($this->view . 'pending', compact('orders'));
      }

      public function canceled() {
        if (is_null($this->request->value)) {
            $orders = $this->model->where('delivered',2)->paginate(25);
        } else {
            $orders = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $orders->setPath('order');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('orders'))->render());
        }

          return View($this->view . 'canceled', compact('orders'));
      }

}
