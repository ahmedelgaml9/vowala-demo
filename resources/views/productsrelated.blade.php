
@foreach($products as $d)
 <div class="col-sm-4" >
<input type="checkbox"  name="relatedproduct[]" value="{{$d->id}}">{{$d->name}}
</div>

@endforeach
