
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
                    <div class="btn teal lighten-1">
                        <span>Main Photo</span>
                        {!!Form::file('photo', null,array('id'=>'image'))!!}
                    </div>
                  
                </div>
                </div>
                <div class="form-group">

                <div class="col-sm-6">
                    <div class="btn teal lighten-1">
                        <span>Unit Photoes</span>
                        <input type="file" name="gallary[]" multiple>
                    </div>
                    
                </div>
                </div>
                <div class="form-group">
                <div class="col-sm-6">
                <label for="title">Unit Name</label>

              {!!Form::text('name', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                </div>
                </div>
                
                
                <div class="form-group">
                <div class="col-sm-6">
                  <label for="title">Unit Name arabic</label>

                    {!!Form::text('name_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>
                <div class="form-group">

                <div class="col-sm-6">
                <label for="title">Unit Custom url</label>

                    {!!Form::text('custom_url', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                </div>
                </div>

                <div class="form-group">
                <div class="col-sm-6">
                     <label for="blog">locations</label>

                    {!!Form::select('location_id', $locations,null,array('class'=>'form-control','id'=>'cat_id'))!!}
                </div>
                </div>
                <div class="form-group">
                <div class="col-sm-6">
                    <label for="blog">projects</label>
                      <select name="project_id" id=""  class="form-control" required>
                    
                     </select>
                </div>
                </div>
                <div class="form-group">

                <div class="col-sm-6">
                    
                 <label for="blog">categories</label>
                <select name="cat_id" id=""  class="form-control" required>
     
                      </select>
                </div>
                </div>
                <div class="form-group">
                <div class="col-sm-6">
                    <label for="blog">Unit Address</label>
                    {!!Form::text('address', null,array('class'=>'form-control','id'=>'address','required'=>'required'))!!}
                </div>
                </div>

         
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="blog">Unit Address arabic</label>
                    {!!Form::text('address_ar', null,array('class'=>'form-control','id'=>'address_ar'))!!}
                    
                </div>
                </div>

              <div class="form-group">
                <div class="col-sm-6">
                    <label for="blog">Unit Description</label>
                    {!!Form::textarea('desc', null,array('class'=>'form-control','id'=>'desc'))!!}
                       @ckeditor('desc')
                </div>
                </div>
                <div class="form-group">

                <div class="col-sm-6">
                    <label for="blog">Unit Description arabic</label>
                    {!!Form::textarea('desc_ar', null,array('class'=>'form-control','id'=>'desc_ar'))!!}
                       @ckeditor('desc_ar')
                    <label class="error">{{ $errors->first('desc') }}</label>
                </div>

                 </div>
                 <div class="form-group">
                <div class="col-sm-6">
                    <label for="blog">Unit Description 2</label>
                    {!!Form::textarea('desc2', null,array('class'=>'form-control','id'=>'desc2'))!!}
                        @ckeditor('desc2')
                </div>
            </div>
         <div class="form-group">
              <div class="col-sm-6">
                <label for="blog">Unit Description 2 Arabic</label>

              {!!Form::textarea('desc2_ar', null,array('class'=>'form-control','id'=>'desc2_ar'))!!}
                 @ckeditor('desc2_ar')
                </div>
                </div>

         <div class="form-group">
                <div class="col-sm-6">

                <label for="title">Unit Price</label>

             {!!Form::text('price', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
            </div>
         </div>
         
          <div class="form-group">
                <div class="col-sm-6">
                <label for="title">Unit  min  Price</label>
             {!!Form::text('minprice', null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
            </div>
         </div>
         
         
         
        <div class="form-group">
                <div class="col-sm-6">
                <label for="title">Unit Neighboor</label>
             {!!Form::text('nighboor', null,array('class'=>'form-control','id'=>'title'))!!}
            </div>
         </div>
         
          <div class="form-group">
                <div class="col-sm-6">
                <label for="title">Unit listing id</label>
             {!!Form::text('listing_id', null,array('class'=>'form-control','id'=>'title'))!!}
            </div>
         </div>
         
            <div class="form-group">
                <div class="col-sm-6">
                <label for="title">Unit Area</label>

                    {!!Form::text('area', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>

            <div class="form-group">

                <div class="col-sm-6">
                <label for="title">Unit Area arabic</label>
                    {!!Form::text('area_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                     </div>


          <div class="form-group">
                <div class="col-sm-6">
                    <label for="title">Unit bedrooms</label>

                    {!!Form::number('bedrooms', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>

          <div class="form-group">
                <div class="col-sm-6">

                  <label for="title">garages</label>

                    {!!Form::number('garages', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>
                <div class="form-group">

                <div class="col-sm-6">
                <label for="title">Unit bathrooms</label>


                    {!!Form::number('bathrooms', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>

                <div class="form-group">
                <div class="col-sm-6">
                <label for="title">Unit Reference</label>

                    {!!Form::text('reference',null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>
                <div class="form-group">

                <div class="col-sm-6">
                <label for="title">size</label>

                    {!!Form::number('size', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>
                <div class="form-group">


                <div class="col-sm-6">
                <label for="title">Unit Map</label>

                    {!!Form::text('map', null,array('class'=>'form-control','id'=>'title'))!!}
                </div>
                </div>
                <div class="form-group">
                <div class="col-sm-6">
                    <input type="checkbox" name="sidebar" value="1"   {{  $row->sidebr == '1'? 'checked' : '' }}>
                    <label for="unit"> sidebar
                    </label>
                    <br>
                </div>
                </div>
                <div class="col-sm-6">
                    <input type="radio" name="property" value="1" {{ $row->property == '1'? 'checked' : '' }} >
                    <label> for sale
                    </label>
                    <br>
                </div>
          
                <div class="col-sm-6">
                    <input type="radio" name="property" value="2" {{  $row->property == '2'? 'checked' : '' }}>
                    <label > for rent
                    </label>
                    <br>
                </div>
             <div class="col-sm-6">
                    <input type="radio" name="type" value="1" {{ $row->type == '1'? 'checked' : '' }}>
                    <label> Primary
                    </label>
                    <br>
                </div>
          
                <div class="col-sm-6">
                    <input type="radio" name="type" value="2"{{ $row->property == '2'? 'checked' : '' }}>
                    <label > Resale
                    </label>
                    <br>
                </div>
           
           <br>
          <div class="col-md-12">
             <section class="panel">
             <header class="panel-heading">
                                                            
            <h2 class="panel-title">Unit Amenties</h2>
                  </header>
         <div class="panel-body">

                @foreach($ouramenties as $unit)
                <div class="col-sm-6">
                    <input type="checkbox" name="myunits[]" value="{{$unit->name}}" id="{{$unit->id}}">
                    <label for="{{$unit->id}}"> {{$unit->name}}
                    </label>
                    <br>
                </div>
                @endforeach
                </div>
                     </div>
                     </section>
                       </div>
             {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
            </div>
        </div>
        </section>
    </div>
 <script>

$(document).ready(function(){

     $("select[name='location_id']").change(function(){
             
       var id= $(this).val();
       var url = "{{ url ('getprojects')}}";

       var token = $("input[name='_token']").val();
       $.ajax({
           url: url,
           method: 'POST',
           data: {id:id, _token:token},
           success: function(data) {
             $("select[name='project_id']").html('');
             $("select[name='project_id']").html(data.options);
           }
       });
   });
 
  });
 </script>
 
 <script>

$(document).ready(function(){

     $("select[name='project_id']").change(function(){
             
       var id= $(this).val();
       var url = "{{ url ('getcats')}}";

       var token = $("input[name='_token']").val();
       $.ajax({
           url: url,
           method: 'POST',
           data: {id:id, _token:token},
           success: function(data) {
             $("select[name='cat_id']").html('');
             $("select[name='cat_id']").html(data.options);
           }
       });
   });
 
  });
 </script>
