@extends('coordinators.productCoordinator.dashboard')
@section('content')
<div class="row">
    <div class="col s12">
        <div class="card invoices-card">
            <div class="card-content">

                <span class="card-title">Product overview</span>

                <table class="responsive-table bordered">

                      <tr>
                          <th data-field="id">Seller Name</th>
                          <td> {{$user->name}} </td>
                      </tr>

                      <tr>
                          <th data-field="id">Product Title</th>
                          <td> {{$row->title}} </td>
                      </tr>

                      <tr>
                          <th data-field="id">Product Title (ar)</th>
                          <td> {{$row->ar_title}} </td>
                      </tr>

                      <tr>
                          <th data-field="id">Price</th>
                          <td> {{$row->price}} </td>
                      </tr>

                      <tr>
                          <th data-field="id">Offer ?</th>
                          <td> {{$row->offer  }} </td>
                      </tr>

                      <tr>
                          <th data-field="id">Preparing Duration</th>
                          <td> {{$row->duration}} </td>
                      </tr>

                      <tr>
                          <th data-field="id">Weight</th>
                          <td> {{$row->weight}} </td>
                      </tr>

                      <tr>
                          <th data-field="id">Catalog</th>
                          <td> {{$catalog}} </td>
                      </tr>

                      <tr>
                          <th data-field="id">Block</th>
                          <td> {{$block}} </td>
                      </tr>

                      <tr>
                          <th data-field="id">Sent On</th>
                          <td> {!!  $row->created_at->diffForHumans() !!} ( {{ $row->created_at->format('j M Y , g:ia') }} ) </td>
                      </tr>

                      <tr>
                      <tr>
                         <th data-field="progress">Status</th>
                         @if($row->status == 1)
                         <td style="color:green">approved</td>
                         <form action="{{route('toggleCanceled',['id'=>$row->id])}}" method="POST" class="pull-right cancel-toggle" id="cancel-toggle">
                             {{csrf_field()}}
                             <input type="checkbox" value="0" name="toggleCanceled"  {{ $row->status==1?"checked":"" }}>
                             <input id="cancelButton" class="btn btn-danger btn-rounded btn-sm red" type="submit" value="Hold ?">

                         </form>
                       @elseif($row->status == 2)
                         <td style="color:red">Holding</td>
                         <form action="{{route('approveProduct',['id'=>$row->id])}}" method="POST" class="pull-right" id="deliver-toggle">
                             {{csrf_field()}}
                             <input type="checkbox" value="1" name="approveProduct"  {{$row->status==1?"checked":"" }}>
                             <input class="btn btn-success" type="submit" value="Re-Approve">

                         </form>
                         @else
                         <td style="color:#00BFFF">Pending</td>
                         @endif
                      </tr>

                      @if ($row->status === 0)

                      <tr>
                         <th data-field="progress">Approve This Product ?</th>
                          <td>
                            <form action="{{route('approveProduct',['id'=>$row->id])}}" method="POST" class="pull-right" id="deliver-toggle">
                                {{csrf_field()}}
                                <input type="checkbox" value="1" name="approveProduct"  {{$row->status==1?"checked":"" }}>
                                <input class="btn btn-success {{$row->status==1?"disabled":"" }}" type="submit" value="Approve">

                            </form>
                          </td>
                      </tr>


                      <tr>
                         <th data-field="progress">Hold This Product ?</th>
                          <td>
                            <form action="{{route('toggleCanceled',['id'=>$row->id])}}" method="POST" class="pull-right cancel-toggle" id="cancel-toggle">
                                {{csrf_field()}}
                                <input type="checkbox" value="1" name="toggleCanceled"  {{ $row->status==1?"checked":"" }}>
                                <input id="cancelButton" class="btn btn-danger btn-rounded btn-sm red {{$row->status==1?"disabled":""||$row->status==2?"disabled":"" }}" type="submit" value="Hold">

                            </form>
                          </td>
                      </tr>
                      @endif

                    @if ($row->status === 1)
                          <tr>
                             <th data-field="progress">Add This Product as a Catalog ?</th>
                              <td>
                                    <a href="{{ url('productCoordinator/catalogs/create') }}" target="_blank" class="btn btn-default btn-rounded btn-sm" href="#" ><span class="fa fa-plus"></span></a>
                              </td>
                          </tr>
                    @endif
                </table>

            </div>
        </div>
    </div>


</div>



<script>
    CKEDITOR.replace('blog', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
</script>


@endsection
