@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Stations
@endsection


@section('main-content')
<div class="row">
			<div class="col-md-12">
				
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="box-body">
				            <div class="box-header with-border">
                      <h3 class="box-title">Stations</h3>
                            <div class="row">
                        <div class="col-md-12">
                        <div id="success">
                        @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                          {{Session::get('success')}}
                        </div>
                        @endif
                      </div>
                        </div>
                        <div class="col-md-6">
                       <form action="{{route('stations.import')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                        <input type="file" name="file" class="form-control">
                        @if ($errors->has('file'))
                        <div class="row">
                              <div class="col-md-12 text-center has-error">
                                      <span class="invalid-feedback" role="alert">
                                         <span class="help-block"><strong>{{ $errors->first('file') }}</strong></span>
                                      </span>
                                  </div>
                                  </div>
                          @endif
                        </div>
                        <div class="form-group">
                        <input type="submit" value="Upload" class="btn btn-success">
                      </div>
                      </form>
                    </div>
                    <div class="col-md-6">
                      <div class="btn-group pull-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                   New Station
                  </button>
                      </div>
                    </div>
                  </div>
				            </div>
				            <!-- /.box-header -->
				            <table id="station" class="display" width="100%" cellspacing="0">
						        <thead>
						            <tr>
						                <th>ID</th>
						                <th>province</th>
						                <th>district</th>
                            <th>station</th>
						                <th>Action</th>
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach($stations as $station)
						        		<tr>
						        			<td>{{$station->id}}</td>
                        <td style="display: none">{{$station->district->province->id}}</td>
						        			<td>{{$station->district->province->name}}</td>
                          <td style="display: none">{{$station->district->id}}</td>
                          <td>{{$station->district->name}}</td>
						        			<td>{{$station->name}}</td>
						        			<td>
                            <button onclick="searchDistrict(event)" type="button" class="btn btn-success" data-toggle="modal" data-target="#edit" class="edit">
											        Edit
											      </button>
										    </td>
						        		</tr>
						        	@endforeach
						        </tbody>
					        </table>
                  <div class="row">
                    <div class="col-md-12 text-center">
                   {{ $stations->links() }}
                 </div>
                 </div>
			            </div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div id="app" v-cloak>
        <div>

            <div class="register-box-body">
                <p class="login-box-msg">New Station</p>
                <!-- <register-form></register-form> -->
                <form action="{{route('stations.store')}}" method="post" data-parsley-validate>
                  {{ csrf_field() }}
                  <div class="form-group">
                  	<label>Province Name</label>
                  	<select required name="province" id="province" class="form-control">
                  		<option>Select Province</option>
                  		@foreach($provinces as $province)
                  		<option value="{{$province->id}}">{{$province->name}}</option>
                  		@endforeach
                  	</select>
                  </div>
                  <div class="form-group">
                  	<label>District Name</label>
                  	<select required name="district" id="district" class="form-control">
                      <option>Select District</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Station Name</label>
                    <input required  type="text" name="station" class="form-control">
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
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div id="app" v-cloak>
        <div>

            <div class="register-box-body">
                <p class="login-box-msg">Edit Sector</p>
                 
                <!-- <register-form></register-form> -->
                <form action="/stations/" id="myform" method="post" data-parsley-validate>
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value='PUT'>
                  <div class="form-group">
                    <label>Provinve Name</label>
                    <select required name="province" id="provinceEdit" class="form-control">
                      <option>Select Province</option>
                      @foreach($provinces as $province)
                      <option value="{{$province->id}}">{{$province->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>District Name</label>
                    <select required name="district" id="districtEdit" class="form-control">
                      <option>Select District</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Station Name</label>
                    <input required type="text" name="station" id="stationEdit" class="form-control">
                  </div>
   
                  <div class="row">
                    <div class="col-xs-7">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" id="btnRegister" onclick="AddActionStation()">Update</button>
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
    @section('myScript')
      <script type="text/javascript">
        var success=document.getElementById('success')
        function setSuccess()
        {
          success.style.display='none'
        } 
        setTimeout(setSuccess,5000)
         success.style.display='block'
    $(function(){
      $("#station").dataTable();
    })
      var id
      function searchDistrict(e)
      {
        var tr=e.target.parentNode.parentNode
        var idtag=tr.firstChild
        id=tr.firstChild.innerHTML
        var provincetag=idtag.nextSibling.nextSibling
        var provinceId=provincetag.innerHTML
        clearOptionEdit()
        var districttag=provincetag.nextSibling.nextSibling.nextSibling.nextSibling
        var districtId=districttag.innerHTML
        var districtName=districttag.nextSibling.nextSibling.innerHTML
        var stationName=districttag.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML
        var province=document.getElementById('provinceEdit')
        province.value=provinceId
        var district=document.getElementById('districtEdit')
         $.ajax({
          method:'GET',
          url:'/provinces/'+ parseInt(provinceId)
        }).done(function(msg){
         console.log(msg.districts)
         var districtOpts=msg.districts
           for(var i in districtOpts)
         { 
               var option=new Option(districtOpts[i].name,districtOpts[i].id)
               districtOptionsEdit.add(option,districtOptions.length)
         }
         district.value=districtId
        })
        var station=document.getElementById('stationEdit')
        station.value=stationName

      }   
  var province=document.getElementById('province')
  var districts=document.getElementById('district')
  var districtOptions=districts.options
  var provinceEdit=document.getElementById('provinceEdit')
  var districtsEdit=document.getElementById('districtEdit')
  var districtOptionsEdit=districtsEdit.options
   function clearOptionEdit()
  {
       var child=document.createElement('option')
       var value=document.createTextNode('Select District')
       child.appendChild(value)
       districtsEdit.innerHTML=null
       districtsEdit.appendChild(child)
  }
  function getDistrictsEdit(e)
  {
    var Index=provinceEdit.value
    var value =provinceEdit[Index].innerHTML
    Url='{{url('provinces')}}'+'/' + Index
    $.ajax({
      method:'GET',
      url:Url
    }).done(function(msg){
       console.log(msg.districts)
       clearOptionEdit()
       var districtItems=msg.districts
       for(var i in districtItems)
       { 
             var option=new Option(districtItems[i].name,districtItems[i].id)
             districtOptionsEdit.add(option,districtOptions.length)
       }
    })
  }
  function clearOption()
  {
       var child=document.createElement('option')
       var value=document.createTextNode('Select District')
       child.appendChild(value)
       districts.innerHTML=null
       districts.appendChild(child)
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
       var districtItems=msg.districts
       for(var i in districtItems)
       { 
             var option=new Option(districtItems[i].name,districtItems[i].id)
             districtOptions.add(option,districtOptions.length)
       }
    })
  }
     province.addEventListener('change',getDistricts)
     provinceEdit.addEventListener('change',getDistrictsEdit)
      function AddActionStation(){
        var form=document.getElementById('myform')
        form.action+=parseInt(id)
      }
    </script>
    @endsection