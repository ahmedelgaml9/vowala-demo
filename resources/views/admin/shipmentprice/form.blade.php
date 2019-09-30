@if(Session::has('flash_message'))
<div class="alert alert-danger text-center"><em> {!! session('flash_message') !!}</em></div>
@endif
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"></h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title">{{trans('lang.company')}}</label>
                               <select  name="shipment_id" class="form-control">
                              <option  value="">select company</option>
                                 @foreach($shipments as $c)
                              <option  value="{{$c->id}}">{{$c->name}}</option>
                                  @endforeach
                           </select>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title">{{trans('lang.from')}}</label>
                             <select name="from" class="form-control">
                               
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                           <label for="title">{{trans('lang.to')}}</label>
                           <select  name="to" class="form-control">
                             </select>
                        </div>
                    </div>
                    
                   <div class="form-group">
                     <div class="col-md-6">
                        <label for="title">{{trans('lang.shipmentprice')}}</label>
                        {!!Form::number('value',null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
            
                   </div>
                 </div>
                
         <div class="form-group">
           <div class="col-md-6">
             <label for="title">{{trans('lang.photo_alt_ar')}}</label>
                {!!Form::number('extra',null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
          </div>
        </div>
        
        </section>
    </div>
    {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}

</div>
</div>
</div>

<script>
        
          $(document).ready(function(){
             $("Select[name='shipment_id']").change(function(){
                    
              var id= $(this).val();
              var url = "{{ url ('/admin/getzones')}}";
              var token = $("input[name='_token']").val();
              $.ajax({
                  url: url,
                  method: 'POST',
                  data: {id:id, _token:token},
                  success: function(data) {
                    $("[name='from']").html('');
                    $("[name='from']").html(data.options);
                      $("[name='to']").html('');
                    $("[name='to']").html(data.options);
                     
                  }
                });
              });
        
           });
        </script>