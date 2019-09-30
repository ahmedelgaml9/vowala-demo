<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ShipmentRequest;
use App\Shipment;
use App\Weights;
use App\ShipmentPrice;
use App\Shipmentzone;
use App\Zone;
use Illuminate\Support\Facades\Validator;
use App;
class ShipmentController extends Controller {

    public function __construct(ShipmentRequest $request, Shipment $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/shipment/';
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
       
        
        return View($this->view . 'create', compact('zones', 'allZones'));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @return Response
     */
    public function store() {
        
        $insert = $this->model->create($this->request->all());
        if ($insert) {
            
            if ($this->request->has('zones')) {
                $zones = $this->request['zones'];
                for ($i = 0; $i < count($zones); $i++) {
                    $newz = new Shipmentzone();
                    $newz->shipment_id = $insert->id;
                    $newz->zone_id = $zones[$i];
                    $newz->save();
                }
            }
             \Session::flash('flash_message', 'shipments method added successfully added.'); //<--FLASH MESSAGE
            
            return redirect('admin/shipments');

          } else {
            \Session::flash('flash_message', 'shipments method not complete, Try agin later '); //<--FLASH MESSAGE
           return redirect('admin/shipments');
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

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $zones = Zone::all();
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
          
            if ($this->request->has('zones')) {
                $zones = $this->request['zones'];
                for ($i = 0; $i < count($zones); $i++) {
                    $newz = new Shipmentzone();
                    $newz->shipment_id = $id;
                    $newz->zone_id = $zones[$i];
                    $newz->save();
                }
            }
              \Session::flash('flash_message', 'shipments method added successfully added.'); //<--FLASH MESSAGE
            
            return redirect('admin/shipments');

          } else {
            \Session::flash('flash_message', 'shipments method not complete, Try agin later '); //<--FLASH MESSAGE
           return redirect('admin/shipments');
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
             \Session::flash('flash_message', 'shipments method added successfully added.'); //<--FLASH MESSAGE
            
            return redirect('admin/shipments');

          } else {
            \Session::flash('flash_message', 'Adding shipments method not complete, Try agin later '); //<--FLASH MESSAGE
           return redirect('admin/shipments');
        }
    }


  

}
