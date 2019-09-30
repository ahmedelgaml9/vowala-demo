<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Message;
use App;
use Session;
use Redirect;

//use Auth;
class MessagesController extends Controller {

    //=======  request and model and view file =============//
    public function __construct(Request $request, Message $model) {
        App::setLocale(Session::get('local'));
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/messages/';
    }

    public function create() {
       if (is_null($this->request->value)) {
            $orders = $this->model->where('seen',0)->paginate(25);
        } else {
            // $this->request->flash();
            $orders = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $orders->setPath('orders');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('orders'))->render());
        }
        return View($this->view . 'index', compact('orders'));
    }

    public function edit() {
        abort(404);
    }

    public function index() {
        if (is_null($this->request->value)) {
            $orders = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $orders = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $orders->setPath('orders');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('orders'))->render());
        }
        return View($this->view . 'index', compact('orders'));
    }

    public function show($id) {
        $m = $this->model->where('id', $id)->first();
        if (!empty($m)) {
            $m->seen = 1;
            $m->save();
            return View($this->view . 'message', compact('m'));
        } else {
            abort(404);
        }
    }
     public function update($id) {
        $order = $this->model->where('id', $id)->first();
        $order->delivered = 1;
        $order->deliver_date = date("Y-m-d");
        $order->save();
        foreach ($order->products as $det) {
            if ($det->product->quantity > 0) {
                if ($det->product->quantity > $det->quntity) {
                    $det->product->quantity -=$det->quntity;
                } else if ($det->product->quantity < $det->quntity) {
                    $det->product->quantity = 0;
                    $det->quntity = $det->product->quantity;
                    $det->save();
                }
                $det->product->save();
            } else {
                $det->delete();
            }
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
