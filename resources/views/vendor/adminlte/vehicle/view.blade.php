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
				              		@if ($accident[0]->dead > 0 && $accident[0]->status != 2)
				              			<a href="/vehicle/{{$accident[0]->id}}/edit"><button type="button" class="btn btn-block btn-danger btn-flat">Transfer</button></a>
				              		@endif
				                    <a href="/home"><button type="button" class="btn btn-block btn-primary btn-flat">Home</button></a>
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
				              <h3 class="box-title">Vehicle Taken During Accident Investigation</h3>
				              <div class="btn-group pull-right">
				                    <a href="/vehicle/{{$accident[0]->id}}?create=new"><button type="button" class="btn btn-block btn-primary btn-flat">Add New</button></a>
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
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach($vehicles as $vehicle)
						        		<tr>
						        			<td>{{$vehicle->type}}</td>
						        			<td>{{$vehicle->plate}}</td>
						        			<td>{{$vehicle->owner}}</td>
						        			<td>{{$vehicle->amande}}</td>
						        			@if($vehicle->status == 1)
						        				<td><a href="#" onclick="$('#rowidH').val('<?= $vehicle->id ?>');$('#myModalLabel4').html('<?= $vehicle->type ?> <?= $vehicle->plate ?> is Hold')" data-toggle="modal" data-target="#hold"><small class="label pull-center bg-red">Hold</small></a></td>
						        			@endif
						        			@if($vehicle->status == 2)
						        				<td><a href="#" onclick="$('#rowidR').val('<?= $vehicle->id ?>');$('#myModalLabel3').html('<?= $vehicle->type ?> <?= $vehicle->plate ?> is Released')" data-toggle="modal" data-target="#released"><small class="label pull-center bg-green">Released</small></a></td>
						        			@endif
						        			@if($vehicle->status == 3)
						        				<td><a href="#" onclick="$('#rowid').val('<?= $vehicle->id ?>');$('#myModalLabel2').html('<?= $vehicle->type ?> <?= $vehicle->plate ?> is transfered')" data-toggle="modal" data-target="#transfered"><small class="label label-warning pull-center">Transfered</small></td>
						        			@endif
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
    <div class="modal fade" id="transfered" tabindex="-1" role="dialog" aria-labelledby="transfered" aria-hidden="true">
		<div class="modal-wrapper">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title text-center" id="myModalLabel2">Vehicle Transfered</h4>
					</div>
					<form id="formAccountingPaNewInvoiceItem" class="form-horizontal">
						<div class="modal-body" >
							The Vehicle is transfered<br />
							Selected One Action to perform.
							<input type="hidden" name="id" id="rowid" />
						</div>

						<div class="modal-footer" >
							<div class="pull-right btn-group">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<button onclick="window.location='/vehicle/{{$accident[0]->id}}?status=1&rowid=' + $('#rowid').val()" type="button" class="btn btn-primary" id="paNewDebtInvoiceItemSubmit" >Hold Back</button>
								<button onclick="window.location='/vehicle/{{$accident[0]->id}}?status=2&rowid=' + $('#rowid').val()"type="button" class="btn btn-success" id="paNewDebtInvoiceItemSubmit" >Released</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    <div class="modal fade" id="released" tabindex="-1" role="dialog" aria-labelledby="transfered" aria-hidden="true">
		<div class="modal-wrapper">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title text-center" id="myModalLabel3">Vehicle Transfered</h4>
					</div>
					<form id="formAccountingPaNewInvoiceItem" class="form-horizontal">
						<div class="modal-body" >
							The Vehicle is Released<br />
							Selected One Action to perform.
							<input type="hidden" name="id" id="rowidR" />
						</div>

						<div class="modal-footer" >
							<div class="pull-right btn-group">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<button onclick="window.location='/vehicle/{{$accident[0]->id}}?status=1&rowid=' + $('#rowidR').val()" type="button" class="btn btn-primary" id="paNewDebtInvoiceItemSubmit" >Hold Back</button>
								<button onclick="window.location='/vehicle/{{$accident[0]->id}}?status=3&rowid=' + $('#rowidR').val()"type="button" class="btn btn-success" id="paNewDebtInvoiceItemSubmit" >Transfered</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    <div class="modal fade" id="hold" tabindex="-1" role="dialog" aria-labelledby="hold" aria-hidden="true">
		<div class="modal-wrapper">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title text-center" id="myModalLabel4">Vehicle Transfered</h4>
					</div>
					<form id="formAccountingPaNewInvoiceItem" class="form-horizontal">
						<div class="modal-body" >
							The Vehicle is Released<br />
							Selected One Action to perform.
							<input type="hidden" name="id" id="rowidH" />
						</div>

						<div class="modal-footer" >
							<div class="pull-right btn-group">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<button onclick="window.location='/vehicle/{{$accident[0]->id}}?status=2&rowid=' + $('#rowidH').val()" type="button" class="btn btn-primary" id="paNewDebtInvoiceItemSubmit" >Realeased</button>
								<button onclick="window.location='/vehicle/{{$accident[0]->id}}?status=3&rowid=' + $('#rowidH').val()" type="button" class="btn btn-success" id="paNewDebtInvoiceItemSubmit" >Transfered</button>
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
</script>