<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use DB;
use Auth;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        // Get the current User station
        $station = DB::select("SELECT   a.stationId AS stationId,
                                        b.name AS name
                                        FROM User AS a
                                        INNER JOIN Station AS b
                                        ON a.stationId = b.id
                                        WHERE a.id = ?
                                        ", array(Auth::id()) );
        // var_dump($station);
        // Get the list of current accident
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
                                        WHERE a.status != ?
                                        ", array($station[0]->stationId, 3));
        // var_dump($accident);
        return view('adminlte::home')
                                ->with('accidents',$accidents)
                                ;
    }
}