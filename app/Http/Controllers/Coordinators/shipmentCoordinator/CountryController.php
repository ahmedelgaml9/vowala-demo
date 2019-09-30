<?php

namespace App\Http\Controllers\Coordinators\shipmentCoordinator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Continent;
use App\Country;
use App\Http\Requests\ContinentRequest;

//use Auth;
class CountryController extends Controller {

    //=======  request and model and view file =============//
    public function __construct(ContinentRequest $request, Country $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'coordinators/shipmentCoordinator/country/';
    }

    public function index() {
        $continents = Continent::all()->pluck('name', 'id');
        if (is_null($this->request->value)) {
            $c = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $c = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $c->setPath('countries');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('c', 'sections'))->render());
        }
        return View($this->view . 'index', compact('c', 'continents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        abort(404);
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
                return response()->json(array('status' => 'true', 'message' => "Add Continent Done Sucessfully"));
            return redirect()->back()->with('success', "Add Continent Done Sucessfully");
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
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $continents = Continent::all()->pluck('name', 'id');
        $c = Country::find($id);
        return View($this->view . 'edit', compact('c', 'continents'));
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
                return response()->json(array('status' => 'true', 'message' => 'Update Country Done'));
            return redirect()->back()->with('success', 'Update Country Done');
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
