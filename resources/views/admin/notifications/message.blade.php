@extends('admin.dashboard')
@section('content')
<div class="row">
    <div class="col s12 m12 l12">
      <div class="card invoices-card">
          <div class="card-content">
              <span class="card-title">Seller Request Details</span>
              <table class="responsive-table bordered">

                    <tr>
                        <th>First Name :</th>
                        <td> {{ $m->f_name}} </td>
                    </tr>

                    <tr>
                        <th>Last Name:</th>
                        <td> {{ $m->l_name}} </td>
                    </tr>

                    <tr>
                        <th> Email :</th>
                        <td>{{ $m->email}} </td>
                    </tr>

                    <tr>
                        <th> Phone :</th>
                        <td> {{ $m->phone}} </td>
                    </tr>
                    <tr>
                        <th> Address  :</th>
                        <td> {!!  $m->address !!} </td>
                    </tr>

                    <tr>
                        <th> Country  :</th>
                        <td> {!!  $m->country !!} </td>
                    </tr>

                    <tr>
                        <th> Gender  :</th>
                        <td> {!!  $m->gender !!} </td>
                    </tr>

                    <tr>
                        <th> Birthdate  :</th>
                        <td> {!!  $m->birthdate !!} </td>
                    </tr>

                    <tr>
                        <th> Request Date  :</th>
                        <td> {!!  $m->created_at->diffForHumans() !!} ( {{ $m->created_at->format('j M Y , g:ia') }} )  </td>
                    </tr>



              </table>
          </div>
      </div>

  </div>
</div>

      {{-- creat sellers form --}}
      <div class="row">
          <div class="loading-sub" style="display: none;">
              <div class="progress">
                  <div class="indeterminate"></div>
              </div>
        </div>
          <div class="card">
              <div class="card-content">
                  <span class="card-title">Add Seller ?</span>
                  <div class="row">

                  {!! Form::open(array('route' =>'controll.users.store','files'=>true,'class' => 'ajax-form-request')) !!}
                  <div class="message" style="padding:26px; ">
                  </div><!-- div to display message after insert -->

                  <div class="input-field col s12">
                      <i class="material-icons prefix">email</i>
                      {{-- {!!Form::email('email', null,array('class'=>'validate','id'=>'email'))!!} --}}
                      <input type="text" name="email" value="{{ $m->email}}" class="validate" id="email">
                      <label for="email">User Email</label>
                      <label class="error">{{ $errors->first('email') }}</label>
                  </div>
                  <div class="input-field col s6">
                      <i class="material-icons prefix">account_circle</i>
                      {{-- {!!Form::text('name', null,array('class'=>'validate','id'=>'name'))!!} --}}
                      <input type="text" name="name" value="{{ $m->f_name}}" class="validate" id="name">
                      <label for="name">User First Name</label>
                  </div>
                  <div class="input-field col s6">
                      <i class="material-icons prefix">account_circle</i>
                      {{-- {!!Form::text('l_name', null,array('class'=>'validate','id'=>'l_name'))!!} --}}
                      <input type="text" name="l_name" value="{{ $m->l_name}}" class="validate" id="l_name">
                      <label for="name">User Second Name</label>
                  </div>
                  <div class="input-field col s6">
                      <i class="material-icons prefix">account_circle</i>
                      <select class="Materialize Select" name="permission" id="permission">
                          <option value="2">Seller</option>
                      </select>
                      {{-- {!!Form::select('permission',array(2=>'Seller',3=>'Support',0=>'Normal User'),null,array('class'=>'Materialize Select','id'=>'permission'))!!} --}}
                  </div>

                  <div class="input-field col s6">
                      <i class="material-icons prefix">call</i>
                      {{-- {!!Form::number('phone', null,array('class'=>'validate','id'=>'phone'))!!} --}}
                      <input type="text" name="phone" value="{{ $m->phone}}" class="validate" id="phone">
                      <label for="phone">User Phone</label>
                  </div>

                  <div class="input-field col s6">
                      <i class="material-icons prefix">lock</i>

                      {!!Form::password('password', null,array('class'=>'validate','id'=>'password'))!!}
                      <span class="glyphicon glyphicon-eye-open"></span>
                      <label for="password">Password</label>
                      <label class="error">{{ $errors->first('password') }}</label>
                  </div>
                  <div class="input-field col s6">
                      <i class="material-icons prefix">lock</i>
                      {!!Form::password('password_confirmation', null,array('class'=>'validate','id'=>'password_confirmation'))!!}
                      <label for="password_confirmation">Password Confirmation</label>
                      <label class="error">{{ $errors->first('password_confirmation') }}</label>
                  </div>
                  <div class="input-field col s6">
                      <i class="material-icons prefix">location_on</i>
                       {!!Form::select('country',$countries,null,array('class'=>'Materialize Select','id'=>'permission'))!!}
                      <label for="name">User country</label>
                  </div>
                  <div class="input-field col s6">
                      <i class="material-icons prefix">location_on</i>
                      {!!Form::text('city', null,array('class'=>'validate','id'=>'city'))!!}
                      <label for="city">User city</label>
                  </div>
                  <div class="input-field col s12">
                    <i class="material-icons prefix">location_on</i>
                    <label  for="address">User Address</label>
                      <br> <br>
                      <textarea name="address" id="address" class="validate" rows="20" cols="80"> {{ $m->address }} </textarea>

                      {{-- {!!Form::text('address', null,array('class'=>'validate','id'=>'address'))!!} --}}
                  </div>

                  <div class="input-field col s12">
                    <input type="submit" name="Add" value="Add" class="btn btn-primary text-center">
                  </div>
                  {!! Form::close() !!}

                    <div class="loading-sub" style="display: none;">
                        <div class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </div>

                </div>
          </div>
      </div>


  <script>
      CKEDITOR.replace('address', {
      customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
      });
  </script>

@endsection
