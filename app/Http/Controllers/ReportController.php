<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Exception;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $station = DB::select("SELECT   a.stationId AS stationId
                                        FROM User AS a
                                        WHERE a.id = ?
                                        ", array(Auth::id()) );
        $startDate  = strtotime(date("Y-m-01", time() ));
        $endDate    = time();
        $accidentSummary = DB::select("SELECT   COUNT(a.id) AS totalAccident
                                                FROM Accident AS a
                                                INNER JOIN User AS b
                                                ON a.userId = b.id
                                                WHERE a.date >= ? && a.date <= ? && b.stationId = ?
                                                ", array($startDate, $endDate, $station[0]->stationId));
        $injurySummary = DB::select("SELECT COALESCE(SUM(a.injury), 0) AS totalInjury
                                            FROM Accident AS a
                                            INNER JOIN User AS b
                                            ON a.userId = b.id
                                            WHERE a.date >= ? && a.date <= ? && b.stationId = ?
                                            ", array($startDate, $endDate, $station[0]->stationId));
        $deadSummary = DB::select("SELECT   COALESCE(SUM(a.dead),0) AS totalDead
                                            FROM Accident AS a
                                            INNER JOIN User AS b
                                            ON a.userId = b.id
                                            WHERE a.date >= ? && a.date <= ? && b.stationId = ?
                                            ", array($startDate, $endDate, $station[0]->stationId));
        $holdCars = DB::select("SELECT  COUNT(a.id) AS totalCar
                                        FROM Accident AS a
                                        INNER JOIN User AS b
                                        ON a.userId = b.id
                                        INNER JOIN Vehicle AS c
                                        ON a.id = c.accidentId
                                        WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                        ", array($startDate, $endDate, $station[0]->stationId, 1, 1));
        
        $holdMotocycle = DB::select("SELECT COUNT(a.id) AS totalMotocycle
                                            FROM Accident AS a
                                            INNER JOIN User AS b
                                            ON a.userId = b.id
                                            INNER JOIN Vehicle AS c
                                            ON a.id = c.accidentId
                                            WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                            ", array($startDate, $endDate, $station[0]->stationId, 1, 2));

        $holdBicycle = DB::select("SELECT   COUNT(a.id) AS totalBicycle
                                            FROM Accident AS a
                                            INNER JOIN User AS b
                                            ON a.userId = b.id
                                            INNER JOIN Vehicle AS c
                                            ON a.id = c.accidentId
                                            WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                            ", array($startDate, $endDate, $station[0]->stationId, 1, 3));
        $holdLicense = DB::select("SELECT   COUNT(a.id) AS totalLicense
                                            FROM Accident AS a
                                            INNER JOIN User AS b
                                            ON a.userId = b.id
                                            INNER JOIN Identification AS c
                                            ON a.id = c.accidentId
                                            WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                            ", array($startDate, $endDate, $station[0]->stationId, 1, 1));
        
        $holdMatriculation = DB::select("SELECT COUNT(a.id) AS totalMatriculation
                                                FROM Accident AS a
                                                INNER JOIN User AS b
                                                ON a.userId = b.id
                                                INNER JOIN Identification AS c
                                                ON a.id = c.accidentId
                                                WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                                ", array($startDate, $endDate, $station[0]->stationId, 1, 2));

        $holdInsurance = DB::select("SELECT     COUNT(a.id) AS totalInsurance
                                                FROM Accident AS a
                                                INNER JOIN User AS b
                                                ON a.userId = b.id
                                                INNER JOIN Identification AS c
                                                ON a.id = c.accidentId
                                                WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                                ", array($startDate, $endDate, $station[0]->stationId, 1, 3));
        
        return view('adminlte::report.show')->with('accidents',$accidentSummary[0]->totalAccident)
                                            ->with('injury',$injurySummary[0]->totalInjury)
                                            ->with('dead',$deadSummary[0]->totalDead)
                                            ->with('cars',$holdCars[0]->totalCar)
                                            ->with('motocycle',$holdMotocycle[0]->totalMotocycle)
                                            ->with('bicycle',$holdBicycle[0]->totalBicycle)
                                            ->with('license',$holdLicense[0]->totalLicense)
                                            ->with('matriculation',$holdMatriculation[0]->totalMatriculation)
                                            ->with('insurance',$holdInsurance[0]->totalInsurance)
                                            ->with('startDate', date("m/01/Y", time() ))
                                            ->with('endDate', date("m/d/Y", time() ))
                                            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         $station = DB::select("SELECT   a.stationId AS stationId
                                        FROM User AS a
                                        WHERE a.id = ?
                                        ", array(Auth::id()) );
        $startDate  = strtotime($_GET['startDate']);
        $endDate    = strtotime($_GET['endDate']);
        $accidentSummary = DB::select("SELECT   COUNT(a.id) AS totalAccident
                                                FROM Accident AS a
                                                INNER JOIN User AS b
                                                ON a.userId = b.id
                                                WHERE a.date >= ? && a.date <= ? && b.stationId = ?
                                                ", array($startDate, $endDate, $station[0]->stationId));
        $injurySummary = DB::select("SELECT COALESCE(SUM(a.injury),0) AS totalInjury
                                            FROM Accident AS a
                                            INNER JOIN User AS b
                                            ON a.userId = b.id
                                            WHERE a.date >= ? && a.date <= ? && b.stationId = ?
                                            ", array($startDate, $endDate, $station[0]->stationId));
        $deadSummary = DB::select("SELECT   COALESCE(SUM(a.dead),0) AS totalDead
                                            FROM Accident AS a
                                            INNER JOIN User AS b
                                            ON a.userId = b.id
                                            WHERE a.date >= ? && a.date <= ? && b.stationId = ?
                                            ", array($startDate, $endDate, $station[0]->stationId));
        $holdCars = DB::select("SELECT  COUNT(a.id) AS totalCar
                                        FROM Accident AS a
                                        INNER JOIN User AS b
                                        ON a.userId = b.id
                                        INNER JOIN Vehicle AS c
                                        ON a.id = c.accidentId
                                        WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                        ", array($startDate, $endDate, $station[0]->stationId, 1, 1));
        
        $holdMotocycle = DB::select("SELECT COUNT(a.id) AS totalMotocycle
                                            FROM Accident AS a
                                            INNER JOIN User AS b
                                            ON a.userId = b.id
                                            INNER JOIN Vehicle AS c
                                            ON a.id = c.accidentId
                                            WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                            ", array($startDate, $endDate, $station[0]->stationId, 1, 2));

        $holdBicycle = DB::select("SELECT   COUNT(a.id) AS totalBicycle
                                            FROM Accident AS a
                                            INNER JOIN User AS b
                                            ON a.userId = b.id
                                            INNER JOIN Vehicle AS c
                                            ON a.id = c.accidentId
                                            WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                            ", array($startDate, $endDate, $station[0]->stationId, 1, 3));
        $holdLicense = DB::select("SELECT   COUNT(a.id) AS totalLicense
                                            FROM Accident AS a
                                            INNER JOIN User AS b
                                            ON a.userId = b.id
                                            INNER JOIN Identification AS c
                                            ON a.id = c.accidentId
                                            WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                            ", array($startDate, $endDate, $station[0]->stationId, 1, 1));
        
        $holdMatriculation = DB::select("SELECT COUNT(a.id) AS totalMatriculation
                                                FROM Accident AS a
                                                INNER JOIN User AS b
                                                ON a.userId = b.id
                                                INNER JOIN Identification AS c
                                                ON a.id = c.accidentId
                                                WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                                ", array($startDate, $endDate, $station[0]->stationId, 1, 2));

        $holdInsurance = DB::select("SELECT     COUNT(a.id) AS totalInsurance
                                                FROM Accident AS a
                                                INNER JOIN User AS b
                                                ON a.userId = b.id
                                                INNER JOIN Identification AS c
                                                ON a.id = c.accidentId
                                                WHERE a.date >= ? && a.date <= ? && b.stationId = ? && c.status = ? && c.type = ?
                                                ", array($startDate, $endDate, $station[0]->stationId, 1, 3));
        
        return json_encode(array("accidents"        => $accidentSummary[0]->totalAccident, 
                                 "injury"           => $injurySummary[0]->totalInjury, 
                                 "dead"             => $deadSummary[0]->totalDead, 
                                 "cars"             => $holdCars[0]->totalCar, 
                                 "motocycle"        => $holdMotocycle[0]->totalMotocycle, 
                                 "bicycle"          => $holdBicycle[0]->totalBicycle, 
                                 "license"          => $holdLicense[0]->totalLicense, 
                                 "matriculation"    => $holdMatriculation[0]->totalMatriculation, 
                                 "insurance"        => $holdInsurance[0]->totalInsurance,
                                 "startDate"        => $_GET['startDate'],
                                 "endDate"          => $_GET['endDate']
                                )
                            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
