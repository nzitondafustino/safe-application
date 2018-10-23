@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Edit ID
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
						<div class="box-body">
				            <div class="box-header with-border">
				              <h3 class="box-title">Enter New Identification Information</h3>
				              
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->
				            <form class="form-horizontal" method="post" action="{{route('ids.update',$id->id)}}" data-parsley-validate>
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
						                    <select required   data-parsley-errors-container="#vidType" class="form-control" id="IdsType" name="IdsType" placeholder="Select Identification Category">
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
						                    <select required   data-parsley-errors-container="#vstatus" class="form-control" id="IdsType" name="status" placeholder="Select Identification Category">
						                    	<option {{$id->status==1 ? 'selected' : ''}} value="1">Hold</option>
						                    	<option {{$id->status==2 ? 'selected' : ''}} value="2">Released</option>
						                    </select>
					                  </div>
					                </div>
					                <div class="form-group{{ $errors->has('cardNo') ? ' has-error' : '' }}">
					                  <label for="cardNo" class="col-sm-2 control-label">Card No</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="glyphicon glyphicon-credit-card"></i>
						                  </div>
						                  <input required type="number"   data-parsley-errors-container="#vcardNo" value="{{$id->number}}"  class="form-control" id="cardNo" name="cardNo" placeholder="Card Number" type='text' />
					                  </div>
					                  @if ($errors->has('cardNo'))
					                  <div class="row">
					                  	<div class="col-md-12 text-center">
	                                    <span class="invalid-feedback" role="alert">
	                                    	 <span class="help-block"><strong>{{ $errors->first('cardNo') }}</strong></span>
	                                    </span>
	                                </div>
	                                </div>
                                      @endif
					                </div>
					                <div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
					                  <label for="owner" class="col-sm-2 control-label">Owner</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    <i class="glyphicon glyphicon-user"></i>
						                  </div>
						                  <input required type="string"    data-parsley-errors-container="#vowner" value="{{$id->owner}}" class="form-control" id="owner" name="owner" placeholder="Vehicle Owner" type='text' />
					                  </div>
					                  @if ($errors->has('owner'))
					                  <div class="row">
					                  	<div class="col-md-12 text-center">
	                                    <span class="invalid-feedback" role="alert">
	                                    	 <span class="help-block"><strong>{{ $errors->first('owner') }}</strong></span>
	                                    </span>
	                                </div>
	                                </div>
                                      @endif
                                      <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong id="vowner"></strong>
	                                    </span>
	                                </div>
	                                </div>
					                </div>
					                <div class="form-group{{ $errors->has('amande') ? ' has-error' : '' }}">
					                  <label for="amande" class="col-sm-2 control-label">Penality</label>

					                  <div class="input-group date col-sm-7">
						                  <div class="input-group-addon">
						                    RWF
						                  </div>
						                  <input required type="number"  data-parsley-errors-container="#vamande" value="{{$id->amande}}"  class="form-control" name="amande" id="amande" placeholder="Prescribed Amande" type='text' />
					                  </div>
					                  @if ($errors->has('amande'))
					                  <div class="row">
					                  	<div class="col-md-12 text-center">
	                                    <span class="invalid-feedback" role="alert">
	                                    	 <span class="help-block"><strong>{{ $errors->first('amande') }}</strong></span>
	                                    </span>
	                                </div>
	                                </div>
                                      @endif
                                      <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong id="vamande"></strong>
	                                    </span>
	                                </div>
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
      <!-- /.modal-dialog -->
    
@endsection