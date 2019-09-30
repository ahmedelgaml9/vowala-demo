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
                            <label for="title">Country Name</label>
                            {!!Form::text('name',
                            null,array('class'=>'form-control','id'=>'title','required'=>'required'))!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="title">Country Name arabic</label>

                            {!!Form::text('name_ar', null,array('class'=>'form-control','id'=>'title'))!!}
                        </div>
                    </div>

                <div class="form-group">
                 <div class="col-sm-6">
                        {!!Form::select('continent_id', $continents,null,array('class'=>'Select2','id'=>'continent_id'))!!}

                     </div>
                 </div>
        </section>
    </div>
    {!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}

</div>
</div>
</div>