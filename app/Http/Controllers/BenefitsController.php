<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Benefits;
use App\Section;
use App\Http\Requests\CategoryRequest;
use App;
class  BenefitsController extends Controller {

    public function __construct(Request $request, Benefits $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/benefits/';
        
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
            $rows = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
            $rows->setPath('cats');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('cats', 'sections'))->render());
        }
        return View($this->view . 'index', compact('rows', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View($this->view . 'create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @return Response
     */
    public function store() {
        $insert = $this->model->create($this->request->all());
        if ($insert) {
            
          \Session::flash('flash_message','features added successfully added.'); 
            return redirect('admin/benefits');

             }else {
                   \Session::flash('flash_message','features not complete, Try agin later '); 
       
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

        $row= $this->model->where('id', $id)->first();
        if ($row) {
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
        $update = $this->model->find($id)->update($this->request->all());
        if ($update) {
              
            \Session::flash('flash_message','features added successfully added.'); 
            return redirect('admin/benefits');

        } else {
            \Session::flash('flash_message','features not complete, Try agin later '); 
       
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
