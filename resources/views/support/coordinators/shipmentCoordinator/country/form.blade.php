<div class="input-field col s6">
    {!!Form::text('name', null,array('class'=>'validate','id'=>'name','required' => 'required'))!!}
    <label for="name">Country Name</label>
</div>
<div class="input-field col s6">
    {!!Form::text('ar_name', null,array('class'=>'validate','id'=>'name', 'required' => 'required'))!!}
    <label for="name">Arabic Country Name</label>
</div>
<div class="input-field col s6">
    {!!Form::select('continent_id', $continents,null,array('class'=>'Select2','id'=>'continent_id' , 'required' => 'required'))!!}
     <label for="name">continent</label>
</div>
{!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
