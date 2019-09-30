<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;  
use App\Slider;   
use App;

class SliderController extends Controller
{
    public function __construct(Request $request, Slider $model)
    {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/slider/';
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
            $slider = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $slider = Slide::where('title', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $slider->setPath('slider');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('slider'))->render());
        }
        return View($this->view . 'index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->request->validate([
            'photo' => 'required|mimes:jpeg,bmp,png',
            
        ]);

        $insert = $this->model->create($this->request->all());
        if ($insert) {
            \Session::flash('flash_message', 'slider added successfully'); //<--FLASH MESSAGE
            return redirect('admin/slider');
        } else {
            \Session::flash('flash_message', 'slider not complete, Try agin later '); //<--FLASH MESSAGE
       
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $admin = $this->model->find($id);
        if ($admin) {
            return View($this->view . 'edit', compact('admin'));
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
    public function update($id)
    {
        $update = $this->model->find($id)->update($this->request->all());
        if ($update) {
            \Session::flash('flash_message', 'slider updated successfully'); //<--FLASH MESSAGE
            return redirect('admin/slider');
        } else {
            \Session::flash('flash_message', 'slider not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
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
