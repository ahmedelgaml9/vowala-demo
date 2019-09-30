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
        <div class="col-lg-12">
            <div class="form-group">
                <span>{{trans('lang.photo')}}</span>
                 {!!Form::file('photo', null,array('id'=>'photo'))!!}
                 @if($errors->has('photo'))
            <label class="alert alert-danger nopaddinng">{{ $errors->first('photo') }}</label>
            @endif
          </div>
        </div>
    </div>
          
    <div class="row">
       <div class="col-lg-6">
         <div class="form-group">
             <label for="title">{{trans('lang.name')}}</label>
              {!!Form::text('name',null,array('class'=>'form-control','id'=>'title'))!!}
         </div>
        
        <div class="form-group">
            <label for="desc">{{trans('lang.ar_name')}}</label>
            {!!Form::text('name_ar', null,array('class'=>'form-control','id'=>'desc'))!!}
         </div>
        

        <div class="form-group">
            <label for="title">{{trans('lang.title')}}</label>
            {!! Form::text('title',null,array('class'=>'form-control','id'=>'title'))!!}
        </div>
        
        <div class="form-group">
            <label for="desc">{{trans('lang.ar_title')}}</label>
            {!!Form::text('title_ar', null,array('class'=>'form-control','id'=>'desc'))!!}
        </div>
    </div>

         <div class="form-group">
            <label for="title">{{trans('lang.link')}}</label>
            {!!Form::url('link',null,array('class'=>'form-control','id'=>'title'))!!}
        </div>
        
        <div class="form-group">
            <label for="blog">{{trans('lang.status')}}</label>
            <select name="status" class="form-control" required>
              <option value="1">{{trans('lang.active')}}</option>
              <option value="0">{{trans('lang.unactive')}}</option>
            </select>
        </div>
      </div>
     </div>

    </section>
  </div>

</div>


{!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}

</div>