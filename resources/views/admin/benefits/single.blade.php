@extends('admin.dashboard')
@section('content')
<div class="row">
    <div class="col s12">
        <div class="card invoices-card">
            <div class="card-content">

                <span class="card-title">Article Gallery</span>
                <table class="responsive-table bordered">
                    <thead>
                        <tr>
                            <th data-field="company">photo</th>
                            <th data-field="progress">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($row->photoes as $photo)
                        <tr>
                            <td><strong><img src="{{ asset('admin-assets/images/blog/'.$photo->photo) }}" style="height: 100px;width: 200px"></strong></td>
                            <td> {!! Form::open(['action'=>['BlogController@delphoto',$photo->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                                <button type="submit" class="btn btn-danger red waves-effect waves-light" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

 
</div>

@endsection