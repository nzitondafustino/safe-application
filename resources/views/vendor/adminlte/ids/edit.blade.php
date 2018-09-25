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
				                    <a href="/vehicle/{{$accident->id}}"><button type="button" class="btn btn-block btn-primary btn-flat">Back</button></a>
				              </div>
				              <h1 class="box-title">{{$accident->comment}}</h1><br />
				              <h1 class="box-title">{{$accident->address}}</h1><br />
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
				              <h3 class="box-title">Enter New Identification Information</h3>
				              
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->
				            <form class="form-horizontal" method="post" action="{{route('ids.update',$id->id)}}">
				            	<input type="hidden" name="_method" value="PUT">
				            	{{ csrf_field() }}
				            	<input type="hidden" name="accident" value="{{$accident->id}}">
					              <div class="box-body">
					                <div class="form-group">
					                  <label for="IdsType" class="col-sm-2 control-label">Type</label>

					                  <div class="input-group col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-id-card-o"></i>
						                  </div>
						                    <select class="form-control" id="IdsType" name="IdsType" placeholder="Select Identification Category">
						                    	<option {{$id->type==1 ? 'selected' : ''}} value="1">Driving License</option>
						                    	<option {{$id->type==2 ? 'selected' : ''}} value="2">Immatriculation Card</option>
						                    	<option {{$id->type==3 ? 'selected' : ''}} value="3">Insurance</option>
						                    </select>
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="IdsType" class="col-sm-2 control-label">Card Status</label>

					                  <div class="input-group col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="fa fa-id-card-o"></i>
						                  </div>
						                    <select class="form-control" id="IdsType" name="status" placeholder="Select Identification Category">
						                    	<option {{$id->status==1 ? 'selected' : ''}} value="1">Hold</option>
						                    	<option {{$id->status==2 ? 'selected' : ''}} value="2">Released</option>
						                    </select>
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="cardNo" class="col-sm-2 control-label">Card No</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="glyphicon glyphicon-credit-card"></i>
						                  </div>
						                  <input value="{{$id->number}}"  class="form-control" id="cardNo" name="cardNo" placeholder="Card Number" type='text' />
					                  </div>
					                </div>
					                <div id="dlicense">
						                <div class="form-group">
						                  <label for="category" class="col-sm-2 control-label">Category</label>

						                  <div class="input-group date col-sm-7">
							                  <div class="input-group-addon">
							                    <i class="glyphicon glyphicon-modal-window"></i>
							                  </div>
							                  <input  class="form-control" name="category" id="category" placeholder="Driving License Category" type='text' />
						                  </div>
						                </div>
						            </div>

					                <div class="form-group">
					                  <label for="owner" class="col-sm-2 control-label">Owner</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="glyphicon glyphicon-user"></i>
						                  </div>
						                  <input value="{{$id->owner}}" class="form-control" id="owner" name="owner" placeholder="Vehicle Owner" type='text' />
					                  </div>
					                </div>
					                <div class="form-group">
					                  <label for="amande" class="col-sm-2 control-label">Penality</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="glyphicon glyphicon-usd"></i>
						                  </div>
						                  <input value="{{$id->amande}}"  class="form-control" name="amande" id="amande" placeholder="Prescribed Amande" type='text' />
					                  </div>
					                </div>
					              </div>
					                
					              <div class="box-footer">
					              	<div class="btn-group pull-right">
					              		<a href="/home" class="pull-left"><button type="button" class="btn btn-default btn-flat">Cancel</button></a>
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

		$(document).ready(function(){

			$("#category").val("");
			$("#dlicense").hide();

			$("select[name=IdsType]").change(function(){
				var dataS = $(this).val();
				if(dataS == 1){
					$("#category").val("");
					$("#dlicense").show();
				} else{
					$("#category").val("");
					$("#dlicense").hide();
				}
			});
		});
	}, 1000);


</script>