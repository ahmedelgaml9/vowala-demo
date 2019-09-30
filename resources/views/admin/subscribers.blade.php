@extends('admin.dashboard')
@section('content')

             <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                               
                                </div>
                                <h2 class="panel-title">{{trans('lang.ar_description')}}</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                    <thead>
                                    <tr>
                                        <th class="text-center" data-field="id">{{trans('lang.ar_description')}}</th>
                                        <th class="text-center" data-field="company">{{trans('lang.ar_description')}}</th>
                                        <th class="text-center" data-field="progress">{{trans('lang.ar_description')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">

                                       @foreach($rows  as $row)
                                      <tr id="trow_{{ $row->id }}">
                                        <td class="text-center">{{ $row->id }}</td>
                                        <td><strong>{{ $row->email}}</strong></td>
                                        <td>
                                        
                                          
                                            {!! Form::open(['action'=>['SiteController@destroysubscribtion',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                                            <button type="submit" class="btn btn-danger btn-sm red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span> Delete</button>
                                            {!! Form::close() !!}
                                             </td>
                                           </tr>
                                             @endforeach
                                        </tbody>
                                   </table>
                               </div>
                           </section>





@endsection
