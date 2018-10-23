@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Identication Cards
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="box-body" style="margin-left: 20px;">
							    <h1>User Identification</h1>
				              	<h4>Name:{{$user->name}}</h4>
				              	<h4>Username:{{$user->email}}</h4>
				              	<h4>Phone:{{$user->phone}}</h4>
				              	<h4>Title:{{$user->title}}</h4>
				              	<h4>Province:{{$user->province->name}}</h4>
				              	<h4>District:{{$user->district->name}}</h4>
				              	<h4>Police Station:{{$user->station->name}}</h4>
				              	<h4>
									 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">
									 Edit
									</button>
                  <button onclick="assignPassword(event)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#changepasswod">Change Password</button>

				              	</h4>
				        </div>
				    </div>
				</div>
			</div>
		</div>
		
	</div> 

<!-- Modal -->
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
        <form method="POST" id="assign" action="/users/assign/my/{{$user->id}}">
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
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
               <div >
        <div>

            <div class="register-box-body">
                <p class="login-box-msg">Update Profiles</p>

                <!-- <register-form></register-form> -->
                <form action="{{route('users.update',$user->id)}}" method="post" data-parsley-validate>
                  <input type="hidden" name="_method" value="PUT">
                  {{ csrf_field() }}
                  <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input required type="string"  data-parsley-errors-container="#vname" value="{{$user->name}}" name="name" type="text" class="form-control" placeholder="Name">
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
                  <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}}">
                    <input required   data-parsley-errors-container="#vemail" type="email" value="{{$user->email}}" name="email" type="email" class="form-control" placeholder="Email">
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
                    <input  required   data-parsley-errors-container="#vphone" value="{{$user->phone}}" name="phone" type="text" class="form-control" placeholder="Phone">
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
                    <input required type="string"   data-parsley-errors-container="#vtitle" value="{{$user->title}}" name="title" type="text" class="form-control" placeholder="Title">
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
                    @if(Auth::user()->hasAnyRole('overall-admin') and Auth::id() != $user->id)
                      <select required type="number"   data-parsley-errors-container="#vrole" class="form-control" id="role" name="role">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}"{{$role->id==$user->roles->first()->id ? "selected" : ""}}>{{$role->description}}</option>
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
                      @else
                      <input class="form-control" disabled  value="{{$user->roles->first()->description}}" name="role">
                      <input class="form-control" type="hidden" value="{{$user->roles->first()->description}}" name="role">
                       @if ($errors->has('role'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('role') }}</strong></span>
                                </span>
                              </div>
                            </div>
                      @endif
                      @endif
                    </div>
                  <div class="form-group has-feedback{{ $errors->has('province') ? ' has-error' : '' }}">
                    @if(Auth::user()->hasAnyRole('overall-admin') and Auth::id() != $user->id)
                      <select required   data-parsley-errors-container="#vprovince" class="form-control" id="province" name="province" placeholder="Province">
                        <option value="">Select Province</option>
                        @foreach($provinces as $province)
                        <option value="{{$province->id}}"{{$province->id==$user->province->id ? "selected" : ""}}>{{$province->name}}</option>
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
                       @else
                      <input class="form-control" disabled  value="{{$user->province->name}}" name="province">
                      <input class="form-control" type="hidden"  value="{{$user->province->name}}" name="province">
                       @if ($errors->has('province'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('province') }}</strong></span>
                                </span>
                              </div>
                            </div>
                      @endif
                      @endif
                    </div>
                     <div class="form-group has-feedback{{ $errors->has('district') ? ' has-error' : '' }}">
                      @if(Auth::user()->hasAnyRole('overall-admin') and Auth::id() != $user->id)
                      <select required   data-parsley-errors-container="#vdistrict" class="form-control" id="district" name="district" placeholder="District">
                        <option value="">Select District</option>
                        @foreach($user->province->districts as $district)
                        <option value="{{$district->id}}" {{$district->id==$user->district->id ? "selected":''}}>{{$district->name}}</option>
                        @endforeach
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
                      @else
                      <input class="form-control" disabled  value="{{$user->district->name}}" name="district">
                      <input class="form-control" type="hidden"  value="{{$user->district->name}}" name="district">
                       @if ($errors->has('district'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('district') }}</strong></span>
                                </span>
                              </div>
                            </div>
                      @endif
                      @endif
                    </div>
                      <div class="form-group has-feedback{{ $errors->has('station') ? ' has-error' : '' }}">
                        @if(Auth::user()->hasAnyRole('overall-admin') and Auth::id() != $user->id)
                        <select required   data-parsley-errors-container="#vstation" class="form-control" id="station" name="station">
                        <option value="">Select Station</option>
                        @foreach($user->district->stations as $station)
                        <option value="{{$station->id}}" {{$station->id==$user->station->id ? "selected":''}}>{{$station->name}}</option>
                        @endforeach
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
                      @else
                      <input class="form-control" value="{{$user->station->name}}" disabled name="station">
                      <input class="form-control" value="{{$user->station->name}}" type="hidden" name="station">
                       @if ($errors->has('station'))
                            <div class="row">
                              <div class="col-md-12 text-center">
                               <span class="invalid-feedback" role="alert">
                                   <span class="help-block"><strong>{{ $errors->first('station') }}</strong></span>
                                </span>
                              </div>
                            </div>
                      @endif
                      @endif
                    </div> 
                  <div class="row">
                    <div class="col-xs-8">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" id="btnRegister">Update</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
            </div><!-- /.form-box -->
        </div><!-- /.register-box -->
    </div>
    </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div> 
@endsection  
@section('myScript')
<script>
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
  </script>
  @endsection
