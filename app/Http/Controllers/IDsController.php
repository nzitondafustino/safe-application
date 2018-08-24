<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Exception;
use Auth;
use App\IDs;

class IDsController extends Controller
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
                                        ", array($station[0]->stationId, $_GET['id']));
        return view("adminlte::ids.create")->with('accident', $accident);
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
        $check = DB::select("SELECT * FROM Identification WHERE accidentId=? && type=? && number=? && owner=?"
                            , array($request->accident, $request->IdsType, $request->cardNo, $request->owner));
        if(count($check) == 0){
            $ids = IDs::create(
                            array(
                                'accidentId'    => $request->accident,
                                'userId'        => Auth::id(), 
                                'type'          => $request->IdsType, 
                                'number'        => $request->cardNo, 
                                'owner'         => $request->owner, 
                                'category'      => $request->category, 
                                'status'        => 1, 
                                'amande'        => $request->amande
                            )
                        );
            if($ids->id){
                return redirect("/ids/".$request->accident);
            }
        }
        return redirect("/ids/create");
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
                                        ", array($station[0]->stationId, $id));
        //get the list of registered vehicle
        $ids = DB::select("SELECT   a.id AS id,
                                    IF(a.type = 1, 'License',
                                        IF(a.type = 2, 'Immatriculation',
                                            'Insurance'
                                        )
                                    ) AS type,
                                    a.number AS number,
                                    COALESCE(a.category,'') AS category,
                                    a.owner AS owner,
                                    a.status AS status,
                                    a.amande AS amande
                                    FROM Identification AS a
                                    WHERE a.accidentId = ?
                                    ", array($id));
        return view("adminlte::ids.view")   ->with('accident', $accident)
                                            ->with('ids', $ids);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Update the status of the current record
        //var_dump($_GET);
        if(@$_GET['rowid'] && is_numeric($_GET['rowid'])){
            // here update database
            DB::statement("UPDATE Identification SET status = ? WHERE id = ?", array($_GET['status'], $_GET['rowid']));
        }
        //
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
                                        ", array($station[0]->stationId, $id));
        //get the list of registered vehicle
        $ids = DB::select("SELECT   a.id AS id,
                                    IF(a.type = 1, 'License',
                                        IF(a.type = 2, 'Immatriculation',
                                            'Insurance'
                                        )
                                    ) AS type,
                                    a.number AS number,
                                    COALESCE(a.category,'') AS category,
                                    a.owner AS owner,
                                    a.status AS status,
                                    a.amande AS amande
                                    FROM Identification AS a
                                    WHERE a.accidentId = ?
                                    ", array($id));
        return view("adminlte::ids.view")   ->with('accident', $accident)
                                            ->with('ids', $ids);

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
