<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\Subcat;
use App\Http\Requests\SubcatRequest;
use App\CategoryGalary;
use App ;

class SubcatController extends Controller {

    public function __construct(Request $request, Subcat $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/subcats/';
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
            $rows  = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $rows ->setPath('cats');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('rows'))->render());
        }
        return View($this->view . 'index', compact('rows'));
    }

   
    public function create()
    {
        $sections= \App\Section::all();
        $cats = $this->model->select('name', 'id')->get();
        return View($this->view . 'create', compact('cats','sections'));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @return Response
     */
    public function store() {
        
        if ($this->request['cat_id'] == "") {
            unset($this->request['cat_id']);
        }
      
             $this->request->validate([
                 'name' => 'required',
                 'name_ar' => 'required',
                 'photo' => 'image',
                 'custom_url' => 'required|unique:subcat',
                 'custom_url_ar' => 'required|unique:subcat',

                  ]);
                   $insert = $this->model->create($this->request->all());
                   if ($insert) {
                     if ($this->request->hasFile('gallary')) {
                         $gallary = $this->request->file('gallary');
                      foreach ($gallary as $photo) {
                              $name = str_random(6) . '_' . $photo->getClientOriginalName();
                              $extension = strtolower($photo->getClientOriginalExtension());
                            if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {
                                 $galary = new CategoryGalary();
                                 $galary->photo = $name;
                                 $galary->category_id = $insert->id;
                                 $galary->save();
                                 $dest = 'admin-assets/images/subcats/';
                                 $photo->move($dest, $name);
                             }
                           }
                          }
                             \Session::flash('flash_message', 'Categories added successfully');
           
                               return redirect('/admin/subcats');

                           } else {
                                   \Session::flash('flash_message','Adding Categories not complete, Try agin later ');
       
                                     return redirect('/admin/subcats');
                           }
                          }

  
   
    public function show($id) {
       
       
       
    }

   
    public function edit($id) {
        
       $sections= \App\Section::all();
        $cats = $this->model->select('name', 'id')->get();
        $row = $this->model->where('id', $id)->first();
        
        if ($row) {
            return View($this->view . 'edit', compact('row', 'cats','sections'));
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
        if ($this->request['cat_id'] == "") {
            unset($this->request['cat_id']);
        }
        $array = $this->request->all();
        if (!isset($this->request['home'])) {
            $array = array_add($array, 'home', "0");
        }
        if (!isset($this->request['header'])) {
            $array = array_add($array, 'header', "0");
        }
        if (!isset($this->request['new'])) {
            $array = array_add($array, 'new', "0");
        }
        $update = $this->model->find($id)->update($array);
        if ($update) {
            
             if ($this->request->hasFile('gallary')) {
                     $gallary = $this->request->file('gallary');
                      foreach ($gallary as $photo) {
                          $name = str_random(6) . '_' . $photo->getClientOriginalName();
                          $extension = strtolower($photo->getClientOriginalExtension());
                         if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {
                             $galary = new CategoryGalary();
                             $galary->photo = $name;
                             $galary->category_id =$id;
                             $galary->save();
                             $dest = 'admin-assets/images/subcats/';
                             $photo->move($dest, $name);
                         }
                      }
                    }
            \Session::flash('flash_message',' Categories updated successfully');
           
            return redirect('/admin/subcats');

        } else {
            \Session::flash('flash_message','Adding Categories not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect('/admin/subcats');
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
           
            return redirect('/admin/subcats');

        } else {
            \Session::flash('flash_message','Adding resellers not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect('/admin/subcats');
        }
    }

}
