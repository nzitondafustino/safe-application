@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Sectors
@endsection


@section('main-content')
<div class="row">
			<div class="col-md-12">
				
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="box-body">
				            <div class="box-header with-border">
				              <h3 class="box-title">Sectors</h3>
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
                       <form action="{{route('sectors.import')}}" method="POST" enctype="multipart/form-data">
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
									 New Sector
									</button>
				              </div>
				            </div>
                  </div>
              </div>
				            <!-- /.box-header -->
				            <table id="sector" class="display" width="100%" cellspacing="0">
						        <thead>
						            <tr>
						                <th>ID</th>
						                <th>province</th>
						                <th>district</th>
                            <th>sector</th>
						                <th>Action</th>
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach($sectors as $sector)
						        		<tr>
						        			<td>{{$sector->id}}</td>
                        <td style="display: none">{{$sector->district->province->id}}</td>
						        			<td>{{$sector->district->province->name}}</td>
                          <td style="display: none">{{$sector->district->id}}</td>
                          <td>{{$sector->district->name}}</td>
						        			<td>{{$sector->name}}</td>
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
                   {{ $sectors->links() }}
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
                <p class="login-box-msg">New Sector</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- <register-form></register-form> -->
                <form action="{{route('sectors.store')}}" method="post" data-parsley-validate>
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
                    <label>Sector Name</label>
                    <input required type="text" name="sector" class="form-control">
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
                <form action="/sectors/" id="myform" method="post" data-parsley-validate>
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
                    <label>Sector Name</label>
                    <input required type="text" name="sector" id="sectorEdit" class="form-control">
                  </div>
   
                  <div class="row">
                    <div class="col-xs-7">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" id="btnRegister" onclick="AddActionSector()">Update</button>
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
    <script>
  var success=document.getElementById('success')
  function setSuccess()
  {
    success.style.display='none'
  } 
  setTimeout(setSuccess,5000)
   success.style.display='block'
      $(function(){
      $("#sector").dataTable();
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
        var sectorName=districttag.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML
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
        var sector=document.getElementById('sectorEdit')
        sector.value=sectorName

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
      function AddActionSector(){
        var form=document.getElementById('myform')
        form.action+=parseInt(id)
        alrt(form.action)
      }
    </script>
    @endsection