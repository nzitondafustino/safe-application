@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="col-sm-12">
							<div id="success">
							@if(Session::has('success'))
							<div class="alert alert-success" role="alert">
								{{Session::get('success')}}
							</div>
							@endif
						</div>
							<div class="btn-group pull-right">
			           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
									 New User
								 </button>
			                </div>
			            </div>
			        </div>
					
					<div class="box-body">
						<table id="accidents" class="display" width="100%" cellspacing="0">
					        <thead>
					            <tr>
					                <th>#</th>
					                <th>name</th>
					                <th>E-mail</th>
					                <th>Police Station</th>
					                <th>Type</th>
					                <th>perform Action</th>
					            </tr>
					        </thead>
					        <tbody>
					        	@foreach($users as $user)
					        		<tr>
					        			<td>{{$user->id}}</td>
					        			<td class="text-center">{{$user->name}}</td>
					        			<td>{{$user->email}}</td>
					        			<td class="text-center">{{$user->station->name}}</td>
					        			<td class="text-center">{{$user->roles()->first()->description}}</td>
					        			<td>
									<a class="btn btn-success btn-xs" href="{{route('users.show',$user->id)}}" style="margin-right:2px;">View</a><button onclick="assignPassword(event)" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#changepasswod">new Password</button>
                  @if(Auth::user()->id !==$user->id)
                  <button onclick="assignRole(event)" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#changerole">new Role</button>
                  @endif
                </td>
                <td class="text-center" style="display: none">{{$user->roles()->first()->id}}</td>
					        		</tr>
					        	@endforeach
					        </tbody>
					    </table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
  <div class="modal fade" id="changerole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="newrole" action="/users/assign/role/">
          {{csrf_field()}}
          <input type="hidden" name="_method" value="PUT">
      <div class="form-group">
        <label>Change Role</label>
        <select required  name="role" id="role" class="form-control">
          <option>Select Role</option>
          @foreach($roles as $role)
          <option value="{{$role->id}}">{{$role->description}}</option>
          @endforeach
        </select>
      </div>
      <div class="modal-footer">
         <div class="col-md-6">
           <button type="button" class="btn btn-secondar" style="float: left" data-dismiss="modal">Close</button> 
        </div>
        <div class="col-md-6">
          <button type="submit" class="btn btn-danger" onclick="changeRole()">Assign</button>
        </form>
        </div>
    </div>
      </div>
    </div>
  </div>
</div>
  <div class="modal fade" id="changepasswod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="assign" action="/users/assign/">
          {{csrf_field()}}
          <input type="hidden" name="_method" value="PUT">
           <div class="form-group">
        <label>New password</label>
        <input required type="password" name="password" class="form-control">
      </div>
      <div class="form-group">
        <label>Confirm password</label>
        <input required type="password" name="password_confirmation" class="form-control">
      </div>
      <div class="modal-footer">
         <div class="col-md-6">
           <button type="button" class="btn btn-secondar" style="float: left" data-dismiss="modal">Close</button> 
        </div>
        <div class="col-md-6">
          <button type="submit" class="btn btn-danger" onclick="changePasswod()">Assign</button>
        </form>
        </div>
    </div>
      </div>
    </div>
  </div>
