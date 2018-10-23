<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'guest'], function () {
	Route::get('/', function () {
	    return view('welcome');
	});
});
    Route::get('districts',[
    'uses'=>'DistrictController@index',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('districts.index');
    Route::put('districts/{id}',[
    'uses'=>'DistrictController@update',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('districts.update');
    Route::get('districts/{id}',[
    'uses'=>'DistrictController@show',
    ])->name('districts.show');
    Route::post('districts',[
    'uses'=>'DistrictController@store',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('districts.store');
    //sector routes
    Route::get('sectors',[
    'uses'=>'SectorsController@index',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('sectors.index');
    Route::put('sectors/{id}',[
    'uses'=>'SectorsController@update',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('sectors.update');
    Route::post('sectors',[
    'uses'=>'SectorsController@store',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('sectors.store');
    Route::post('sectors/import',[
    'uses'=>'SectorsController@import',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('sectors.import');
    //stations routes
    Route::get('stations',[
    'uses'=>'StationController@index',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('stations.index');
    Route::put('stations/{id}',[
    'uses'=>'StationController@update',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('stations.update');
    Route::post('stations',[
    'uses'=>'StationController@store',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('stations.store');
    Route::post('stations/import',[
    'uses'=>'StationController@import',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('stations.import');
    Route::resource('provinces', 'ProvinceController');
    Route::group(['middleware' => 'auth'], function () {
    Route::resource('accident', 'AccidentController');
    Route::resource('vehicle', 'VehicleController');
    Route::resource('users', 'UsersController');
    //user routes
    Route::get('users',[
    'uses'=>'UsersController@index',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('users.index');
    Route::put('users/{id}',[
    'uses'=>'UsersController@update',
    ])->name('users.update');
     Route::get('users/{id}',[
    'uses'=>'UsersController@update',
    ])->name('users.show');
    Route::post('users',[
    'uses'=>'UsersController@store',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('users.store');
    Route::put('users/assign/{id}',[
    'uses'=>'UsersController@assign',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
    ])->name('users.assign');
    Route::put('users/assign/my/{id}',[
    'uses'=>'UsersController@assignMy',
    ])->name('users.assignmy');
    Route::put('users/assign/role/{id}',[
    'uses'=>'UsersController@assignRole',
    ])->name('users.assignrole');
    Route::resource('ids', 'IDsController');
    Route::get('report', 
     [
    'uses'=>'ReportController@index',
    'middleware'=>'roles',
    'roles'=>['user']
     ]
    );
    Route::get('district/report',[
    'uses'=>'DistrictReportController@index',
    'middleware'=>'roles',
    'roles'=>['district-admin']
]);
    Route::get('district/{reportId}',[
    'uses'=>'DistrictReportController@report1',
    'middleware'=>'roles',
    'roles'=>['district-admin']
]);
    Route::get('province/report',[
    'uses'=>'ProvinceReportController@index',
    'middleware'=>'roles',
    'roles'=>['province-admin']
]);
    Route::get('province/{reportId}',[
    'uses'=>'ProvinceReportController@report1',
    'middleware'=>'roles',
    'roles'=>['province-admin']
]);
    Route::get('overall/report',[
    'uses'=>'OverallReportController@index',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
]);
    Route::get('overall/{reportId}',[
    'uses'=>'OverallReportController@report1',
    'middleware'=>'roles',
    'roles'=>['overall-admin']
]);
    Route::get('reports/print/{reportId}',[
    'uses'=>'ReportController@report1',
    'middleware'=>'roles',
    'roles'=>['user']
   ]);
});
