@extends('seller.dashboard')
@section('content')

<div class="row">
	<a class="btn-floating btn-large red" href="{{ url('seller/catalog/create/'.$product->id)}}"  style="float:right;">
           <i class="btn btn-success">Add</i>
       </a>
</div>
       
<div class="row">
<div class="col-md-6">
 <section class="panel">
     	<header class="panel-heading">
		 <h2 class="panel-title">Sliders</h2>
     </header>
  <div class="panel-body">
      <img src="{{ asset('admin-assets/images/products/'.$product->photo) }}" alt="" style="width:100%; height:300px;">
</div>
     
</section>

</div>
    
<div class="col-md-6">

                	           <section class="panel">
							    	<header class="panel-heading">
								
								    <h2 class="panel-title">Sliders</h2>
							     	</header>
							   	<div class="panel-body">
									<div class="owl-carousel owl-theme" data-plugin-carousel data-plugin-options='{ "dots": true, "autoplay": true, "autoplayTimeout": 3000, "loop": true, "margin": 10, "nav": false, "items": 1 }'>
									       @foreach($product->photoes as $ph)
										<div class="item"><img class="img-thumbnail" src="{{ asset('admin-assets/images/products/'.$ph->photo) }}"  style="height:300px; width:100%;" alt=""></div>
									     @endforeach

									  </div>
							     	</div>
						    	</section>
							   </div>   
							</div>
							


<section class="panel">
    <header class="panel-heading">
        Product Description
   </header>

    <div class="panel-body">
          {!! $product->desc !!}
         {!! $product->desc_ar !!}
    </div>
    
</section>
      
<section class="panel">
    <header class="panel-heading">
        
     </header>
    <div class="panel-body">
           About  {{ $product->name }}
         <div class="panel-body">
        <table class="striped">
            <tbody>
                @foreach($product->Specs  as $row)
                <tr>
                    <td>{{ $row->spec }}({{ $row->spec_ar }})</td>
                    <td>{{ $row->value }}({{ $row->value_ar }})</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
</section>


@stop
