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
				              <h3 class="box-title">Enter New Accident Information</h3>
				              <br />
				              <span class="label label-alert">{{@$error}}</span>
				              	<div class="btn-group pull-right">
				                    <a href="/home"><button type="button" class="btn btn-block btn-primary btn-flat">Home</button></a>
				                </div>
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->
				            <form class="form-horizontal" method="post" action="/accident">
				            	{{ csrf_field() }}
				              <div class="box-body">
				              	<div class="form-group">
					                <label for="datepicker" class="col-sm-2 control-label">Date:</label>
					                <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input class="form-control pull-right" id="datepicker" name="datepicker" type="text" data-provide="datepicker-inline">
					                </div>
					                <!-- /.input group -->
				              	</div>
				                <div class="form-group">
				                  <label for="address" class="col-sm-2 control-label">Address</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-address-book"></i>
					                  </div>
					                    <select class="form-control" id="address" name="address" placeholder="Province">
					                    	<option value=""></option>
					                    	@foreach($address as $a)
					                    		<option value="{{$a->id}}">{{$a->name}}
					                    	@endforeach
					                    </select>
					                    <!-- <div class="input-group-addon">
					                    	<a href="#"  data-toggle="modal" data-target="#addressModal"><i class="fa fa-address-book"></i></a>
					                  </div> -->
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="comment" class="col-sm-2 control-label">Comment</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="glyphicon glyphicon-comment"></i>
					                  </div>
					                  <textarea  class="form-control" id="comment" name="comment" placeholder="Comment" rows=3></textarea>
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="injury" class="col-sm-2 control-label">Injury People</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-wheelchair"></i>
					                  </div>
					                  <input  class="form-control" id="injury" name="injury" placeholder="Injury People" type='text' />
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="dead" class="col-sm-2 control-label">Dead People</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-deafness"></i>
					                  </div>
					                  <input  class="form-control" name="dead" id="dead" placeholder="Dead People" type='text' />
				                  </div>
				                </div>
				              </div>
				              <!-- /.box-body -->
				              <div class="box-footer">
				              	<div class="btn-group pull-right">
				              		<a href="/home" class="pull-left"><button type="button" class="btn btn-default btn-flat">Cancel</button></a>
				                	<button type="submit" class="btn btn-primary btn-flat">Save & Continue</button>
				              	</div>
				                
				              </div>
				              <!-- /.box-footer -->
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