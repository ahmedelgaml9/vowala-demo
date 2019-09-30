<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Continent;
use App\Country;
use App;
use App\Http\Requests\ContinentRequest;

class CountryController extends Controller {

    public function __construct(Request $request, Country $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/country/';
        
         $data==\App\Main::find(1);
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
            $rows  = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $rows ->setPath('countries');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('c', 'sections'))->render());
        }
        return View($this->view . 'index', compact('rows', 'continents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {


     return View($this->view . 'create', compact('continents'));

    }

  
    public function store() {
        
        $insert = $this->model->create($this->request->all());
        if ($insert) {
            \Session::flash('flash_message', 'countries  successfully added'); //<--FLASH MESSAGE
            
            return redirect('admin/countries');

          } else {
            \Session::flash('flash_message', 'Adding countries not complete, Try agin later '); //<--FLASH MESSAGE
           return redirect('admin/countries');
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
        $c = Country::find($id);
        $row = $this->model->where('id', $id)->first();
        if   ($row ) {
            return View($this->view . 'edit', compact('row','continents'));
        } else {
            abort(404);
        }    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $update = $this->model->find($id)->update($this->request->all());
        if ($update) {
            \Session::flash('flash_message', 'countries updated successfully'); //<--FLASH MESSAGE
           
            return redirect('admin/countries');

        } else {
             \Session::flash('flash_message', 'Adding countries not complete, Try agin later '); 
       
                   return redirect('admin/countries');
        }
    }

   
    public function destroy($id) {
        $delete = $this->model->destroy($id);
        if ($delete) {
            \Session::flash('flash_message',  'countries  successfully deleted.'); 
                 return redirect('admin/countries');

        } else {
            \Session::flash('flash_message', 'deleting countries not complete, Try agin later '); 
       
            return redirect('admiin/countries');
        }
    }

}
