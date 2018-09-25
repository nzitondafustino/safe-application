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
					                <th>name</th>
					                <th>Title</th>
					                <th>E-mail</th>
					                <th>Police Station</th>
					                <th>Phone</th>
					                <th>Type</th>
					                <th>perform Action</th>
					            </tr>
					        </thead>
					        <tbody>
					        	@foreach($users as $user)
					        		<tr>
					        			<td>{{$user->id}}</td>
					        			<td class="text-center">{{$user->name}}</td>
					        			<td>{{$user->title}}</td>
					        			<td>{{$user->email}}</td>
					        			<td class="text-center">{{$user->station->name}}</td>
					        			<td class="text-center">{{$user->phone}}</td>
					        			<td class="text-center">{{$user->type==1 ? 'Admin' : "Normal"}}</td>
					        			<td><a class="btn btn-primary btn-xs" href="users/{{$user->id}}/edit">Edit</a><a class="btn btn-success btn-xs" href="{{route('users.show',$user->id)}}" style="margin-left: 2px;">View</a></td>
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