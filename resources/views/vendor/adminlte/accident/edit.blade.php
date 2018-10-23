@extends('adminlte::layouts.app')

@section('htmlheader_title')
	New Accident
@endsection


@section('main-content')
	<div class="container-fluid spark-screen" id="app1">
		<div class="row">
			<div class="col-md-12">
				
				<!-- Default box -->
				<div class="box" style="padding: 6px;">
					<div class="row">
						<div class="box-body">
				            <div class="box-header with-border">
				              <h3 class="box-title">Edit Accident Information</h3>
				              <br />
				              <span class="label label-alert">{{@$error}}</span>
				              	<div class="btn-group pull-right">
				                    <a href="/home"><button type="button" class="btn btn-block btn-primary btn-flat">Home</button></a>
				                </div>
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->
				            <form class="form-horizontal" method="post" action="{{route('accident.update',$accident->id)}}" data-parsley-validate >
				            	{{ csrf_field() }}
				            	<input type="hidden" name="_method" value="PUT">
				              <div class="box-body">
				              	<div class="form-group{{ $errors->has('datepicker') ? ' has-error' : '' }}">
					                <label for="datepicker" class="col-sm-2 control-label">Date:</label>
					                <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input required   data-parsley-errors-container="#vdate" value="{{date('m/d/y',$accident->date)}}" class="form-control pull-right"  id="datepicker" name="datepicker" type="text" >
					                </div>
					                @if ($errors->has('datepicker'))
					                  <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                    	 <span class="help-block"><strong>{{ $errors->first('datepicker') }}</strong></span>
	                                    </span>
	                                </div>
	                                </div>
                                      @endif
                                      <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong id="vdate"></strong>
	                                    </span>
	                                </div>
	                                </div>
					                <!-- /.input group -->
				              	</div>
				                <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
				                  <label for="province" class="col-sm-2 control-label">Province</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-address-book"></i>
					                  </div>
					                    <select required type="number"  data-parsley-errors-container="#vprovince" class="form-control" id="province" name="province" placeholder="Province">
					                    	<option value="">Select Province</option>
					                    	@foreach($provinces as $province)
					                    	<option {{$province->id===$accident->province->id ? 'selected' : ''}}
					                    	 value="{{$province->id}}">
					                    	 {{$province->name}}
					                    	</option>
					                    	@endforeach
					                    </select>
				                  </div>
				                   @if ($errors->has('province'))
					                  <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('province') }}</strong>
	                                    </span>
	                                </div>
	                                </div>
                                      @endif
                                      <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong id="vprovince"></strong>
	                                    </span>
	                                </div>
	                                </div>
				                </div>
				                <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
				                  <label for="district" class="col-sm-2 control-label">District</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-address-book"></i>
					                  </div>
					                    <select required type="number" data-parsley-errors-container="#vdistrict" class="form-control" id="district" name="district" placeholder="District">
					                    	<option value="">Select District</option>
					                    	@foreach($districts as $district)
					                    	<option {{$district->id===$accident->district->id ? 'selected' : ''}}
					                    	 value="{{$district->id}}">
					                    	 {{$district->name}}
					                    	</option>
					                    	@endforeach
					                    </select>
				                  </div>
				                  @if ($errors->has('district'))
					                  <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('district') }}</strong>
	                                    </span>
	                                </div>
	                                </div>
                                      @endif
                                      <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong id="vdistrict"></strong>
	                                    </span>
	                                </div>
	                                </div>
				                </div>
				                <div class="form-group{{ $errors->has('sector') ? ' has-error' : '' }}">
				                  <label for="sector" class="col-sm-2 control-label">Sector</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-address-book"></i>
					                  </div>
					                    <select required type="number" data-parsley-errors-container="#vsector" class="form-control" id="sector" name="sector" placeholder="Sector">
					                    	<option value="">Select Sector</option>
					                    	@foreach($sectors as $sector)
					                    	<option {{$sector->id===$accident->sector->id ? 'selected' : ''}}
					                    	 value="{{$sector->id}}">
					                    	 {{$sector->name}}
					                    	</option>
					                    	@endforeach
					                    </select>
				                  </div>
				                  @if ($errors->has('sector'))
					                  <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('sector') }}</strong>
	                                    </span>
	                                </div>
	                                </div>
                                      @endif
                                      <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong id="vsector"></strong>
	                                    </span>
	                                </div>
	                                </div>
				                </div>
				                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
				                  <label for="comment" class="col-sm-2 control-label">Comment</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="glyphicon glyphicon-comment"></i>
					                  </div>
					                  <textarea required  data-parsley-errors-container="#vcomment"  class="form-control" id="comment" name="comment" placeholder="Comment" rows=3>{{$accident->comment}}</textarea>
				                  </div>
				                   @if ($errors->has('comment'))
					                  <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('comment') }}</strong>
	                                    </span>
	                                </div>
	                                </div>
                                      @endif
                                      <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong id="vcomment"></strong>
	                                    </span>
	                                </div>
	                                </div>
				                </div>
				                <div class="form-group{{ $errors->has('injury') ? ' has-error' : '' }}">
				                  <label for="injury" class="col-sm-2 control-label">Injury People</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-wheelchair"></i>
					                  </div>
					                  <input required type="number" maxlength="5" data-parsley-errors-container="#vinjury" value="{{$accident->injury}}"  class="form-control" id="injury" name="injury" placeholder="Injury People" type='text' />
				                  </div>
				                  @if ($errors->has('injury'))
					                  <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('injury') }}</strong>
	                                    </span>
	                                </div>
	                                </div>
                                    @endif
                                    <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong id="vinjury"></strong>
	                                    </span>
	                                </div>
	                                </div>
				                </div>
				                <div class="form-group{{ $errors->has('dead') ? ' has-error' : '' }}">
				                  <label for="dead" class="col-sm-2 control-label">Dead People</label>

				                  <div class="input-group date col-sm-7">
					                  <div class="input-group-addon">
					                    <i class="fa fa-deafness"></i>
					                  </div>
					                  <input required type="number" maxlength="5" data-parsley-errors-container="#vdead" value="{{$accident->dead}}" class="form-control" name="dead" id="dead" placeholder="Dead People" type='text' />
				                  </div>
				                   @if ($errors->has('dead'))
					                  <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $errors->first('dead') }}</strong>
	                                    </span>
	                                </div>
	                                </div>
                                      @endif
                                       <div class="row">
					                  	<div class="col-md-12 text-center help-block">
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong id="vdead"></strong>
	                                    </span>
	                                </div>
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
@section('myScript')
<script>
	$(function(){
    $("#datepicker").datepicker({
        autoclose: true
    });
     });
	var token='{{Session::token()}}'
	var Url
	var province=document.getElementById('province')
	var districts=document.getElementById('district')
	var sectors=document.getElementById('sector')
	var sectorOptions=sectors.options
	var districtOptions=districts.options
	function clearOption()
	{
       var child1=document.createElement('option')
       var child2=document.createElement('option')
       var value1=document.createTextNode('Select District')
       var value2=document.createTextNode('Select Sector')
       child1.appendChild(value1)
       child2.appendChild(value2)
       districts.innerHTML=null
       districts.appendChild(child1)
       sectors.innerHTML=null
	   sectors.appendChild(child2)
	}
		function clearOptionSector()
		{
	       var child=document.createElement('option')
	       var value=document.createTextNode('Select Sector')
	       child.appendChild(value)
	       sectors.innerHTML=null
	       sectors.appendChild(child)
		}
	function getDistricts(e)
	{
		var Index=province.selectedIndex
		var value =province[Index].innerHTML
		Url='{{url('provinces')}}'+'/' + Index
		$.ajax({
			method:'GET',
			url:Url
		}).done(function(msg){
		   console.log(msg.districts)
		   clearOption()
		   var districtItems=msg.districts
		   for(var i in districtItems)
		   { 
             var option=new Option(districtItems[i].name,districtItems[i].id)
             districtOptions.add(option,districtOptions.length)
		   }
		})
	}
		function getSectors(e)
		{
           var Index=districts.selectedIndex
           Url='{{url('districts')}}'+'/' + Index
           $.ajax({
           	method:'GET',
           	url:Url
           }).
           done(function(msg){
           	clearOptionSector()
           	var sectorItems=msg.sectors
           	for(var i in sectorItems)
           	{
           	var option=new Option(sectorItems[i].name,sectorItems[i].id)
            sectorOptions.add(option,sectorOptions.length)	
           	}
           })
         
		}
	province.addEventListener('change',getDistricts)
	districts.addEventListener('change',getSectors)
</script>
@endsection
<script type="text/javascript">
  	setTimeout(function(){
		activateNewAccidentForm();
	}, 1000);
</script>