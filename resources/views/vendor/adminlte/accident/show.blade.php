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
				            	<a href="/accident/{{$accident->id}}/edit"><button type="button" class="btn btn-block btn-danger btn-flat">Edit</button></a>
				            	 </div>
				              <div class="btn-group pull-right">
				                    <a href="/home"><button type="button" class="btn btn-block btn-primary btn-flat">Home</button></a>
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
				              <h3 class="box-title">Vehicle Taken During Accident Investigation</h3>
				              <div class="btn-group pull-right">
				                    <a href="/vehicle/{{$accident->id}}?create=new"><button type="button" class="btn btn-block btn-primary btn-flat">Add New</button></a>
				              </div>
				            </div>
				            <!-- /.box-header -->
				            <table id="vehicles" class="display" width="100%" cellspacing="0">
						        <thead>
						            <tr>
						                <th>Type</th>
						                <th>Plate</th>
						                <th>Owner</th>
						                <th>Penalities</th>
						                <th>Status</th>
						                <th>Action</th>
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach($accident->vehicles as $vehicle)
						        		<tr>
						        			<td>{{$vehicle->type}}</td>
						        			<td>{{$vehicle->plate}}</td>
						        			<td>{{$vehicle->owner}}</td>
						        			<td>{{$vehicle->amande}}</td>
						        			@if($vehicle->status == 1)
						        				<td><small class="label pull-center bg-red" >Hold</small></td>
						        			@endif
						        			@if($vehicle->status == 2)
						        				<td><small class="label pull-center bg-green">Released</small></td>
						        			@endif
						        			@if($vehicle->status == 3)
						        				<td><small class="label label-warning pull-center">Transfered</small></td>
						        			@endif
						        			<td><a href="{{route('vehicle.edit',$vehicle->id)}}"><span class="label label-warning">Edit</span></a>
					        				<a href="{{route('vehicle.show',$vehicle->id)}}"><span class="label label-success">View</span></a>
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
		</div>
<div class="row">
			<div class="col-md-12">
				
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="box-body">
				            <div class="box-header with-border">
				              <h3 class="box-title">Identifications Taken During Accident Investigastion</h3>
				              <div class="btn-group pull-right">
				                    <a href="/ids/create?id={{$accident->id}}"><button type="button" class="btn btn-block btn-primary btn-flat">Add New</button></a>
				              </div>
				            </div>
				            <!-- /.box-header -->
				            <table id="vehicles" class="display" width="100%" cellspacing="0">
						        <thead>
						            <tr>
						                <th>Type</th>
						                <th>Number</th>
						                <th>Owner</th>
						                <th>Status</th>
						                <th>Action</th>
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach($accident->identifications as $id)
						        		<tr>
						        			<td>{{$id->type}}</td>
						        			<td>{{$id->number}}</td>
						        			<td>{{$id->owner}}</td>
						        			@if($id->status == 1)
						        				<td><small class="label pull-center bg-red">Hold</small></td>
						        			@endif
						        			@if($id->status == 2)
						        				<td><small class="label pull-center bg-green">Released</small></td>
						        			@endif
						        			<td><a href="{{route('ids.edit',$id->id)}}"><span class="label label-warning">Edit</span></a>
						        			<a href="{{route('ids.show',$id->id)}}"><span class="label label-success">View</span></a>
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
		</div>
	</div>
      <!-- /.modal-dialog -->   
    <div class="modal fade" id="hold" tabindex="-1" role="dialog" aria-labelledby="hold" aria-hidden="true">
		<div class="modal-wrapper">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title text-center">Vehicle Transfered</h4>
					</div>
					<form id="formAccountingPaNewInvoiceItem" class="form-horizontal">
						<div class="modal-body" >
							Selected One Action to perform.
							<input type="hidden" name="id" id="rowidH" />
						</div>

						<div class="modal-footer" >
							<div class="pull-right btn-group">
								<a href="" type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
								<a class="btn btn-primary" >Realease</a>
								<a  type="button" class="btn btn-success" id="paNewDebtInvoiceItemSubmit" >Transfer</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
<script type="text/javascript">
	setTimeout(function(){
		activateNewAccidentForm();
	}, 1000);
</script>
<script type="text/javascript">
	setTimeout(function(){
		$('#vehicles').DataTable();
	},5000);
	var hold=document.getElementsByClassName('hold')
	for(var index=0;index < hold.length;index++)
	{
		hold[index].addEventListener('click',function(){
			alert('hello')
		})
	}
</script>