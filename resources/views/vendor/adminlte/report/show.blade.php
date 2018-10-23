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
				            <form class="form-horizontal" method="get" name="myForm">
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
				              <span id="accidentsprint"><a id="accident" href="/reports/print/1?" target="_blank"><i class="glyphicon glyphicon-print"></i> Print</a></span>
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
											
					        <div class="col-md-3 col-sm-6 col-xs-12">
					          <div class="info-box bg-aqua">
					            <span class="info-box-icon"><i class="fa fa-car"></i></span>

					            <div class="info-box-content">
					              <span class="info-box-text">Cars</span>
					              <span class="info-box-number" id="cars">{{$cars}} <span id="carsprint"><a style="color:#fff;" href="/reports/print/2?type=1" id="car" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span></span>


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
					        <div class="col-md-3 col-sm-6 col-xs-12">
					          <div class="info-box bg-green">
					            <span class="info-box-icon"><i class="fa fa-motorcycle"></i></span>

					            <div class="info-box-content">
					              <span class="info-box-text">MotoCycle</span>
					              <span class="info-box-number" id="motocycle">{{$motocycle}} <span ><a style="color:#fff;" id="moto" href="/reports/print/2?type=2" class="getdate" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span></span>

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
					        <div class="col-md-3 col-sm-6 col-xs-12">
					          <div class="info-box bg-yellow">
					            <span class="info-box-icon"><i class="fa fa-bicycle"></i></span>

					            <div class="info-box-content">
					              <span class="info-box-text">Bycles</span>
					              <span class="info-box-number" id="bicycle">{{$bicycle}} <span id=""><a style="color:#fff;" id="bicycle"  href="/reports/print/2?type=3" target="_blank"><i class="glyphicon glyphicon-print"></i></a></span></span>

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
					        <div class="col-md-3">
					        	<a class="btn btn-primary" id="vehicles" href="/reports/print/2?type=4" id="vehicles">Generate  Vehicles Report</a>

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
					            <a  href="/reports/print/3?type=1" target="_blank" id="licence" class="small-box-footer getdate">
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
					            <a href="/reports/print/3?type=2" target="_blank" id="immatri" class="small-box-footer getdate">
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
					            <a href="/reports/print/3?type=3" target="_blank" id="insurence" class="small-box-footer getdate">
					              Print <i class="fa fa-arrow-circle-right"></i>
					            </a>
					          </div>
					        </div>
					         <div class="col-lg-3">
					          <a class="btn btn-primary getdate" id="documents" href="/reports/print/3?type=4">Generate Documents Report</a>
					      </div>

					        <!-- ./col -->
					      
					    </div>
					</div>
				</div>
			</div>
		</div>
@endsection