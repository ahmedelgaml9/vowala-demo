@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif

<?php

$data= App\Main::find(1);
$lang =$data->setlang;
$countries= App\Country::all();
$shipments= App\Shipment::all();
$cities= App\Zone::all();
$areas= App\Area::all();
$sh_addresses= App\Shipmentaddress::where('user_id',auth()->user()->id)->get();

?>

<style>

    .shipping-address-box{
        border-color:skyblue;
        width:30% ;
    }
    
    
</style>
         <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}"></a>{{ trans('lang.home')}} </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.dashboard')}}</li>
                    </ol>
                </div>
            </nav>
 
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-9 order-lg-last dashboard-content">
                         <a href="#" class="btn btn-sm btn-outline-secondary btn-new-address" data-toggle="modal" data-target="#addressModal">+ {{ trans('lang.newaddress')}}</a>

                       <div class="row" >
                         @foreach($sh_addresses  as $s)
                         <div class="shipping-address-box ">
                               <br>
                                             {{$s->street_name}} 
                                             {{$s->building_number}}  
                                             {{$s->floor_number}}
                                             {{$s->flat_num}} 
                                            <br>
                                               {{$s->city}}   
                                             <br>
                                               {{$s->country}}  
                                             <br>
                                                   <div class="address-box-action clearfix">
                                                    <a href="{{url('editaddress/'.$s->id)}}" class="btn btn-sm btn-link">
                                                       {{ trans('lang.edit')}} 
                                                    </a>
                                                 </div>
                                            </div>
                                              @endforeach
                                           </div>
                                         </div>

                            <aside class="sidebar col-lg-3">
                              <div class="widget widget-dashboard">
                                  <h3 class="widget-title">{{ trans('lang.account')}}</h3>
    
                                    <ul class="list">
                                        <li><a href="{{url('profile')}}">{{ trans('lang.account')}}</a></li>
                                        <li><a href="{{url('mywishlist')}}">{{ trans('lang.wishlist')}} </a></li>
                                        <li><a href="{{url('myorders')}}">{{ trans('lang.myorders')}} </a></li>
                                        <li><a href="{{url('addressbook')}}">{{ trans('lang.addressbook')}} </a></li>
                                        </ul>
                                  </div>
                             </aside>
                           <form   action="{{route('submitaddress')}}" method="POST">
                               @csrf
                        <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <form action="#">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="addressModalLabel">{{ trans('lang.shippingaddress')}}</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                   </div>
                
                                    @if (Session::has('message'))
                                  <div  class=" alert alert-success" style="font-size: 18px;">
                                       <strong>Done!</strong> 
                                  </div>
                                   @endif
                            <div class="modal-body">
                              <div class="form-group required-field"  style="display:none;">
                                   <input type="hidden" class="form-control form-control-sm"    name="user_id" required>
                               </div>
                              <div class="form-group required-field">
                                  <label>{{ trans('lang.title')}}</label>
                                  <input type="text" class="form-control"   name="title"  required>
                              </div>
                            <div class="form-group required-field">
                                <label>{{ trans('lang.streetnumber')}} </label>
                                <input type="text" class="form-control form-control-sm"  name="street_name"  required>
                            </div>


                               <div class="form-group required-field">
                                  <label>{{ trans('lang.buildingnumber')}}  </label>
                                   <input type="text" class="form-control form-control-sm"  name="building_number"  required>
                              </div>

                            <div class="form-group required-field">
                                <label>{{ trans('lang.floornumber')}}  </label>
                                <input type="text" class="form-control form-control-sm"  name="floor_number"  required>
                            </div>

                           <div class="form-group required-field">
                                <label> {{ trans('lang.flatnumber')}} </label>
                                <input type="text" class="form-control form-control-sm"  name="flat_num"  required>
                             </div>
  
                            <div class="form-group required-field">
                              <label>{{ trans('lang.code')}} </label>
                                <input type="text" class="form-control"   name="code"  required>
                           </div>
             
                            <div class="form-group required-field">
                                <label>{{ trans('lang.city')}}  </label>
                                  <select class="form-control"   name="city">
                                     @foreach($cities as $city  )
                                       <option value="{{$city->name}}">{{$city->name}}</option>
                                      @endforeach
                                 </select>
                               </div>

                            <div class="form-group">
                                <label>{{ trans('lang.area')}}</label>
                                <div class="select-custom">
                                  <select class="form-control"  name="area">
                                      @foreach($areas as $area )
                                       <option value="{{$area->name}}">{{$area->name}}</option>
                                      @endforeach
                                 </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('lang.country')}}</label>
                                <div class="select-custom">
                                  <select class="form-control"  name="country">
                                      @foreach($countries as $country  )
                                       <option value="{{$country->name}}">{{$country->name}}</option>
                                      @endforeach
                                 </select>
                                </div>
                              </div>
                              
                              </div>
                             </form>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-link btn-sm" data-dismiss="modal">{{ trans('lang.cancel')}}</button>
                        <button type="submit" class="btn btn-primary btn-sm">{{ trans('lang.save')}}</button>
                    </div><!-- End .modal-footer -->
                </form>
                    
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-5"></div><!-- margin -->
        </main><!-- End .main -->


@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif