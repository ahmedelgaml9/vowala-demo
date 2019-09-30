<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Zone;
use App\Country;
use App\Http\Requests\ContinentRequest;
use App;
class ZoneController extends Controller
{
    public function __construct(Request $request, Zone $model)
    {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/zones/';
        
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
        $rows->setPath('zones');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('c', 'sections'))->render());
        }
        return View($this->view . 'index', compact('rows'));
    }

   
    public function create()
     {
         $countries= Country::all();
          return View($this->view . 'create', compact('sections','countries'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storezones()
     {
           $this->request->validate([
            'name' => 'required',
             'name_ar' => 'required',
        ]);

        $insert = $this->model->create($this->request->all());
        if ($insert) {
            \Session::flash('flash_message', 'zones  successfully added.'); //<--FLASH MESSAGE
           
            return redirect('admin/zones');
        } else {
            \Session::flash('flash_message', 'Adding zones not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect('admin/zones');
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
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        
         $countries= Country::all();
        $row= $this->model->where('id', $id)->first();
        if ($row) {
            return View($this->view . 'edit', compact('row', 'sections','countries'));
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
            \Session::flash('flash_message', 'zones updated successfully'); //<--FLASH MESSAGE
           
            return redirect('admin/zones');
        } else {
            \Session::flash('flash_message', 'Adding zones not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect('admin/zones');
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
            \Session::flash('flash_message', 'continents  successfully deleted'); //<--FLASH MESSAGE
            return redirect('admin/zones');
        } else {
            \Session::flash('flash_message', 'Adding continents not complete, Try agin later '); //<--FLASH MESSAGE
       
            return redirect('admin/zones');
        }
    }
}
