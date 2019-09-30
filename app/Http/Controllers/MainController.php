<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MainRequest; 
use App\Main;
use App\Galary;
use App\Subscribe;
use App;


class MainController extends Controller {

    public function __construct(Request $request, Main $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/main/';
         $data=\App\Main::find(1);
        $lang =$data->setlang;
        if ($lang == 1) {

            App::setLocale('en');
        }

        else{

            App::setLocale('ar');
        }
        
        
        
    }

    public function index() {
        $main = $this->model->find(1);
        $currency=  \App\Currencies::all();
        if ($main) {
            return View($this->view . 'settings', compact('main','currency'));
        } else {
            abort(404);
        }
    }


    public function  aboutus() {
        $main = $this->model->find(1);
        if ($main) {
            return View($this->view . 'aboutsettings', compact('main'));
        } else {
            abort(404);
        }
    }

    public function contactus() {
        $main = $this->model->find(1);
        if ($main) {
            return View($this->view . 'contactsettings', compact('main'));
        } else {
            abort(404);
        }
    }

    public function header ()
    {
        $main = $this->model->find(1);
        if ($main) {
            return View($this->view . 'header_settings', compact('main'));
        } else {
            abort(404);
        }
    }

   public function seo(){
        $main = $this->model->find(1);
        if ($main) {
            return View($this->view . 'seo_settings', compact('main'));
        } else {
            abort(404);
        }
    }


     public function banner (){
        $main = $this->model->find(1);
        if ($main) {
            return View($this->view . 'banner', compact('main'));
        } else {
            abort(404);
        }
    }

  public function footer (){
        $main = $this->model->find(1);
        if ($main) {
            return View($this->view . 'footer_settings', compact('main'));
        } else {
            abort(404);
        }
    }
    
    
    public function arindex() {
        $main = $this->model->find(1);
        if ($main) {
            return View($this->view . 'ar_settings', compact('main'));
        } else {
            abort(404);
        }
    }
    

    public function update() {
        $update = $this->model->find(1)->update($this->request->all());
        if ($update) {
            
          \Session::flash('flash_message', 'settings successfully updated'); //<--FLASH MESSAGE
            return redirect()->back();

           } else {
             \Session::flash('flash_message', 'settings   not successfully updated'); //<--FLASH MESSAGE
                return redirect()->back();
           }}

    public function create() {
        $photoes = Galary::ALL();
        return View($this->view . 'gallary', compact('photoes'));
    }

    public function store() {
        $model = new Galary();
        $insert = $model->create($this->request->all());
        if ($insert) {
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => trans('lang.addedsuccessfully')));
            return redirect()->back()->with('success', trans('lang.addedsuccessfully'));
        }
        else {
            if ($this->request->ajax())
                return response()->json(array('status' => 'false', 'message' => trans('lang.addedfailed')));
            return redirect()->back()->with('failed', trans('lang.addedfailed'));
        }
    }

    public function destroy($id) {
        $photo = Galary::find($id);
        $image = 'adminstyle/assets/images/gallery/' . $photo->photo;
        if (file_exists($image) && !empty($photo->photo)) {
            unlink($image);
        }
        $photo->delete();
        return redirect()->back();
    }

    public function subscribers() {
        $model = new Subscribe();
        if (is_null($this->request->value)) {
            $subscribers = $model->paginate(25);
        } else {
            $this->request->flash();
            $subscribers = $model->where('email', 'like', "%{$this->request->value}%")
                    ->paginate(50);
        }
        $subscribers->setPath('subscribers');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('subscribers'))->render());
        }
        return View($this->view . 'subscribers', compact('subscribers'));
    }

    public function delsubs($id) {
        $del = Subscribe::find($id);
        $del->delete();
        return redirect()->back();
    }

}
