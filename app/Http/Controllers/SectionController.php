<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Http\Requests\SectionRequest;
use App;

class SectionController extends Controller
{

    public function __construct(Request $request, Section $model)
    {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/sections/';
        
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
            $sections = $this->model->paginate(20);
        } else {
            $this->request->flash();
            $sections = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(50);
        }
        $sections->setPath('sections');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('sections'))->render());
        }
        return View($this->view . 'index', compact('sections'));
    }

   
    public function create()
    {
        // $Sales = Sales::where('status', 1)->lists('name', 'id');
        return View($this->view . 'create');
    }

   
    public function store()
    {
        
        $this->request->validate([
            'name' => 'required|min:3',
            'photo' => 'image',
            'custom_url' => 'required|unique:sections',
            'custom_url_ar' => 'required|unique:sections',

        ]);

        $insert = $this->model->create($this->request->all());
        if ($insert) {
            \Session::flash('flash_message', 'sections added successfully'); 
            return redirect('admin/sections');
        } else {
            \Session::flash('flash_message', 'sections not complete, Try agin later '); 
       
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $row = $this->model->where('id', $id)->first();
        if ($row) {
            return View($this->view . 'edit', compact('row'));
        } else {
            abort(404);
        }
    }

    
    public function update($id)
      {
        $update = $this->model->find($id)->update($this->request->all());
        if ($update) {
            \Session::flash('flash_message', 'sections updated successfully added.'); //<--FLASH MESSAGE
            return redirect('admin/sections');
        } else {
            \Session::flash('flash_message', 'sections not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect()->back();
        }
    }

   
      public function destroy($id)
      {
        $delete = $this->model->destroy($id);
        if ($delete) {
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
