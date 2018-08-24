@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Identication Cards
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="box-body">
				            <div class="box-header">
				              	<div class="btn-group pull-right">
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
				              <h3 class="box-title">Identifications Taken During Accident Investigastion</h3>
				              <div class="btn-group pull-right">
				                    <a href="/ids/create?id={{$accident[0]->id}}"><button type="button" class="btn btn-block btn-primary btn-flat">Add New</button></a>
				              </div>
				            </div>
				            <!-- /.box-header -->
				            <table id="vehicles" class="display" width="100%" cellspacing="0">
						        <thead>
						            <tr>
						                <th>Type</th>
						                <th>Number</th>
						                <th>Owner</th>
						                <th>Category</th>
						                <th>Status</th>
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach($ids as $id)
						        		<tr>
						        			<td>{{$id->type}}</td>
						        			<td>{{$id->number}}</td>
						        			<td>{{$id->owner}}</td>
						        			<td>{{$id->category}}</td>
						        			@if($id->status == 1)
						        				<td><a onclick="return confirm('Are you sure \nYou want to Release the selected Document?')" href="/ids/{{$accident[0]->id}}/edit?status=2&rowid=<?= $id->id ?>"><small class="label pull-center bg-red">Hold</small></a></td>
						        			@endif
						        			@if($id->status == 2)
						        				<td><a onclick="return confirm('Are you sure \nYou want to Hold Back the selected Document?')" href="/ids/{{$accident[0]->id}}/edit?status=1&rowid=<?= $id->id ?>"><small class="label pull-center bg-green">Released</small></a></td>
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