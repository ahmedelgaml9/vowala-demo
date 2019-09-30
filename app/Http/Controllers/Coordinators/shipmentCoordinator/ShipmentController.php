<?php

namespace App\Http\Controllers\Coordinators\shipmentCoordinator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Http\Requests\ShipmentRequest;
use App\Shipment;
use App\Weights;
use App\Shipmentzone;
use App\Zone;
use App\ShipmentPrice;

//use Auth;
class ShipmentController extends Controller {

    //=======  request and model and view file =============//
    public function __construct(ShipmentRequest $request, Shipment $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'coordinators/shipmentCoordinator/shipment/';
    }

    public function index() {
        if (is_null($this->request->value)) {
            $methods = $this->model->paginate(25);
        } else {
            $this->request->flash();
            $methods = $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $methods->setPath('methods');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('methods'))->render());
        }
        return View($this->view . 'index', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $zones = Zone::all();
        return View($this->view . 'create', compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $insert = $this->model->create($this->request->all());
        if ($insert) {
            if ($this->request->has('froms')) {
                $froms = explode(',', $this->request['froms']);
                $tos = explode(',', $this->request['tos']);
                $values = explode(',', $this->request['values']);
                for ($i = 0; $i < count($froms)-1; $i++) {
                    $new = new ShipmentPrice();
                    $new->shipment_id = $insert->id;
                    $new->from = $froms[$i];
                    $new->to = $tos[$i];
                    $new->value = $values[$i];
                    $new->save();
                }
            }
            if ($this->request->has('zones')) {
                $zones = $this->request['zones'];
                for ($i = 0; $i < count($zones); $i++) {
                    $newz = new Shipmentzone();
                    $newz->shipment_id = $insert->id;
                    $newz->zone_id = $zones[$i];
                    $newz->save();
                }
            }
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => "Add Product Done Sucessfully"));
            return redirect(url('shipmentCoordinator/shipment'))->with('success', "Add Product Done Sucessfully");
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
        $method = $this->model->find($id);
        $all_zones_shipment_price = ShipmentPrice::where('shipment_id', $id)->get();
        if (empty($method)) {
            abort(404);
        }
        return View($this->view . 'show', compact('method', 'all_zones_shipment_price'));
    }

    public function delzone($id) {
        $del = Shipmentzone::find($id);
        $del->delete();
        return redirect()->back();
    }

    public function delweghit($id) {
        $del = Weights::find($id);
        $del->delete();
        return redirect()->back();
    }
    public function price() {
        //dd($this->request->all());
        $validator = Validator::make($this->request->all(), [
            'from' => 'required|integer',
            'to' => 'required|integer',
            'value' =>'required|integer',
            'shipment_id' =>'required|integer',
        ]);
    
        if ($validator->fails())
        {
            if ($this->request->ajax())
            return response()->json(array('status' => 'flase', 'message' => $validator->errors()->first()));
        return redirect()->back()->with('error', $validator->errors()->first());

        }
        
        if( ShipmentPrice::create( $this->request->all() ) )
        {
            if ($this->request->ajax())
            return response()->json(array('status' => 'true', 'message' => "Added zone with price Done Sucessfully"));
          return redirect()->back()->with('success', "Add Product Done Sucessfully");
    
        }else{
            if ($this->request->ajax())
            return response()->json(array('status' => 'flase', 'message' => "Something went wrong try again"));
          return redirect()->back()->with('error', "Something went wrong try again");

        }

    }

    public function updateweight($id) {
        $update = Weights::find($id)->update($this->request->all());
        if ($update) {
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $zones11 = Shipmentzone::where('shipment_id', $id)->pluck('zone_id');
        $zones = Zone::wherenotin('id', $zones11)->get();
        
        $allZones = Zone::wherein('id', $zones11)->get()->pluck('name', 'id');
        $all_zones_shipment_price = ShipmentPrice::where('shipment_id', $id)->get();

        $method = $this->model->where('id', $id)->first();
        if ($method) {
            return View($this->view . 'edit', compact('method', 'zones', 'allZones', 'all_zones_shipment_price'));
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
            if ($this->request->has('froms')) {
                $froms = explode(',', $this->request['froms']);
                $tos = explode(',', $this->request['tos']);
                $values = explode(',', $this->request['values']);
                for ($i = 0; $i < count($froms)-1; $i++) {
                    $new = new ShipmentPrice();
                    $new->shipment_id = $id;
                    $new->from = $froms[$i];
                    $new->to = $tos[$i];
                    $new->value = $values[$i];
                    $new->save();
                }
            }
            if ($this->request->has('zones')) {
                $zones = $this->request['zones'];
                for ($i = 0; $i < count($zones); $i++) {
                    $newz = new Shipmentzone();
                    $newz->shipment_id = $id;
                    $newz->zone_id = $zones[$i];
                    $newz->save();
                }
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
