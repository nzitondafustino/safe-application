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
				            <form class="form-horizontal" method="POST" action="{{route('accident.update',$accident->id)}}">
				            	<input type="hidden" name="_method" value="PUT">
				            	{{ csrf_field() }}
				              <div class="box-body">
				              	<div class="form-group">
					                <label for="datepicker" class="col-sm-2 control-label">Date:</label>
					                <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input class="form-control pull-right" id="datepicker" name="datepicker" type="text" value="{{$accident->date}}" data-provide="datepicker-inline">
					                </div>
					                <!-- /.input group -->
				              	</div>
				                <div class="form-group">
				                  <label for="province" class="col-sm-2 control-label">Province</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-address-book"></i>
					                  </div>
					                    <select class="form-control" id="province" name="province" placeholder="Province">
					                    	<option value="">Select Province</option>
					                    	@foreach($provinces as $province)
					                    	<option value="{{$province->id}}">{{$province->name}}</option>
					                    	@endforeach
					                    </select>
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="district" class="col-sm-2 control-label">District</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-address-book"></i>
					                  </div>
					                    <select class="form-control" id="district" name="district" placeholder="District">
					                    	<option value="">Select District</option>
					                    	{{-- @foreach($provinces as $province)
					                    	<option value="{{$province->id}}">{{$province->name}}</option>
					                    	@endforeach --}}
					                    </select>
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="sector" class="col-sm-2 control-label">Sector</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-address-book"></i>
					                  </div>
					                    <select class="form-control" id="sector" name="sector" placeholder="Sector">
					                    	<option value="">Select Sector</option>
					                    	{{-- @foreach($provinces as $province)
					                    	<option value="{{$province->id}}">{{$province->name}}</option>
					                    	@endforeach --}}
					                    </select>
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="comment" class="col-sm-2 control-label">Comment</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="glyphicon glyphicon-comment"></i>
					                  </div>
					                  <textarea  class="form-control" id="comment" name="comment" placeholder="Comment" rows=3>{{$accident->comment}}</textarea>
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="injury" class="col-sm-2 control-label">Injury People</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-wheelchair"></i>
					                  </div>
					                  <input  class="form-control" value="{{$accident->injury}}" id="injury" name="injury" placeholder="Injury People" type='text' />
				                  </div>
				                </div>
				                <div class="form-group">
				                  <label for="dead" class="col-sm-2 control-label">Dead People</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-deafness"></i>
					                  </div>
					                  <input  class="form-control" value="{{$accident->dead}}" name="dead" id="dead" placeholder="Dead People" type='text' />
				                  </div>
				                </div>
				              </div>
				              <!-- /.box-body -->
				              <div class="box-footer">
				              	<div class="btn-group pull-right">
				              		<a href="/home" class="pull-left btn btn-primary">Cancel</a>
				              		<button type="submit" class="btn btn-success">Save Changes</button>
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
    
@endsection
<script type="text/javascript">
	setTimeout(function(){
		activateNewAccidentForm();
	}, 1000);
</script>