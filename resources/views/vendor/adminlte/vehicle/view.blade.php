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
						<div class="box-body" style="margin-left: 20px;">
							    <h1>Hold Vehicle</h1>
				              	<h4>Owner:{{$vehicle->owner}}</h4>
				              	<h4>Owner ID No:{{$vehicle->ownerId}}</h4>
				              	<h4>Owner Licene No:{{$vehicle->owerLicence}}</h4>
				              	<h4>Plate:{{$vehicle->plate}}</h4>
				              	<h4>Mark:{{$vehicle->mark}}</h4>
				              	<h4>Chasis:{{$vehicle->shasis}}</h4>
				              	<h4>status:{{$vehicle->status==1 ? "Hold": ""}}
				              		       {{$vehicle->status==2 ? "Released": ""}}
				              		       {{$vehicle->status==3 ? "Transfered To the court": ""}}


				              	</h4>
				              	<h4>Vehicle Type:
				              		{{$vehicle->type ==1 ? "Car" :''}}
				              		{{$vehicle->type ==2 ? "Moto":''}}
				              		{{$vehicle->type ==3 ? 'Bicycle':''}}</h4>
				              	<h4>Penalty:{{$vehicle->amande}}</h4>
				              	<h4>
				              		<a class="btn btn-warning" href="{{route('vehicle.edit',$vehicle->id)}}">Edit</a>
				              		<a class="btn btn-danger" href="{{route('vehicle.destroy',$vehicle->id)}}">Delete</a
				              	</h4>
				              	<h1>Officer Identification</h1>
				              	<h4>Name:{{$user->name}}</h4>
				              	<h4>E-mail:{{$user->email}}</h4>
				              	<h4>Lanker:{{$user->title}}</h4>
				              	<h4>Phone:{{$user->phone}}</h4>
				              	<h4>station:{{$user->station->name}}</h4>


				        </div>
				    </div>
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