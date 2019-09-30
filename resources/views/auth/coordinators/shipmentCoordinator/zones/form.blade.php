<div class="input-field col s12">
    {!!Form::text('name', null,array('class'=>'validate','id'=>'name', 'required' => 'required'))!!}
    <label for="name">Zone Name</label>
    <label class="error">{{ $errors->first('name') }}</label>

</div>
<label for="name">Zone  Country</label>
<label class="error">{{ $errors->first('countries') }}</label>

         @foreach($continents as $continent)

    <p class="p-v-xs">
        <input   value="{{$continent->id}}" name="continent" type="radio" id="cont{{$continent->id}}" class="cc"
        @if(isset($zone) && $continent->id == $zone->zoneInfo->country->Cont->id)
            {{'checked'}}
        @endif

        >

        <label for="cont{{$continent->id}}">{{ $continent->name }}</label> 
    </p>
             @foreach($continent->countries as $country)
        <p class="p-v-xs" style="padding-left: 30px;">
            <input type="radio" id="coun{{$country->id}}" required ="required" class="cont{{$continent->id}}" name="country" value="{{ $country->id }}"
            @if(isset($zone) && $country->id == $zone->zoneInfo->country->id)
                    {{'checked'}}
            @endif
        >
            <label for="coun{{$country->id}}">{{ $country->name }}</label>
        </p>
    @endforeach
@endforeach

{!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
