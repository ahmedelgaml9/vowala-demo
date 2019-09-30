<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Faqs;
 use App\Http\Requests\FaqRequest;
 use App;
 
//use Auth;

class FaqsController  extends Controller {

    //=======  request and model and view file =============//
    public function __construct(FaqRequest $request, Faqs $model) {
 
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/faqs/';
    }

    public function index() {
          if (is_null($this->request->value)) {
            $cats = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $cats = $this->model->where('question', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $cats->setPath('faqs');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('cats', 'sections'))->render());
        }
        return View($this->view . 'index', compact('cats'));
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
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => "Add Question Done Sucessfully"));
            return redirect()->back()->with('success', "Add Category Done Sucessfully");
        }
        else {
            if ($this->request->ajax())
                return response()->json(array('status' => 'false', 'message' => trans('Error')));
            return redirect()->back()->with('failed', trans('lang.Error'));
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
 
        $cat = $this->model->where('id', $id)->first();
        if ($cat) {
            return View($this->view . 'edit', compact('cat', 'sections'));
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
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => 'Update Question Done'));
            return redirect()->back()->with('success', 'Update Section Done');
        }else {
            if ($this->request->ajax())
                return response()->json(array('status' => 'false', 'message' => 'Update Faild'));

            return redirect()->back()->with('failed', 'Update Faild');
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
