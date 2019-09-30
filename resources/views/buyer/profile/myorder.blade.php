@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif
         <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}">{{ trans('lang.home')}} </a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('lang.dashboard')}}</li>
                    </ol>
                </div>
            </nav>
                 
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-9 order-lg-last dashboard-content">
                           @if(count($orders)>0)
                           <table class="table table-order">
                              <thead>
                               <tr>
                                 <th>{{ trans('lang.date')}}</th>
                                <th>{{ trans('lang.total')}}</th>
                                <th>{{ trans('lang.status')}}</th>
                                <th>{{ trans('lang.deliverydate')}}</th>
                                <th>{{ trans('lang.city')}}</th>
                                <th>{{ trans('lang.streetnumber')}} </th>
                                <th>{{ trans('lang.actions')}}</th>
                                  </tr>
                                  </thead>
                                 <tbody>
                                  <tr>
                                      @foreach($orders as $o) 
                                    </td>
                                    <td>{{ $o->created_at }}
                                    </td>
                                    <td>${{ $o->total_price }}</td>
                                    <td> @if($o->status== 0)
                                                      still not conformed
                                                    @elseif($o->status==1)
                                                         conformed
                                                    @elseif($o->status==2)
                                                         shipped  
                                                    @elseif($o->status==3)
                                                         delivered   
                                                    @elseif($o->status == 4)
                                                    
                                                    returned     
                                                  
                                                        @elseif($o->status ==5)
                                                        cancelled </td>
                                                    
                                      
                                                     @endif
                                      <td>{{ $o->deliver_date }}</td>
                                      <td>{{ $o->city}}</td>
                                      <td>{{ $o->street_name}}</td>
                                      <td><a href="{{ url('order').'/'.$o->id }}">{{trans('lang.view')}}</a></td> 
                                      </tr>
                                         @endforeach
                                 </tbody>
                              </table>
                             @endif
                         </div>

                    <aside class="sidebar col-lg-3">
                        <div class="widget widget-dashboard">
                            <h3 class="widget-title">{{ trans('lang.account')}}</h3>
                            <ul class="list">
                                <li><a href="{{url('profile')}}">{{ trans('lang.profile')}}</a></li>
                                <li><a href="{{url('mywishlist')}}">{{ trans('lang.wlist')}}</a></li>
                                <li><a href="{{url('myorders')}}">{{ trans('lang.myorders')}}</a></li>
                                <li><a href="{{url('addressbook')}}">{{ trans('lang.addressbook')}}</a></li>
                            </ul>
                        </div><!-- End .widget -->
                    </aside><!-- End .col-lg-3 -->
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