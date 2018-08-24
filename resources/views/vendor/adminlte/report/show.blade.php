@extends('adminlte::layouts.rpt')

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
							<!-- form start -->
				            <form class="form-horizontal" method="post" action="/accident">
				            	{{ csrf_field() }}
				            	<div class="row">
					            	<div class="col-sm-5">
					            		Start Date
					            	</div>
					            	<div class="col-sm-5">
					            		End Date
					            	</div>
					            	<div class="col-sm-2">
					            		
					            	</div>
				            	</div>
				            	<div class="row">
					            	<div class="col-sm-5">
					            		<div class="input-group date col-sm-12">
						                  	<div class="input-group-addon">
						                    	<i class="fa fa-calendar"></i>
						                  	</div>
						                  	<input class="form-control pull-right" id="datepicker1" name="datepicker1" type="text" value="{{$startDate}}" data-provide="datepicker-inline">
						                </div>
					            	</div>
					            	<div class="col-sm-5">
					            		<div class="input-group date col-sm-12">
						                  	<div class="input-group-addon">
						                    	<i class="fa fa-calendar"></i>
						                  	</div>
						                  	<input class="form-control pull-right" id="datepicker2" name="datepicker2" type="text" value="{{$endDate}}" data-provide="datepicker-inline">
						                </div>
					            	</div>
					            	<div class="col-sm-2">
					            		<button type="button" id="generate" class="btn btn-block btn-primary btn-flat">Generate</button>
					            	</div>
				            	</div>
				            </form>
			            </div>
			        </div>
					
					<div class="box-body">
						
				        <div class="col-md-4 col-sm-6 col-xs-12">
				          <div class="info-box">
				            <span class="info-box-icon bg-aqua"><i class="fa fa-bullhorn"></i></span>

				            <div class="info-box-content">
				              <span class="info-box-text">Accidents</span>
				              <span class="info-box-number" id="accidents">{{$accidents}}</span>
				              <span id="accidentsprint"><a href="/reports/print/1?startdate={{$startDate}}&enddate={{$endDate}}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print</a></span>
				            </div>
				            <!-- /.info-box-content -->
				          </div>
				          <!-- /.info-box -->
				        </div>
				        <!-- /.col -->
				        <div class="col-md-4 col-sm-6 col-xs-12">
				          <div class="info-box">
				            <span class="info-box-icon bg-yellow"><i class="fa fa-wheelchair "></i></span>

				            <div class="info-box-content">
				              <span class="info-box-text">Injuried</span>
				              <span class="info-box-number" id="injury">{{$injury}}</span>
				            </div>
				            <!-- /.info-box-content -->
				          </div>
				          <!-- /.info-box -->
				        </div>
				        <!-- /.col -->
				        <div class="col-md-4 col-sm-6 col-xs-12">
				          <div class="info-box">
				            <span class="info-box-icon bg-red"><i class="fa fa-deaf "></i></span>

				            <div class="info-box-content">
				              <span class="info-box-text">Dead</span>
				              <span class="info-box-number" id="dead">{{$dead}}</span>
				            </div>
				            <!-- /.info-box-content -->
				          </div>
				          <!-- /.info-box -->
				        </div>
				        <!-- /.col -->
      
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
	
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="box" style="padding: 6px;">
					<div class="box-body">
						<div class="row">
											
					        <div class="col-md-4 col-sm-6 col-xs-12">
					          <div class="info-box bg-aqua">
					            <span class="info-box-icon"><i class="fa fa-car"></i></span>

					            <div class="info-box-content">
					              <span class="info-box-text">Cars</span>
					              <span class="info-box-number" id="cars">{{$cars}} <span id="carsprint"><a style="color:#fff;" href="/reports/print/2?type=3&startdate={{$startDate}}&enddate={{$endDate}}" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span></span>


					              <div class="progress">
					              	<?php
					              	$sum = ($cars + $motocycle + $bicycle);
					              	if($sum == 0)
					              		$sum = 1;
					              	$per = round(($cars * 100)/($sum), 1);
					              	?>
					                <div class="progress-bar" id="barCars" style="width: {{$per}}%"></div>
					              </div>
					                  <span class="progress-description" id="barCarsDesc">
					                    {{$per}}% of Vehicles
					                  </span>
					            </div>
					            <!-- /.info-box-content -->
					          </div>
					          <!-- /.info-box -->
					        </div>
					        <!-- /.col -->
					        <div class="col-md-4 col-sm-6 col-xs-12">
					          <div class="info-box bg-green">
					            <span class="info-box-icon"><i class="fa fa-motorcycle"></i></span>

					            <div class="info-box-content">
					              <span class="info-box-text">MotoCycle</span>
					              <span class="info-box-number" id="motocycle">{{$motocycle}} <span id=""><a style="color:#fff;" href="/reports/print/2?type=2&startdate={{$startDate}}&enddate={{$endDate}}" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span></span>

					              <div class="progress">
					                <div class="progress-bar" id="barMotocycle" style="width: {{$per = round(($motocycle * 100)/($sum), 1)}}%"></div>
					              </div>
					                  <span class="progress-description" id="barMotocycleDesc">
					                    {{$per}}% of Vehicles
					                  </span>
					            </div>
					            <!-- /.info-box-content -->
					          </div>
					          <!-- /.info-box -->
					        </div>
					        <!-- /.col -->
					        <div class="col-md-4 col-sm-6 col-xs-12">
					          <div class="info-box bg-yellow">
					            <span class="info-box-icon"><i class="fa fa-bicycle"></i></span>

					            <div class="info-box-content">
					              <span class="info-box-text">Bycles</span>
					              <span class="info-box-number" id="bicycle">{{$bicycle}} <span id=""><a style="color:#fff;" href="/reports/print/2?type=3&startdate={{$startDate}}&enddate={{$endDate}}" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span></span>

					              <div class="progress">
					                <div class="progress-bar" id="barBicycle" style="width: {{$per = round(($bicycle * 100)/($sum), 1)}}%"></div>
					              </div>
					                  <span class="progress-description" id="barBicycleDesc">
					                    {{$per}}% of Vehicles
					                  </span>
					            </div>
					            <!-- /.info-box-content -->
					          </div>
					          <!-- /.info-box -->
					        </div>
					        <!-- /.col -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid spark-screen">
		<div class="row">
			<input type="hidden" name="startDate" id="startDateInput" value="{{$startDate}}">
			<input type="hidden" name="endDate" id="endDateInput" value="{{$endDate}}">
			<div class="col-md-12">
				<div class="box" style="padding: 6px;">
					<div class="box-body">
						<div class="row">
					        <div class="col-lg-3 col-xs-4">
					          <!-- small box -->
					          <div class="small-box bg-aqua">
					            <div class="inner">
					              <h3 id="License">{{$license}}</h3>

					              <p>License</p>
					            </div>
					            <div class="icon">
					              <i class="fa fa-credit-card"></i>
					            </div>
					            <a href="/reports/print/3?type=1&startdate={{$startDate}}&enddate={{$endDate}}" target="_blank" onclick="$(this).attr('href', '/reports/print/3?type=1&startdate=' + $('#startDateInput').val() + '&enddate=' + $('#endDateInput').val());" class="small-box-footer">
					              Print <i class="fa fa-arrow-circle-right"></i>
					            </a>
					          </div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-4">
					          <!-- small box -->
					          <div class="small-box bg-green">
					            <div class="inner">
					              <h3 id="Immatriculation">{{$matriculation}}</h3>

					              <p>Immatriculation</p>
					            </div>
					            <div class="icon">
					              <i class="fa fa-credit-card"></i>
					            </div>
					            <a href="/reports/print/3?type=2&startdate={{$startDate}}&enddate={{$endDate}}" target="_blank" onclick="$(this).attr('href', '/reports/print/3?type=2&startdate=' + $('#startDateInput').val() + '&enddate=' + $('#endDateInput').val());" class="small-box-footer">
					              Print <i class="fa fa-arrow-circle-right"></i>
					            </a>
					          </div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-4">
					          <!-- small box -->
					          <div class="small-box bg-yellow">
					            <div class="inner">
					              <h3 id="Insurance">{{$insurance}}</h3>

					              <p>Insurance</p>
					            </div>
					            <div class="icon">
					              <i class="fa fa-credit-card"></i>
					            </div>
					            <a href="/reports/print/3?type=3&startdate={{$startDate}}&enddate={{$endDate}}" target="_blank" onclick="$(this).attr('href', '/reports/print/3?type=3&startdate=' + $('#startDateInput').val() + '&enddate=' + $('#endDateInput').val());" class="small-box-footer">
					              Print <i class="fa fa-arrow-circle-right"></i>
					            </a>
					          </div>
					        </div>
					        <!-- ./col -->
					      
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		setTimeout(function(){
			$("#generate").click(function(){
				var url = "/report/1?startDate=" + $("#datepicker1").val() + "&endDate=" + $("#datepicker2").val();
  				$.getJSON(url, function(data){
  					//console.log(data);
  					$("#startDateInput").val(data.startDate);
  					$("#endDateInput").val(data.endDate);
  					$("#accidents").html(data.accidents);
  					$("#accidentsprint").html('<a href="/reports/print/1?startdate=' + data.startDate  + '&enddate=' + data.endDate  + '" target="_blank"><i class="glyphicon glyphicon-print"></i> Print</a>');
  					//$("#carsprint").html('<a href="/reports/print/2?startdate=' + data.startDate  + '&enddate=' + data.endDate  + '" target="_blank"><i class="glyphicon glyphicon-print"></i> Print</a>');
  					$("#injury").html(data.injury);
  					$("#dead").html(data.dead);

  					var sum = (data.cars * 1) + (data.motocycle * 1) + (data.bicycle*1);
  					if(sum == 0){
  						sum = 1;
  					}
  					var per = Math.round(data.cars*100/sum);
  					$("#barCarsDesc").html( per + "% Of Vehicles");
  					$("#barCars").css("width", per+"%");
  					var per = Math.round(data.motocycle*100/sum);
  					$("#barMotocycleDesc").html( per + "% Of Vehicles");
  					$("#barMotocycle").css("width", per+"%");
  					var per = Math.round(data.bicycle*100/sum);
  					$("#barBicycleDesc").html( per + "% Of Vehicles");
  					$("#barBicycle").css("width", per+"%");
  					//console.log(per);

  					$("#cars").html(data.cars + '&nbsp;<span id="carsprint"><a style="color:#fff;" href="/reports/print/2?type=1&startdate=' + data.startDate  + '&enddate=' + data.endDate  + '" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span>');
  					$("#motocycle").html(data.motocycle + '&nbsp;<span id="carsprint"><a style="color:#fff;" href="/reports/print/2?type=2&startdate=' + data.startDate  + '&enddate=' + data.endDate  + '" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span>');
  					$("#bicycle").html(data.bicycle + '&nbsp;<span id="carsprint"><a style="color:#fff;" href="/reports/print/2?type=3&startdate=' + data.startDate  + '&enddate=' + data.endDate  + '" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span>');

  					$("#License").html(data.license);
  					$("#Immatriculation").html(data.matriculation);
  					$("#Insurance").html(data.insurance);
  				});
			});
		},5000);
	</script>
@endsection
