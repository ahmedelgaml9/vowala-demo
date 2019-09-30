<?php

namespace App\Http\Controllers\Coordinators\shipmentCoordinator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Zone;
use App\Country;
use App\Zonecontent;
use App\Continent;
use App\Http\Requests\ZoneRequest;

//use Auth;
class ZoneController extends Controller {

    //=======  request and model and view file =============//
    public function __construct(ZoneRequest $request, Zone $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'coordinators/shipmentCoordinator/zones/';
    }

    public function index() {
        if (is_null($this->request->value)) {
            $zones = $this->model->paginate(25);
        } else {
        //    $this->request->flash();
            $zones = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $zones->setPath('zones');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('zones'))->render());
        }
        return View($this->view . 'index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $continents = Continent::all();
        return View($this->view . 'create', compact('continents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $zone = $this->model->create($this->request->all());
        if ($zone) {
            $zone_id = $zone->id;
            $country_id =$this->request->country;    
             Zonecontent::create(['zone_id' => $zone_id , 'country_id' => $country_id]);
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => "Add Zone Done Sucessfully"));
            return redirect(url('shipmentCoordinator/zones'))->with('success', "Add Zone Done Sucessfully");
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
        $zone = $this->model->find($id);
        if (empty($zone)) {
            abort(404);
        }
        return View($this->view . 'show', compact('zone'));
    }

    public function delcont($id) {
        //remove Country From Zone = Zone_id ==0
        $del = \App\Country::find($id);
        $del->zone_id=0;
        $del->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $continents = Continent::all();
        $zone = $this->model->where('id', $id)->first();
        if ($zone) {
            return View($this->view . 'edit', compact('zone', 'continents'));
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
        // $zone = $this->model->create($this->request->all());
        // if ($zone) {
        //     $zone_id = $zone->id;
        //     $country_id =$this->request->country;    
        //      Zonecontent::create(['zone_id' => $zone_id , 'country_id' => $country_id]);

        $update = $this->model->find($id)->update($this->request->all());
        //dd($this->request->all());

        if ($update) {
            if ($this->request->has('country')&&$this->request->has('continent')) {
                $country_id = $this->request['country'];
                $continent_id = $this->request['continent'];
                $this->model->find($id)->zoneInfo->update(['country_id'=> $country_id]);
                $this->model->find($id)->zoneInfo->country->update(['continent_id' => $continent_id]);
            }
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => 'Update Section Done'));
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
