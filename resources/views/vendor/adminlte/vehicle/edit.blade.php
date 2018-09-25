@extends('adminlte::layouts.app')

@section('htmlheader_title')
	New Accident
@endsection


@section('main-content')
	<div class="container-fluid spark-screen" id="app">
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="box-body">
				            <div class="box-header with-border">
				              <div class="btn-group pull-right">
				                    <a href="/vehicle/{{$accident->id}}"><button type="button" class="btn btn-block btn-primary btn-flat">Back</button></a>
				                    <form action="{{route('vehicle.create')}}">
				                    	
				                    </form>
				              </div>
				              <h1 class="box-title">{{$accident->comment}}</h1><br />
				              <h1 class="box-title">{{-- {{$accident->address}} --}}</h1><br />
				              <h1 class="box-title">{{$accident->date}}</h1><br />
				              <b>Injury </b><span class="label label-warning">{{$accident->injury}}</span> <b>Dead </b><span class="label bg-red">{{$accident->dead}}</span>

				            </div>
				        </div>
				    </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="box-body">
				            <div class="box-header with-border">
				              <h3 class="box-title">Enter New Accident Information</h3>
				              
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->
				            <form class="form-horizontal" method="post" action="{{route('vehicle.update',$vehicle->id)}}">
				            	<input type="hidden" name="_method" value="PUT">
				            	{{ csrf_field() }}
				            	<input type="hidden" name="accident" value="{{$accident->id}}">
					              <div class="box-body">
					                <div class="form-group">
					                  <label for="vehicleType" class="col-sm-2 control-label">Vehicle</label>

					                  <div class="input-group col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-car"></i>
						                  </div>
						                    <select class="form-control" id="vehicleType" name="vehicleType" placeholder="Type">
						                    	<option {{$vehicle->type==1 ? 'selected' : ''}} value="1">Car</option>
						                    	<option {{$vehicle->type==2 ? 'selected' : ''}} value="2">Moto</option>
						                    	<option {{$vehicle->type==3? 'selected' : ''}} value="3">Bicycle</option>
						                    </select>
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="vehicleType" class="col-sm-2 control-label">Vehicle Status</label>

					                  <div class="input-group col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-car"></i>
						                  </div>
						                    <select class="form-control" id="vehicleType" name="status" placeholder="Status">
						                    	<option {{$vehicle->status==1 ? 'selected' : ''}} value="1">Hold</option>
						                    	<option  {{$vehicle->status==2 ? 'selected' : ''}} value="2">Release</option>
						                    	<option {{$vehicle->status==3? 'selected' : ''}} value="3">Transfer</option>
						                    </select>
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="plate" class="col-sm-2 control-label">Plate No</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-wheelchair"></i>
						                  </div>
						                  <input  value="{{$vehicle->plate}}" class="form-control" id="plate" name="plate" placeholder="Plate Number" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="owner" class="col-sm-2 control-label">Owner</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-wheelchair"></i>
						                  </div>
						                  <input value="{{$vehicle->owner}}"  class="form-control" id="owner" name="owner" placeholder="Vehicle Owner" type='text' />
					                  </div>
					                </div>
					                 <div class="form-group">
					                  <label for="owner" class="col-sm-2 control-label">Owner ID No</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-wheelchair"></i>
						                  </div>
						                  <input value="{{$vehicle->ownerId}}"   class="form-control" id="ownerId" name="ownerId" placeholder="Owner ID" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="owner" class="col-sm-2 control-label">Owner Licence No</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-wheelchair"></i>
						                  </div>
						                  <input value="{{$vehicle->ownerLicence}}"  class="form-control" id="owner" name="ownerLicence" placeholder="Owner Licence" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="mark" class="col-sm-2 control-label">Mark</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-deafness"></i>
						                  </div>
						                  <input  value="{{$vehicle->mark}}" class="form-control" name="mark" id="mark" placeholder="Vehicle Mark" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="chasis" class="col-sm-2 control-label">Chasis</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-deafness"></i>
						                  </div>
						                  <input value="{{$vehicle->shasis}}"  class="form-control" name="chasis" id="chasis" placeholder="Vehicle Chasis ID" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="amande" class="col-sm-2 control-label">Penality</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-deafness"></i>
						                  </div>
						                  <input value="{{$vehicle->amande}}"  class="form-control" name="amande" id="amande" placeholder="Prescribed Amande" type='text' />
					                  </div>
					                </div>
					              </div>
					                
					              <div class="box-footer">
					              	<div class="btn-group pull-right">
					              		<a href="/home" class="pull-left"><button type="button" class="btn btn-default btn-flat">Cancel</button></a>
					              		{{-- <form action="GET">
					              		    <input type="hidden" name="accidentId2" value="{{$accident->id}}">
					              		</form> --}}
					                	<button type="submit" class="btn btn-primary btn-flat">Save Changes</button>
					              	</div>
					                
					              </div>
					              <!-- /.box-footer -->
					              </div>
					              <!-- /.box-body -->
					            </form>
				          
			            </div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
    
@endsection
<script type="text/javascript">
	setTimeout(function(){
		activateNewAccidentForm();
	}, 1000);

</script>