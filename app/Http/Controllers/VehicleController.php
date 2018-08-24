<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Exception;
use Auth;
use App\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //Save the new vehicle
        try{
            $check = DB::select("SELECT * FROM Vehicle WHERE accidentId=? && type=? && mark=? && category=? && (plate=? || shasis=?)"
                                , array($request->accident, $request->vehicleType,$request->mark,$request->type,$request->plate,$request->chasis));
            if(count($check) == 0){
                $vehicle = Vehicle::create(
                                        array(
                                            'accidentId'    => $request->accident, 
                                            'userId'        => Auth::id(), 
                                            'type'          => $request->vehicleType, 
                                            'mark'          => $request->mark,
                                            'category'      => $request->type, 
                                            'plate'         => $request->plate, 
                                            'shasis'        => $request->chasis, 
                                            'status'        => 1, 
                                            'amande'        => $request->amande,
                                            'owner'        => $request->owner
                                        )
                                    );
                if($vehicle->id){
                    return redirect("/vehicle/".$request->accident);
                }
            }
        } catch(Exception $e){
            //print Found Error
            echo $e->getMessage();
        }
        //// Get the current User station
        $station = DB::select("SELECT   a.stationId AS stationId
                                        FROM User AS a
                                        WHERE a.id = ?
                                        ", array(Auth::id()) );
        //var_dump($station);
        // Get the list of current accident
        $accident = DB::select("SELECT a.comment AS comment,
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
                                        COUNT(l.id) AS vehicles,
                                        COUNT(m.id) AS identification
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
                                        LEFT JOIN Vehicle AS l
                                            ON a.id = l.accidentId
                                        LEFT JOIN Identification AS m
                                            ON a.id = m.accidentId
                                        WHERE a.id = ?
                                        GROUP BY a.id
                                        ", array($station[0]->stationId, $request->accident));
        //get the list of registered vehicle
        $vehicles = DB::select("SELECT  a.id AS id,
                                        a.type AS type,
                                        a.mark AS mark,
                                        a.plate AS plate,
                                        a.owner AS owner,
                                        a.shasis AS shasis,
                                        a.status AS status,
                                        a.amande AS amande
                                        FROM Vehicle AS a
                                        WHERE a.accidentId = ?
                                        ", array($request->accident));
        // var_dump($accident);
        return view('adminlte::vehicle.view')
                                        ->with('accident',$accident)
                                        ->with('vehicles', $vehicles)
                                        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(@$_GET['rowid'] && is_numeric($_GET['rowid'])){
            DB::statement("UPDATE Vehicle SET status=? WHERE id=?", array($_GET['status'], $_GET['rowid']));
        }
        //// Get the current User station
        $station = DB::select("SELECT   a.stationId AS stationId
                                        FROM User AS a
                                        WHERE a.id = ?
                                        ", array(Auth::id()) );
        // var_dump($station);
        // Get the list of current accident
        $accident = DB::select("SELECT a.comment AS comment,
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
                                        COUNT(l.id) AS vehicles,
                                        COUNT(m.id) AS identification,
                                        a.status AS status
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
                                        LEFT JOIN Vehicle AS l
                                            ON a.id = l.accidentId
                                        LEFT JOIN Identification AS m
                                            ON a.id = m.accidentId
                                        WHERE a.id = ?
                                        GROUP BY a.id
                                        ", array($station[0]->stationId, $id));
        //get the list of registered vehicle
        $vehicles = DB::select("SELECT  a.id AS id,
                                        IF(a.type = 1, 'Car',
                                            IF(a.type = 2, 'Moto',
                                                'Bicycle'
                                            )
                                        ) AS type,
                                        a.mark AS mark,
                                        a.plate AS plate,
                                        a.owner AS owner,
                                        a.shasis AS shasis,
                                        a.status AS status,
                                        a.amande AS amande
                                        FROM Vehicle AS a
                                        WHERE a.accidentId = ?
                                        ", array($id));
        if(@$_GET['create'] == 'new'){
            return view('adminlte::vehicle.create')
                                        ->with('accident',$accident)
                                        ->with('vehicles', $vehicles)
                                        ;
        }
        //var_dump($vehicles);
        return view('adminlte::vehicle.view')
                                        ->with('accident',$accident)
                                        ->with('vehicles', $vehicles)
                                        ;
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
        if(is_numeric($id)){
            DB::statement("UPDATE Vehicle SET status=? WHERE accidentId=? && status != ?", array(3, $id, 3));
        }
        //// Get the current User station
        $station = DB::select("SELECT   a.stationId AS stationId
                                        FROM User AS a
                                        WHERE a.id = ?
                                        ", array(Auth::id()) );
        // var_dump($station);
        // Get the list of current accident
        $accident = DB::select("SELECT  a.comment AS comment,
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
                                        COUNT(l.id) AS vehicles,
                                        COUNT(m.id) AS identification,
                                        a.status AS status
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
                                        LEFT JOIN Vehicle AS l
                                            ON a.id = l.accidentId
                                        LEFT JOIN Identification AS m
                                            ON a.id = m.accidentId
                                        WHERE a.id = ?
                                        GROUP BY a.id
                                        ", array($station[0]->stationId, $id));
        //get the list of registered vehicle
        $vehicles = DB::select("SELECT  a.id AS id,
                                        IF(a.type = 1, 'Car',
                                            IF(a.type = 2, 'Moto',
                                                'Bicycle'
                                            )
                                        ) AS type,
                                        a.mark AS mark,
                                        a.plate AS plate,
                                        a.owner AS owner,
                                        a.shasis AS shasis,
                                        a.status AS status,
                                        a.amande AS amande
                                        FROM Vehicle AS a
                                        WHERE a.accidentId = ?
                                        ", array($id));
        if(@$_GET['create'] == 'new'){
            return view('adminlte::vehicle.create')
                                        ->with('accident',$accident)
                                        ->with('vehicles', $vehicles)
                                        ;
        }
        //var_dump($vehicles);
        return view('adminlte::vehicle.view')
                                        ->with('accident',$accident)
                                        ->with('vehicles', $vehicles)
                                        ;
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
