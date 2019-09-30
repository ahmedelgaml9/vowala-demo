<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CurrencyRequest;
use App\ShipmentPrice;
use App\Shipment;
use App\Shipmentzone;
use App;

class ShipmentpricesController extends Controller {

    public function __construct(Request $request, ShipmentPrice $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/shipmentprice/';
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
            $rows= $this->model->where('name', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
           $rows->setPath('countries');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('c', 'sections'))->render());
        }
        return View($this->view . 'index', compact('c', 'rows'));
    }

   
    public function create() {
        
         $shipments =Shipment::all();
      
       return View($this->view . 'create', compact('shipments','row'));
 
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @return Response
     */
    public function store() {
        $insert = $this->model->create($this->request->all());
        if ($insert) {
              \Session::flash('flash_message', 'shipments prices added successfully ');
            
            return redirect('admin/shipmentprices');

          } else {
              
            \Session::flash('flash_message', 'Adding shipments prices  not complete, Try agin later ');
            
           return redirect('admin/shipmentprices');
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
       
           $shipments =Shipment::all();
           $row = $this->model->where('id', $id)->first();
        return View($this->view . 'edit', compact('shipments','row'));
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
              \Session::flash('flash_message', 'shipments prices  updated successfully'); //<--FLASH MESSAGE
            
            return redirect('admin/shipmentprices');

          } else {
            \Session::flash('flash_message', 'Adding shipments pricesnot complete, Try agin later '); //<--FLASH MESSAGE
           return redirect('admin/shipmentprices');
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
               \Session::flash('flash_message', 'shipments prices  destroyed successfully '); //<--FLASH MESSAGE
            
            return redirect('admin/shipmentprices');

          } else {
            \Session::flash('flash_message', 'destroyed shipments prices not complete, Try agin later '); //<--FLASH MESSAGE
           return redirect('admin/shipmentprices');
        }
    }
    
    
        public  function  getzones(Request $request){

          $zones = Shipmentzone::where('shipment_id',$request->id)->get();

           $data = view('shipmentszones',compact('zones'))->render();
        
              return response()->json(['options'=>$data]);
        }
 
    

}
