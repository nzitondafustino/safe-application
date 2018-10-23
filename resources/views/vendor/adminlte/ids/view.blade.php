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
				              <h1 class="box-title">Comment:{{$accident->comment}}</h1><br />
				              <h1 class="box-title">Province:{{$accident->province->name}}</h1><br />
				              <h1 class="box-title">District:{{$accident->district->name}}</h1><br />
				              <h1 class="box-title">Sector:{{$accident->sector->name}}</h1><br />
				              <h1 class="box-title">Date:{{date("d/m/Y",$accident->date)}}</h1><br />
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
							    <h1>Hold Identification</h1>
				              	<h4>Owner:{{$id->owner}}</h4>
				              	<h4>card No:{{$id->number}}</h4>
				              	<h4>status:{{$id->status==1 ? "Hold": "Released"}}</h4>
				              	<h4>Card Type:
				              		{{$id->type ==1 ? "Driving License" :''}}
				              		{{$id->type ==2 ? "Immaculation Card":''}}
				              		{{$id->type ==3 ? 'Insurence':''}}</h4>
				              	<h4>Hold at:{{-- {{$id->created_at}} --}}</h4>
				              	<h4>Penalty:{{$id->amande}}</h4>
				              	<h4>
				              		<a class="btn btn-warning" href="{{route('ids.edit',$id->id)}}">Edit</a>
				              	</h4>


				        </div>
				    </div>
				</div>
			</div>
		</div>
		
	</div>   
@endsection
</script>