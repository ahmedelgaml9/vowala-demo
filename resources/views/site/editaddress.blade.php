@extends('site.template.index')
@section('content')

<?php

$data= App\Main::find(1);
$lang =$data->setlang;
$countries= App\Country::all();
$shipments= App\Shipment::all();
$cities= App\Zone::all();
$areas= App\Area::all();
$sh_addresses= App\Shipmentaddress::where('user_id',auth()->user()->id)->get();

?>
         <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div><!-- End .container-fluid -->
            </nav>
             @if (Session::has('message'))
          <div  class=" alert alert-success" style="font-size: 18px;">
               <strong>Done!</strong>  Edit Address done successful
          </div>
              @endif
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-9 order-lg-last dashboard-content">
                           <h2>Edit Address</h2>
                            {!! Form:: model($address,array('method' => 'PUT','action' => ['SiteController@editaddress',$address->id], 'files'=>true,'class' => 'ajax-form-request')) !!}
     
                            <div class="form-group required-field"  style="display:none;">
                                <label> </label>
                                <input type="hidden" class="form-control form-control-sm"    name="user_id" required>
                            </div>
                           
                               <div class="form-group required-field">
                                      <label>Title</label>
                                   <input type="text" class="form-control"   name="title"  required>
                                </div>
            
                            <div class="form-group required-field">
                                <label>Street Address </label>
                                <input type="text" class="form-control form-control-sm"    value="{{$address->street_name}}" name="street_name"  required>
                            </div>


                               <div class="form-group required-field">
                                  <label>Building number </label>
                                   <input type="text" class="form-control form-control-sm"  value="{{$address->building_number}}"   name="building_number"  required>
                              </div>

                            <div class="form-group required-field">
                                <label>Floor number </label>
                                <input type="text" class="form-control form-control-sm"   value="{{$address->floor_number}}"   name="floor_number"  required>
                            </div>
                              
                           <div class="form-group required-field">
                                <label> flat number </label>
                                <input type="text" class="form-control form-control-sm"     value="{{$address->flat_num}}"     name="flat_num"  required>
                             </div>
                             
                            <div class="form-group required-field">
                                <label>City  </label>
                                  <select class="form-control"   name="city">
                                     @foreach($cities as $city  )
                                       <option value="{{$city->name}}">{{$city->name}}</option>
                                      @endforeach
                                 </select>
                               </div>


                           <div class="form-group">
                                <label>Area</label>
                                <div class="select-custom">
                                  <select class="form-control"  name="area">
                                      @foreach($areas as $area )
                                       <option value="{{$area->name}}">{{$area->name}}</option>
                                      @endforeach
                                 </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Country</label>
                                <div class="select-custom">
                                  <select class="form-control"  name="country">
                                      @foreach($countries as $country  )
                                       <option value="{{$country->name}}">{{$country->name}}</option>
                                      @endforeach
                                 </select>
                                </div>
                            </div>
                                <div class="form-group required-field">
                                        <label>Zip/Postal Code </label>
                                        <input type="text" class="form-control"   name="code"  required>
                                    </div>
                                   
                            <div class="form-footer-right">
                                 <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div><!-- End .form-footer -->
                    </form>
                </div><!-- End .col-lg-9 -->

                  
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-5"></div><!-- margin -->
        </main><!-- End .main -->

@endsection
