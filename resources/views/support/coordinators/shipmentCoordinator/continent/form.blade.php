<div class="input-field col s6">
    {!!Form::text('name', null,array('class'=>'validate','id'=>'name' ,'required' => 'required'))!!}
    <label for="name">Continent Name</label>
</div>
{!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
