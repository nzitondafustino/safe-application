@extends('adminlte::layouts.app')

@section('htmlheader_title')
	New Accident
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="box-body">
				            <div class="box-header with-border">
				              <div class="btn-group pull-right">
				                    <a href="/vehicle/{{$accident[0]->id}}"><button type="button" class="btn btn-block btn-primary btn-flat">Back</button></a>
				              </div>
				              <h1 class="box-title">{{$accident[0]->comment}}</h1><br />
				              <h1 class="box-title">{{$accident[0]->address}}</h1><br />
				              <h1 class="box-title">{{$accident[0]->date}}</h1><br />
				              <b>Injury </b><span class="label label-warning">{{$accident[0]->injury}}</span> <b>Dead </b><span class="label bg-red">{{$accident[0]->dead}}</span>

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
				            <form class="form-horizontal" method="post" action="/vehicle">
				            	{{ csrf_field() }}
				            	<input type="hidden" name="accident" value="{{$accident[0]->id}}">
					              <div class="box-body">
					                <div class="form-group">
					                  <label for="vehicleType" class="col-sm-2 control-label">Vehicle</label>

					                  <div class="input-group col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-car"></i>
						                  </div>
						                    <select class="form-control" id="vehicleType" name="vehicleType" placeholder="Type">
						                    	<option value="1">Car</option>
						                    	<option value="2">Moto</option>
						                    	<option value="3">Bicycle</option>
						                    </select>
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="plate" class="col-sm-2 control-label">Plate No</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-wheelchair"></i>
						                  </div>
						                  <input  class="form-control" id="plate" name="plate" placeholder="Plate Number" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="owner" class="col-sm-2 control-label">Owner</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-wheelchair"></i>
						                  </div>
						                  <input  class="form-control" id="owner" name="owner" placeholder="Vehicle Owner" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="type" class="col-sm-2 control-label">Type</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-deafness"></i>
						                  </div>
						                  <input  class="form-control" name="type" id="type" placeholder="Vehicle Type" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="mark" class="col-sm-2 control-label">Mark</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-deafness"></i>
						                  </div>
						                  <input  class="form-control" name="mark" id="mark" placeholder="Vehicle Mark" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="chasis" class="col-sm-2 control-label">Chasis</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-deafness"></i>
						                  </div>
						                  <input  class="form-control" name="chasis" id="chasis" placeholder="Vehicle Chasis ID" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="amande" class="col-sm-2 control-label">Penality</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-deafness"></i>
						                  </div>
						                  <input  class="form-control" name="amande" id="amande" placeholder="Prescribed Amande" type='text' />
					                  </div>
					                </div>
					              </div>
					                
					              <div class="box-footer">
					              	<div class="btn-group pull-right">
					              		<a href="/home" class="pull-left"><button type="button" class="btn btn-default btn-flat">Cancel</button></a>
					                	<button type="submit" class="btn btn-primary btn-flat">Save & Continue</button>
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
	<!-- Address Modal -->
	<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="Terms and conditions" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Select The Accident Area</h4>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-flat">Use Selected</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
    </div>
      <!-- /.modal-dialog -->
    
@endsection
<script type="text/javascript">
	setTimeout(function(){
		activateNewAccidentForm();
	}, 1000);
</script>