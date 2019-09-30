@extends('admin.dashboard')
@section('content')
  <header class="page-header">
						<h2>{{trans('lang.users')}}</h2>
						  <div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>{{trans('lang.users')}}</span></li>
							</ol>

							<a class="sidebar-right-toggle"></a>
						</div>
					</header>

                        @if(Session::has('flash_message'))
                             <div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
                         @endif
                        <section class="panel">
                               <header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
								</div>

								<h2 class="panel-title">{{trans('lang.users')}}</h2>
							</header>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="mb-md">
											<a href="{{ url('admin/users/create')}}"><button id="addToTable" class="btn btn-primary">{{trans('lang.add')}}<i class="fa fa-plus"></i></button></a>
										</div>
									</div>
								</div>
								<table class="table table-bordered table-striped mb-none" id="datatable-editable">
                                    <thead>
                                        <tr>
                                            <th data-field="id"></th>
                                            <th data-field="company"> {{trans('lang.name')}}</th>
                                            <th data-field="company">{{trans('lang.email')}}</th>
                                            <th data-field="progress">Action</th>
                                        </tr>
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