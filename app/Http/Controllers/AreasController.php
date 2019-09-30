<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Area;
use App\Zone;
use App;

class AreasController extends Controller {
     public function __construct(Request $request, Area $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/area/';
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
            $c = $this->model->paginate(20);
        } else {
            $this->request->flash();
            $c = $this->model->where('code', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $c->setPath('area');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('c', 'sections'))->render());
        }
             return View($this->view . 'index', compact('c', 'rows'));
    }

   
    public function create() {
        
          $zones = Zone::all();
          return View($this->view . 'create', compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @return Response
     */
    public function store() {
        
        $insert = $this->model->create($this->request->all());
        if ($insert) {
          \Session::flash('flash_message', 'area successfully added.'); //<--FLASH MESSAGE
            return redirect('/admin/area');
        } else {
            \Session::flash('flash_message', ' Adding Area not complete, Try agin later '); //<--FLASH MESSAGE
        
            return redirect('/admin/area');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
         $row=  $this->model->find($id);
         $zones = Zone::all();

         return View($this->view . 'edit', compact('row','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $update = $this->model->find($id)->update($this->request->all());
        if ($update) {
            if ($this->request->ajax())
            \Session::flash('flash_message', ' Area successfully updated'); //<--FLASH MESSAGE
            return redirect('/admin/area');
        } else {
            \Session::flash('flash_message', 'Adding  area not complete, Try agin later '); //<--FLASH MESSAGE
        
            return redirect('/admin/area');
        }
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
          \Session::flash('flash_message', 'Area successfully added.'); 
            return redirect('/admin/area');
        } else {
            \Session::flash('flash_message', 'area  not complete, Try agin later '); 
        
            return redirect('/admin/area');
        }
    }

}
