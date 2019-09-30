<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Add;
use App\Http\Requests\AddRequest;
use App;
class AddController extends Controller {

    public function __construct(Request $request, Add $model) {
        
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/adds/';
        
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
            $rows = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $rows = $this->model->where('title', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
          $rows->setPath('adds');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('rows', 'sections'))->render());
        }
        return View($this->view . 'index', compact('rows'));
    }

    public function create() {
        return View($this->view . 'create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @return Response
     */
      public function store() {

        $this->request->validate([
            'photo' => 'required|image',
             'title' => 'required|min:3',
             'title_ar' => 'required|min:3',
             'link' => 'required|min:3',
           
        ]);

        $insert = $this->model->create($this->request->all());
        if ($insert) {
            \Session::flash('flash_message', 'adds add successfully '); //<--FLASH MESSAGE
            return redirect('admin/adds');
        }
            else {
         \Session::flash('flash_message','adds Not add successfully '); //<--FLASH MESSAGE
        return redirect()->back();
    }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
         $row = $this->model->where('id', $id)->first(); 
        if ($row) {
            return View($this->view . 'edit', compact('row', 'sections'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        $this->request->validate([
            'photo' => 'required|image',
             'title' => 'required|min:3',
             'title_ar' => 'required|min:3',
             'link' => 'required|min:3',
        ]);

        $update = $this->model->find($id)->update($this->request->all());
        if ($update) {
            \Session::flash('flash_message',' images add successfully '); //<--FLASH MESSAGE
            return redirect('admin/adds');
            
    } else {
         \Session::flash('flash_message',' images Not add successfully '); //<--FLASH MESSAGE
        return redirect()->back();
    }
    }

    
    public function destroy($id)
    {
        $delete = $this->model->destroy($id);
        if ($delete) {
            \Session::flash('flash_message', 'continents  successfully deleted'); //<--FLASH MESSAGE
            return redirect('admin/adds');

        } else {
            \Session::flash('flash_message', 'Adding continents not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect('admin/adds');
        }
    }
    
}