</div>
	<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div id="app" v-cloak>
        <div>

            <div class="register-box-body">
                <p class="login-box-msg">New Officer</p>

                <!-- <register-form></register-form> -->
                <form action="{{route('users.store')}}" method="post" data-parsley-validate>
                  {{ csrf_field() }}
                  <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input required type="string"  data-parsley-errors-container="#vname" name="name" value="{{old('name')}}" type="text" class="form-control" placeholder="Name">
                    @if ($errors->has('name'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                </span>
                              </div>
                            </div>
                      @endif
                  </div>
                  <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input required   data-parsley-errors-container="#vemail" type="email" name="email" value="{{old('email')}}" type="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                </span>
                                </div>
                            </div>
                     @endif 
                  </div>
                  <div class="form-group has-feedback{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <input required   data-parsley-errors-container="#vphone" name="phone" value="{{old('phone')}}" type="text" class="form-control" placeholder="Phone">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('phone'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                </span>
                                </div>
                            </div>
                    @endif  
                  </div>
                  <div class="form-group has-feedback{{ $errors->has('title') ? ' has-error' : '' }}">
                    <input required type="string"   data-parsley-errors-container="#vtitle" name="title" type="text" value="{{old('title')}}" class="form-control" placeholder="Title">
                    @if ($errors->has('title'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                                </span>
                                </div>
                            </div>
                      @endif
                  </div>
                   <div class="form-group has-feedback{{ $errors->has('role') ? ' has-error' : '' }}">
                      <select required type="number"   data-parsley-errors-container="#vrole" class="form-control" id="role" name="role" placeholder="Province">
                        <option>Select Role</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->description}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('role'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('role') }}</strong></span>
                                </span>
                                </div>
                            </div>
                      @endif
                    </div>
                  <div class="form-group has-feedback{{ $errors->has('province') ? ' has-error' : '' }}">
                      <select required   data-parsley-errors-container="#vprovince" class="form-control" id="province" name="province" placeholder="Province">
                        <option value="">Select Province</option>
                        @foreach($provinces as $province)
                        <option value="{{$province->id}}">{{$province->name}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('province'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('province') }}</strong></span>
                                </span>
                                </div>
                            </div>
                      @endif
                    </div>
                     <div class="form-group has-feedback{{ $errors->has('district') ? ' has-error' : '' }}">
                      <select required   data-parsley-errors-container="#vdistrict" class="form-control" id="district" name="district" placeholder="District">
                        <option value="">Select District</option>
                      </select>
                      @if ($errors->has('district'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('district') }}</strong></span>
                                </span>
                              </div>
                            </div>
                      @endif
                    </div>
                      <div class="form-group has-feedback{{ $errors->has('station') ? ' has-error' : '' }}">
                      <select required   data-parsley-errors-container="#vstation" class="form-control" id="station" name="station" placeholder="Police Station">
                        <option value="">Select Police Station</option>
                      </select>
                      @if ($errors->has('station'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('station') }}</strong></span>
                                </span>
                              </div>
                            </div>
                      @endif
                    </div> 
                  <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input required    data-parsley-errors-container="#vpassword" name="password" type="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                </span>
                            </div>
                            </div>
                   @endif
                  </div>
                  <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input required   data-parsley-errors-container="#vconfirm" name="password_confirmation"  type="password" class="form-control" placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                </span>
                            </div>
                            </div>
                   @endif 
                  </div>
                  <div class="row">
                    <div class="col-xs-7">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" id="btnRegister">Register</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
            </div><!-- /.form-box -->
        </div><!-- /.register-box -->
    </div>

      </div>
    </div>
  </div>
</div>
@endsection
<script type="text/javascript">
	setTimeout(function(){
		$('#accidents').DataTable();
	},5000);
</script>
@section('myScript')
<script>
  var success=document.getElementById('success')
  function setSuccess()
  {
  	success.style.display='none'
  } 
  setTimeout(setSuccess,5000)
   success.style.display='block'
  var token='{{Session::token()}}'
  var Url
  var province=document.getElementById('province')
  var districts=document.getElementById('district')
  var districtOptions=districts.options
  function clearOption()
  {
       var child=document.createElement('option')
       var value=document.createTextNode('Select District')
       child.appendChild(value)
       districts.innerHTML=null
       districts.appendChild(child)
  }
    function clearOptionStation()
    {
         var child=document.createElement('option')
         var value=document.createTextNode('Select Police Station')
         child.appendChild(value)
         stations.innerHTML=null
         stations.appendChild(child)
    }
  function getDistricts(e)
  {
    var Index=province.value
    var value =province[Index].innerHTML
    Url='{{url('provinces')}}'+'/' + Index
    $.ajax({
      method:'GET',
      url:Url
    }).done(function(msg){
       console.log(msg.districts)
       clearOption()
       clearOptionStation()
       var districtItems=msg.districts
       for(var i in districtItems)
       { 
             var option=new Option(districtItems[i].name,districtItems[i].id)
             districtOptions.add(option,districtOptions.length)
       }
    })
  }
    var stations=document.getElementById('station')
    var stationOptions=stations.options
    function getStations(e)
    {
           var Index=districts.value
           Url='{{url('districts')}}'+'/' + Index
           $.ajax({
            method:'GET',
            url:Url
           }).
           done(function(msg){
            clearOptionStation()
            var stationItems=msg.stations
            console.log(msg.stations)
            for(var i in stationItems)
            {
            var option=new Option(stationItems[i].name,stationItems[i].id)
            stationOptions.add(option,stationOptions.length)  
            }
           })
         
    }
  province.addEventListener('change',getDistricts)
  districts.addEventListener('change',getStations)
  var userID
  function assignRole(e){
    userID=e.target.parentNode.parentNode.firstChild.innerHTML
    roleID=e.target.parentNode.parentNode.lastChild.innerHTML
    document.getElementById('role').value=roleID

  }
  function changeRole()
  {
 var assign=document.getElementById('newrole')
 assign.action +=parseInt(userID)
  }
</script>
@endsection