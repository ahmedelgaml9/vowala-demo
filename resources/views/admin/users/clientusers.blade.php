@extends('admin.dashboard')
@section('content')
@if(Session::has('flash_message'))
        <div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
    @endif
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                        <div class="fixed-action-btn">
                                            <a class="btn-floating btn-large red"  href="{{ url('admin/users/create')}}">
                                                <i class="btn btn-success fa fa-plus-square-o" > Add New</i>
                                            </a>
                                        </div>
                                </div>
                               <h2 class="panel-title">users</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                    <thead>
                                        <tr>
                                            <th class="text-center" data-field="id">ID</th>
                                            <th class="text-center" data-field="company"> Name</th>
                                            <th class="text-center" data-field="company">Email</th>
                                            <th class="text-center" data-field="company">date</th>
                                            <th class="text-center" data-field="progress">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($users  as $row)
                                      <tr id="trow_{{ $row->id }}">
                                        <td class="text-center">{{ $row->id }}</td>
                                        <td class="text-center"><strong>{{  $row->name }}</strong></td>
                                        <td class="text-center"><strong>{{  $row->email }}</strong></td>
                                        <td class="text-center">{{ date('d ,M Y',strtotime($row->created_at)) }}</td>
                                    
                                        <td class="text-center">
                                            @if($row->id != 1 || Auth::user()->id == 1)
                                            <a class="btn btn-sm btn-primary  edit" href="{{ url('admin/users/'.$row->id.'/edit') }}" ><span class="fa fa-pencil"> Edit</span></a>
                                            @if($row->id != 1 )
                                            {!! Form::open(['action'=>['UsersController@destroy',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                                            <button type="submit" class="btn btn-danger red " onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"> Delete</span></button>
                                            {!! Form::close() !!}
                                            @endif        
                                            @endif
                                        </td>
                                    </tr>
                                       @endforeach
                                        
                                    </tbody>
                                </table>
                                   {!! $users->render() !!}

                            </div>
                        </section>

@endsection