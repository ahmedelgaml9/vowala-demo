<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\BrandRequest;
use App;
class BrandController extends Controller {

    public function __construct(Request $request, Brand $model) {

        $this->request = $request;
        $this->model = $model; 
        $this->view = 'admin/brands/';
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
            $rows = $this->model->paginate(20);
        } else {
            $this->request->flash();
            $rows = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(50);
                    
        }
        $rows->setPath('brands');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('rows'))->render());
        }
        return View($this->view . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        // $Sales = Sales::where('status', 1)->lists('name', 'id');
        return View($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @return Response
     */
    public function store() {

        $this->request->validate([
            'name' => 'required|min:3',
            'photo' => 'image',
            'custom_url' => 'required|unique:brands',
            'custom_url_ar' => 'required|unique:brands',

        ]);

        $insert = $this->model->create($this->request->all());
        if ($insert) {
              
            \Session::flash('flash_message','brands added successfully added.'); //<--FLASH MESSAGE
            return redirect('admin/brands');

        } else {
            \Session::flash('flash_message','brands not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
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
            return View($this->view . 'edit', compact('row'));
        } else {
            abort(404);
        }
    }

    
     public function update($id){
          $array = $this->request->all();
        if (!isset($this->request['home'])) {
            $array = array_add($array, 'home', "0");
        }
          $update = $this->model->find($id)->update($array);
          if ($update) {
             
                \Session::flash('flash_message','brands updated successfully'); //<--FLASH MESSAGE
                  return redirect('admin/brands');

             } else {
            \Session::flash('flash_message','brands not complete, Try agin later '); //<--FLASH MESSAGE
                return redirect()->back();
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
              
            \Session::flash('flash_message','resellers added successfully added.'); //<--FLASH MESSAGE
           
            return redirect('admin/brands');

        } else {
            \Session::flash('flash_message','Adding resellers not complete, Try agin later '); //<--FLASH MESSAGE
       
        }        return redirect()->back();

    }

}
