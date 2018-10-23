@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="col-sm-12">
							<div class="btn-group pull-right">
			                    <a href="/accident/create"><button type="button" class="btn btn-block btn-primary btn-flat">New Accident</button></a>
			            </div>
			        </div>
			    </div>
					
					<div class="box-body">
						<table id="accidents" class="display" width="100%" cellspacing="0">
					        <thead>
					            <tr>
					                <th>#</th>
					                <th>Date</th>
					                <th>Comment</th>
					                <th>Injury</th>
					                <th>Dead</th>
					                <th>Vehicles</th>
					                <th>Accident Vehicles</th>
					                <th>Accident IDs</th>
					            </tr>
					        </thead>
					        <tbody>
					        	@foreach($accidents as $accident)
					        		<tr>
					        			<td>{{$accident->id}}</td>
					        			<td>{{date("d/m/Y",$accident->date)}}</td>
					        			<td>{{$accident->comment}}</td>
					        			<td class="text-center"><span class="label label-warning">{{$accident->injury}}</span></a></td>
					        			<td class="text-center"><span class="label bg-red">{{$accident->dead}}</span></a></td>
					        			<td class="text-center">
					        				@foreach($accident->vehicles as $vehicle)
					        				<a href="/accident/{{ $accident->id }}">
					        					<span class="label label-primary" style="margin-left: 2px;">
					        						{{$vehicle->plate}}
					        					</span>
					        				</a>
					        				@endforeach
					        			</td>
					        			<td class="text-center">
					        				<a href="/vehicle/create?id={{$accident->id}}"><span class="label label-danger">Hold Vehicle</span></a>
					        			</td>
					        			<td>
					        				<a href="/ids/create?id={{$accident->id}}"><span class="label label-danger">hold ID</span></a>
					        			</td>
					        		</tr>
					        	@endforeach
					        </tbody>
					    </table>
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
		$('#accidents').DataTable();
	},5000);
</script>