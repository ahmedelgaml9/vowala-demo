<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Catalog;
use App\Product;
use App\Subcat;
use App\Brand;
use App\ProductGalary;
use App\Sizes;
use App;

  class  SizesController extends Controller
  {

    public function __construct(Request $request, Sizes $model)
    {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/sizes/';
         $data=\App\Main::find(1);
        $lang =$data->setlang;
        if ($lang == 1) {

            App::setLocale('en');
        }

        else{

            App::setLocale('ar');
        }    
        
        
        
    }

        public function index()
        
        {
            
        
        if (is_null($this->request->value)) {
            $rows = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $rows = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
          $rows->setPath('catalog');
          if ($this->request->ajax()) {
              return response()->json(view($this->view . 'loop', compact('c', 'sections'))->render());
          }
               return View($this->view . 'index', compact('rows','cats'));
        }

    
    public function create()
      {
        $cats = Subcat::all();
        $brands = Brand::all()->pluck('name', 'id');
        return View($this->view . 'create', compact('cats', 'brands'));
    }

   
    public function store(Request $request )
     {
        
        $insert = $this->model->create($this->request->all());      
          if ($insert) {
        
            \Session::flash('flash_message', '');

            return redirect('admin/size');
        } else {
            \Session::flash('flash_message', 'Adding catalogs not complete, Try agin later ');
        
            return redirect('admin/size');
        }
    }

    
    public function show($id)
    {
        $product = $this->model->find($id);
        if (empty($product)) {
            abort(404);
        }
          return View($this->view . 'show', compact('product'));
    }

  
        
 
      public function edit($id)
       {
      
        $row = $this->model->where('id', $id)->first();
   
            return View($this->view . 'edit', compact('cats','row'));
       
     }

   
    public function update($id)
    {
       
        $update = $this->model->find($id)->update($this->request->all());
        if ($update) {
           
            \Session::flash('flash_message',  'sizes updated successfully'); 
               return redirect('/admin/size');
               } else {
            \Session::flash('flash_message', 'update sizes not complete, Try agin later '); 
       
            return redirect('/admin/size');
        }
    }
    

  
   
    public function destroy($id)
    {
        $delete = $this->model->destroy($id);
        if ($delete) {
            
            $deleteproject= Product::where('catalog_id',$id)->delete();
            if ($this->request->ajax()) {
                return response()->json(array('status' => 'true', 'message' => trans('lang.deletedsuccessfully')));
            }

                return redirect()->back()->with('failed', trans('lang.deletedsuccessfully'));
         } else {
              if ($this->request->ajax()) {
                    return response()->json(array('status' => 'false', trans('lang.deletedfailed')));
            }
                 return redirect()->back()->with('failed', trans('lang.deletedfailed'));
        }
    }
}
