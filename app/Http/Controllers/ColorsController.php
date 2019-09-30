<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Colors;
use App\Http\Requests\BlogCatRequest;
use App;
class ColorsController extends Controller {


    public function __construct(Request $request, Colors $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view   ='admin/colors/' ;
        
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
        if (is_null($this->request->value)) {
               $rows =$this->model->paginate(25);
        } else {
            $this->request->flash();
            $rows =$this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
           $rows->setPath('blogcat');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('rows', 'sections'))->render());
        }
        return View($this->view . 'index', compact('rows'));
     }
     
    public function create() {
        return View($this->view . 'create', compact('sections'));
    }

  
    public function store() {
        $insert = $this->model->create($this->request->all());
        if ($insert) {
           
            \Session::flash('flash_message','blogcats  successfully added');
            return redirect('admin/color');
        } else {
            \Session::flash('flash_message','Adding blogcats not complete, Try agin later '); 
       
            return redirect('admin/color');
        }
    }

  

    public function edit($id) {
        $row = $this->model->where('id', $id)->first();
        if ($row) {
            return View($this->view . 'edit', compact('row'));
        } else {
            abort(404);
        }
    }

   
    public function update($id) {
        $update = $this->model->find($id)->update($this->request->all());
        if ($update) {
           
            \Session::flash('flash_message','blogcats successfully added.');
           
            return redirect('admin/color');

        } else {
            \Session::flash('flash_message','Adding blogcats  not complete, Try agin later '); 
       
            return redirect('admin/color');
        }
    }

   
    public function destroy($id) {
        $delete = $this->model->destroy($id);
        if ($delete) {
              
            \Session::flash('flash_message','blogcats successfully deleted.'); 
            return redirect('admin/color');

        } else {
       
            \Session::flash('flash_message','Adding blogcats not complete, Try agin later '); 

            return redirect('admin/color');
        }
    }  

}
