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
                                        <th data-field="id">{{trans('lang.ar_description')}}</th>
                                        <th data-field="company">{{trans('lang.ar_description')}}</th>
                                        <th data-field="company">{{trans('lang.ar_description')}}</th>
                                        <th data-field="company">{{trans('lang.ar_description')}}</th>
                                        <th data-field="progress">{{trans('lang.ar_description')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">

                                   @foreach($rows  as $row)
                                    <tr id="trow_{{ $row->id }}">
                                        <td class="text-center">{{ $row->id }}</td>
                                        <td><strong>{{  substr($row->name,0,100) }}</strong></td>
                                        <td><strong>{{ $row->message }}</strong></td>
                                        <td><strong>{{ $row->email}}</strong></td>
                                        <td>
                                        
                                          
                                            {!! Form::open(['action'=>['SiteController@destroycontacts',$row->id],'method'=>'delete' ,'style'=>'display: inline']) !!}
                                            <button type="submit" class="btn btn-danger red" onclick='return confirm("Are You sure!!")' ><span class="fa fa-times"></span></button>
                                            {!! Form::close() !!}
                                             </td>
                                           </tr>
                                             @endforeach
                                        </tbody>
                                   </table>
                               </div>
                           </section>





@endsection
