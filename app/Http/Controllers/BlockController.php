<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Block;
use App\Http\Requests\BlockRequest;
use App;

class BlockController extends Controller {

    public function __construct(Request $request, Block $model) {

        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/blocks/';
        
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
            $cats = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $cats = $this->model->where('title', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $cats->setPath('blocks');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('cats', 'sections'))->render());
        }
        return View($this->view . 'index', compact('cats'));
    }

    public function create() {
        return View($this->view . 'create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @return Response
     */
      public function store(){
        $this->request->validate([
            'title' => 'required',
            'photo' => 'required|image',
            'title_ar' => 'required',


        ]);

        $insert = $this->model->create($this->request->all());
        if ($insert) {

            \Session::flash('flash_message','blocks add successfully '); //<--FLASH MESSAGE   
            return redirect('admin/blocks');

            }
     else {
         \Session::flash('flash_message','blocks Not add successfully '); //<--FLASH MESSAGE
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
        if  ($row) {
            return View($this->view . 'edit', compact('row','sections'));
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
            'title' => 'required',
            'title_ar' => 'required',

        ]);

        $update = $this->model->find($id)->update($this->request->all());
        if ($update) {
          
            \Session::flash('flash_message',' blocks add successfully '); //<--FLASH MESSAGE
            return redirect('admin/blocks');
            

           } else {
                    \Session::flash('flash_message','blocks not add successfully '); //<--FLASH MESSAGE
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
