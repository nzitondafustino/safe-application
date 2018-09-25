<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Exception;
use Auth;
use App\Accident;
use App\User;
use App\Vehicle;
use App\ID;
use PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accidents=Accident::all();
        $totalAccident=$accidents->count();
        $user=User::find(Auth::id());
        $station=$user->station;
        $startDate  = strtotime(date("Y-m-01", time() ));
        $endDate    = time();
        $injury=$accidents->sum('injury');
        $dead=$accidents->sum('dead');
        $holdCars=Vehicle::where('status',1)
                        ->where('type',1)
                        ->get()->count();
        $holdMotocycle=Vehicle::where('status',1)
                        ->where('type',2)
                         ->get()->count();
        $holdBicycle=Vehicle::where('status',1)
                        ->where('type',3)
                         ->get()->count();
        $holdLicense=ID::where('type',1)
                           ->get()
                           ->count();
        $holdMatriculation=ID::where('type',2)
                           ->get()
                           ->count();
        $holdInsurance=ID::where('type',3)
                           ->get()
                           ->count();          
        return view('adminlte::report.show')->with('accidents',$totalAccident)
                                            ->with('injury',$injury)
                                            ->with('dead',$dead)
                                            ->with('cars',$holdCars)
                                            ->with('motocycle',$holdMotocycle)
                                            ->with('bicycle',$holdBicycle)
                                            ->with('license',$holdLicense)
                                            ->with('matriculation',$holdMatriculation)
                                            ->with('insurance',$holdInsurance)
                                            ->with('startDate', date("m/01/Y", time() ))
                                            ->with('endDate', date("m/d/Y", time() ))
                                            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report1(Request $request,$reportId)
    {
        $startDate  = strtotime($request->startdate);
        $endDate    = strtotime($request->enddate);
        $user=User::find(Auth::id());
        if($startDate > $endDate){
            $t = $startDate;
            $startDate = $endDate;
            $endDate = $t;
        }
      if($reportId==1)
         {
          $accidents=Accident::where('user_id',Auth::id())->get();
          $pdf = PDF::loadHTML(view('adminlte::reports.report1')
                                    ->with('accidents',$accidents)
                                    ->with('user',$user)
                                    ->with('title',"Accident Summary Report")
                                    ->with('date',"From ".date("Y-m-d", $startDate)." To ".date("Y-m-d", $endDate))
                                    );
            return $pdf->stream('homw.pdf');

         }
         elseif($reportId==2)
         {        
                  $vehicleType="Car Accident Report";
                  $vehicles=Vehicle::where('user_id',Auth::id())
                                                       ->where('type',1)
                                                       ->get();
                 if($request->type==2)
                 {
                 $vehicles=Vehicle::where('user_id',Auth::id())
                                                       ->where('type',2)
                                                       ->get();
                 $vehicleType="Motocycle Accident Report";
                 }
                 elseif($request->type==3)
                 {
                  $vehicles=Vehicle::where('user_id',Auth::id())
                                                       ->where('type',3)
                                                       ->get();
                 $vehicleType="Bicycle Accident Report";
                 }
                 elseif($request->type==4)
                 {
                 $vehicles=Vehicle::where('user_id',Auth::id())
                                                       ->get();
                 $vehicleType="Vehicle Accident Report"; 
                 }
                 $pdf = PDF::loadHTML(view('adminlte::reports.report2')
                                 ->with('vehicles',$vehicles)
                                 ->with('user',$user)
                                 ->with('title',$vehicleType)
                                 ->with('date',"From ".date("Y-m-d", $startDate)." To ".date("Y-m-d", $endDate)));
                return $pdf->stream('homw.pdf');
        }
        elseif($reportId==3)
                 $title="Licence Summary Report";
                 $ids=ID::where('user_id',Auth::id())
                                              ->where('type',1)
                                              ->get();
                 if($request->type==2)
                 {
                 $title="Immatriculation Summary Report";
                 $ids=ID::where('user_id',Auth::id())
                                            ->where('type',2)
                                            ->get();
                 }
                 elseif($request->type==3)
                 {
                 $title="Insurance Summary Report";
                 $ids=ID::where('user_id',Auth::id())
                                            ->where('type',2)
                                            ->get();
                 }
                 elseif($request->type==4)
                 {
                 $title="Documents Summary Report";
                 $ids=ID::where('user_id',Auth::id())
                                            ->get();  
                 }
                 $pdf = PDF::loadHTML(view('adminlte::reports.report3')
                                 ->with('ids',$ids)
                                 ->with('user',$user)
                                 ->with('title',$title)
                                 ->with('date',"From ".date("Y-m-d", $startDate)." To ".date("Y-m-d", $endDate))
                                 );
         return $pdf->stream('homw.pdf');
    }
    public function generalreport()
    {

    }
   
}
