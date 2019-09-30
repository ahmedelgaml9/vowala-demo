@extends('coordinators.productCoordinator.dashboard')
@section('content')
<div class="row">
    <div class="col s12">
        <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
            <li class="tab col s3"><a href="#test1" class="">Details</a></li>
            <li class="tab col s3"><a href="#test2" class="">Photos</a></li>

        </ul>
    </div>
    <div id="test1" class="col s12">
        <div class="col s6">
            <div class="card invoices-card">
                <div class="card-content">
                    <span class="card-title">{{ $product->name }} Details</span>
                    <table class="responsive-table bordered">
                        <thead>
                            <tr>
                                <th data-field="company">Spec. Name</th>
                                <th data-field="number">Value</th>
                                <th data-field="progress">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="data">
                            @include('admin.products.items')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="test2" class="col s12">
        @foreach($product->photoes as $ph)
        <div class="col s4">
            <img src="{{ asset('admin-assets/images/products/'.$ph->photo) }}" height="150" width="100%">
            {!! Form::open(['action'=>['DetailsController@show',$ph->id],'method'=>'patch','style'=>'display:inline','class'=>'ajax-form-request']) !!}
            <div class="input-field col s12">
                {!!Form::text('photo_alt',$ph->photo_alt,array('class'=>'validate','id'=>'photo_alt'))!!}
                <label for="name">Photo Alt</label>
            </div>
            {!! Form::submit('Update',array('class'=>'btn btn-danger btn-sm')) !!}
            {!! Form::close() !!}

            {!! Form::open(['action'=>['ProductController@delgal',$ph->id],'method'=>'delete','style'=>'display:inline']) !!}
            {!! Form::submit('Delete',array('class'=>'btn btn-danger btn-sm red','onclick'=>'return confirm("Are You sure!!")')) !!}
            {!! Form::close() !!}
        </div>
        @endforeach


    </div>
</div>
@stop
