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

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
    Route::resource('accident', 'AccidentController');
    Route::resource('vehicle', 'VehicleController');
    Route::resource('ids', 'IDsController');
    Route::resource('report', 'ReportController');

    Route::get('reports/print/{reportId}', function($reportId){
    	$startDate  = strtotime($_GET['startdate']);
        $endDate    = strtotime($_GET['enddate']);
        if($startDate > $endDate){
        	$t = $startDate;
        	$startDate = $endDate;
        	$endDate = $t;
        }
    	//// Get the current User station
        $station = DB::select("SELECT   a.stationId AS stationId,
                                        b.name AS name,
                                        a.name AS user
                                        FROM User AS a
                                        INNER JOIN Station AS b
                                        ON a.stationId = b.id
                                        WHERE a.id = ?
                                        ", array(Auth::id()) );
        // var_dump($station);
        if($reportId == 1){
	        $accidents = DB::select("SELECT a.comment AS comment,
	                                        a.dead AS dead,
	                                        a.id AS id,
	                                        a.injury AS injury,
	                                        DATE_FORMAT(FROM_UNIXTIME(a.date),'%Y-%m-%d') AS date,
	                                        CONCAT(
	                                            f.name, '-',
	                                            g.name, '-',
	                                            h.name, '-',
	                                            i.name
	                                        ) AS address,
	                                        COALESCE(l.vehicles,0) AS vehicles,
	                                        COALESCE(m.identification,0) AS identification
	                                        FROM Accident AS a
	                                        INNER JOIN Address AS b
	                                        ON a.addressId  = b.id
	                                        INNER JOIN User AS c
	                                        ON a.userId = c.id
	                                        INNER JOIN Station AS d
	                                        ON c.stationId = d.id && d.id = ?
	                                        INNER JOIN Province AS e
	                                        ON b.proviceId = e.id
	                                        INNER JOIN District AS f
	                                        ON b.districtId = f.id
	                                        INNER JOIN Sector AS g
	                                        ON b.sectorId = g.id
	                                        INNER JOIN Cell AS h
	                                        ON b.cellId = h.id
	                                        INNER JOIN village AS i
	                                        ON b.villageId = i.id
	                                        LEFT JOIN (
	                                            SELECT  COUNT(a.id) AS vehicles,
	                                                    a.accidentId AS accidentId
	                                                    FROM Vehicle AS a
	                                                    GROUP BY a.accidentId
	                                        ) AS l
	                                        ON a.id = l.accidentId
	                                        LEFT JOIN (
	                                            SELECT  COUNT(a.id) AS identification,
	                                                    a.accidentId AS accidentId
	                                                    FROM Identification AS a
	                                                    GROUP BY a.accidentId
	                                        ) AS m
	                                        ON a.id = m.accidentId
	                                        WHERE a.status != ? && a.date >= ? && a.date <= ?
	                                        ", array($station[0]->stationId, 3, $startDate, $endDate));

	    	//$pdf = PDF::loadView('adminlte::reports.report1')->with("accidents", $accidents);
	    	$pdf = PDF::loadHTML(view('adminlte::reports.report1')
	                                ->with('accidents',$accidents)
	                                ->with('station',$station)
	                                ->with('title',"Accident Summary Report")
	                                ->with('date',"From ".date("Y-m-d", $startDate)." To ".date("Y-m-d", $endDate))
	                                );
			return $pdf->stream('homw.pdf');
		} else if($reportId == 2){
	        // var_dump($station);
	        // Get the list of current accident
	        $vehicles = DB::select("SELECT a.comment AS comment,
	                                        a.dead AS dead,
	                                        a.id AS id,
	                                        a.injury AS injury,
	                                        DATE_FORMAT(FROM_UNIXTIME(a.date),'%Y-%m-%d') AS date,
	                                        CONCAT(
	                                            f.name, '-',
	                                            g.name, '-',
	                                            h.name, '-',
	                                            i.name
	                                        ) AS address,
	                                        a.status AS status,
	                                        j.id AS vId,
	                                        IF(j.type = 1, 'Car',
	                                            IF(j.type = 2, 'Moto',
	                                                'Bicycle'
	                                            )
	                                        ) AS type,
	                                        j.mark AS mark,
	                                        j.plate AS plate,
	                                        j.owner AS owner,
	                                        j.shasis AS shasis,
	                                        j.status AS status,
	                                        j.amande AS amande
	                                        FROM Accident AS a
	                                        INNER JOIN Address AS b
	                                            ON a.addressId  = b.id
	                                        INNER JOIN User AS c
	                                            ON a.userId = c.id
	                                        INNER JOIN Station AS d
	                                            ON c.stationId = d.id && d.id = ?
	                                        INNER JOIN Province AS e
	                                            ON b.proviceId = e.id
	                                        INNER JOIN District AS f
	                                            ON b.districtId = f.id
	                                        INNER JOIN Sector AS g
	                                            ON b.sectorId = g.id
	                                        INNER JOIN Cell AS h
	                                            ON b.cellId = h.id
	                                        INNER JOIN village AS i
	                                            ON b.villageId = i.id
	                                        INNER JOIN Vehicle AS j
	                                        ON a.id = j.accidentId
	                                        WHERE a.date >= ? && a.date <= ? && j.type = ?
	                                        ", array($station[0]->stationId, $startDate, $endDate, $_GET['type']));
	        
	        $pdf = PDF::loadHTML(view('adminlte::reports.report2')
	                                ->with('vehicles',$vehicles)
	                                ->with('station',$station)
	                                ->with('title',"Cars Summary Report")
	                                ->with('date',"From ".date("Y-m-d", $startDate)." To ".date("Y-m-d", $endDate))
	                                );
			return $pdf->stream('homw.pdf');
		} else if($reportId == 3){
			$ids = DB::select("SELECT 	a.comment AS comment,
                                        a.dead AS dead,
                                        a.id AS id,
                                        a.injury AS injury,
                                        DATE_FORMAT(FROM_UNIXTIME(a.date),'%Y-%m-%d') AS date,
                                        CONCAT(
                                            f.name, '-',
                                            g.name, '-',
                                            h.name, '-',
                                            i.name
                                        ) AS address,
                                        m.id AS Iid,
	                                    IF(m.type = 1, 'License',
	                                        IF(m.type = 2, 'Immatriculation',
	                                            'Insurance'
	                                        )
	                                    ) AS type,
	                                    m.number AS number,
	                                    COALESCE(m.category,'') AS category,
	                                    m.owner AS owner,
	                                    m.status AS status,
	                                    m.amande AS amande
                                        FROM Accident AS a
                                        INNER JOIN Address AS b
                                            ON a.addressId  = b.id
                                        INNER JOIN User AS c
                                            ON a.userId = c.id
                                        INNER JOIN Station AS d
                                            ON c.stationId = d.id && d.id = ?
                                        INNER JOIN Province AS e
                                            ON b.proviceId = e.id
                                        INNER JOIN District AS f
                                            ON b.districtId = f.id
                                        INNER JOIN Sector AS g
                                            ON b.sectorId = g.id
                                        INNER JOIN Cell AS h
                                            ON b.cellId = h.id
                                        INNER JOIN village AS i
                                            ON b.villageId = i.id
                                        INNER JOIN Identification AS m
                                            ON a.id = m.accidentId
                                        WHERE a.date >= ? && a.date <= ? && m.type = ?
                                        ", array($station[0]->stationId, $startDate, $endDate, $_GET['type']));
			//var_dump($ids);
			$pdf = PDF::loadHTML(view('adminlte::reports.report3')
	                                ->with('ids',$ids)
	                                ->with('station',$station)
	                                ->with('title',"Document Summary Report")
	                                ->with('date',"From ".date("Y-m-d", $startDate)." To ".date("Y-m-d", $endDate))
	                                );
			return $pdf->stream('homw.pdf');
		}
    });
});


