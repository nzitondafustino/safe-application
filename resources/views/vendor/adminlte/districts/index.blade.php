@extends('adminlte::layouts.app')

@section('htmlheader_title')
	District
@endsection


@section('main-content')
<div class="row">
			<div class="col-md-12">
				
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="box-body">
				            <div class="box-header with-border">
				              <h3 class="box-title">Districts</h3>
				              <div class="btn-group pull-right">
				                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
									 New Districts
									</button>
				              </div>
				            </div>
				            <!-- /.box-header -->
				            <table id="district" class="display" width="100%" cellspacing="0">
						        <thead>
						            <tr>
						                <th>ID</th>
						                <th>province</th>
						                <th>district</th>
						                <th>Action</th>
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach($districts as $district)
						        		<tr>
						        			<td>{{$district->id}}</td>
                          <td style="display: none">{{$district->province->id}}</td>
						        			<td>{{$district->province->name}}</td>
						        			<td>{{$district->name}}</td>
						        			<td>
                            <button onclick="searchDistrict(event)" type="button" class="btn btn-success" data-toggle="modal" data-target="#edit" class="edit">
											        Edit
											      </button>
										    </td>
						        		</tr>
						        	@endforeach
						        </tbody>
					        </table>
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
                <p class="login-box-msg">New District</p>
                 
                <!-- <register-form></register-form> -->
                <form action="{{route('districts.store')}}" method="post" data-parsley-validate>
                  {{ csrf_field() }}
                  <div class="form-group">
                  	<label>Provinve Name</label>
                  	<select required name="province" class="form-control">
                  		<option>Select Province</option>
                  		@foreach($provinces as $province)
                  		<option value="{{$province->id}}">{{$province->name}}</option>
                  		@endforeach
                  	</select>
                  </div>
                  <div class="form-group">
                  	<label>District Name</label>
                  	<input required type="text" name="district" class="form-control">
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
                <p class="login-box-msg">Edit District</p>
                 
                <!-- <register-form></register-form> -->
                <form action="/districts/" id="myform" method="post" data-parsley-validate>
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value='PUT'>
                  <div class="form-group">
                  	<label>Provinve Name</label>
                  	<select required name="province" class="form-control" id="province">
                  		<option>Select Province</option>
                  		@foreach($provinces as $province)
                  		<option value="{{$province->id}}">{{$province->name}}</option>
                  		@endforeach
                  	</select>
                  </div>
                  <div class="form-group">
                  	<label>District Name</label>
                  	<input required id="district" type="text" name="district" class="form-control">
                  </div>
   
                  <div class="row">
                    <div class="col-xs-7">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" id="btnRegister" onclick="AddActionDistrict()">Update</button>
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
       $(function(){
      $("#district").dataTable();
    })
      var id
      function searchDistrict(e)
      {
        var tr=e.target.parentNode.parentNode
        var idtag=tr.firstChild
        id=tr.firstChild.innerHTML
        var provincetag=idtag.nextSibling.nextSibling
        var province=provincetag.innerHTML
        var districttag=provincetag.nextSibling.nextSibling.nextSibling.nextSibling
        var district=districttag.innerHTML
        var provinceTag=document.getElementById('province')
        provinceTag.value=parseInt(province)
        var districtTag=document.getElementById('district')
        districtTag.value=district
        alert(districtTag.value)
      }
      function AddActionDistrict(){
        var form=document.getElementById('myform')
        form.action+=parseInt(id)
        alrt(form.action)
      }
    </script>
    @endsection