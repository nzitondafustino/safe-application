<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accident;
use Auth;
use App\User;
use App\vehicle;
use App\ID;
use PDF;
class OverallReportController extends Controller
{
    public function index()
    {
        $user=User::find(Auth::id());
        $station=$user->station;
        $startDate  = strtotime(date("Y-m-01", time() ));
        $endDate    = time();
        $datestart=date('Y-m-d',$startDate);
        $dateend=date('Y-m-d',$endDate);
        $accidents=Accident::whereDate('created_at','>=',$datestart)
                            ->whereDate('created_at','<=',$dateend)
                            ->get();
        $totalAccident=$accidents->count();
        $injury=$accidents->sum('injury');
        $dead=$accidents->sum('dead');
        $holdCars=Vehicle::where('type',1)
                            ->whereDate('created_on','>=',$datestart)
                            ->whereDate('created_on','<=',$dateend)
                            ->get()
                            ->count();
        $holdMotocycle=Vehicle::where('type',2)
                            ->whereDate('created_on','>=',$datestart)
                            ->whereDate('created_on','<=',$dateend)
                            ->get()
                            ->count();
        $holdBicycle=Vehicle::where('type',3)
                            ->whereDate('created_on','>=',$datestart)
                            ->whereDate('created_on','<=',$dateend)
                            ->get()
                            ->count();
        $holdLicense=ID::where('type',1)
                            ->whereDate('created_on','>=',$datestart)
                            ->whereDate('created_on','<=',$dateend)
                            ->get()
                            ->count();
        $holdMatriculation=ID::where('type',2)
                            ->whereDate('created_on','>=',$datestart)
                            ->whereDate('created_on','<=',$dateend)
                            ->get()
                            ->count();
        $holdInsurance=ID::where('type',3)
                            ->whereDate('created_on','>=',$datestart)
                            ->whereDate('created_on','<=',$dateend)
                            ->get()
                            ->count();          
        return view('adminlte::report.overall')->with('accidents',$totalAccident)
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
        $datestart=date('Y-m-d',$startDate);
        $dateend=date('Y-m-d',$endDate);
      if($reportId==1)
         {
         $accidents=Accident::whereDate('created_at','>=',$datestart)
                            ->whereDate('created_at','<=',$dateend)
                            ->get();
          $pdf = PDF::loadHTML(view('adminlte::reports.report1')
                                    ->with('accidents',$accidents)
                                    ->with('user',$user)
                                    ->with('title',"Accident Summary Report")
                                    ->with('date',"From ".date("d/m/Y", $startDate)." To ".date("d/m/Y" ,$endDate))
                                    );
            return $pdf->stream('homw.pdf');

         }
         elseif($reportId==2)
         {        
                $vehicleType="Car Accident Report";
                $vehicles=Vehicle::where('type',1)
                            ->whereDate('created_on','>=',$datestart)
                            ->whereDate('created_on','<=',$dateend)
                            ->get();
                 if($request->type==2)
                 {
                 $vehicles=Vehicle::where('type',2)
                            ->whereDate('created_on','>=',$datestart)
                            ->whereDate('created_on','<=',$dateend)
                            ->get();
                 $vehicleType="Motocycle Accident Report";
                 }
                 elseif($request->type==3)
                 {
                 $vehicles=Vehicle::where('type',2)
                            ->whereDate('created_on','>=',$datestart)
                            ->whereDate('created_on','<=',$dateend)
                            ->get();
                 $vehicleType="Bicycle Accident Report";
                 }
                 elseif($request->type==4)
                 {
                 $vehicles=Vehicle::whereDate('created_on','>=',$datestart)
                                   ->whereDate('created_on','<=',$dateend)
                                   ->get();
                 $vehicleType="Vehicle Accident Report"; 
                 }
                 $pdf = PDF::loadHTML(view('adminlte::reports.report2')
                                 ->with('vehicles',$vehicles)
                                 ->with('user',$user)
                                 ->with('title',$vehicleType)
                                 ->with('date',"From ".date("d/m/Y", $startDate)." To ".date("d/m/Y", $endDate)));
                return $pdf->stream('homw.pdf');
        }
        elseif($reportId==3)
                 $title="Licence Summary Report";
                 $ids=ID::where('type',1)
                                ->whereDate('created_on','>=',$datestart)
                                ->whereDate('created_on','<=',$dateend)
                                ->get();
                 if($request->type==2)
                 {
                 $title="Immatriculation Summary Report";
                 $ids=ID::where('type',2)
                                ->whereDate('created_on','>=',$datestart)
                                ->whereDate('created_on','<=',$dateend)
                                ->get();
                 }
                 elseif($request->type==3)
                 {
                 $title="Insurance Summary Report";
                 $ids=ID::where('type',3)
                                ->whereDate('created_on','>=',$datestart)
                                ->whereDate('created_on','<=',$dateend)
                                ->get();
                 }
                 elseif($request->type==4)
                 {
                 $title="Documents Summary Report";
                 $ids=ID::whereDate('created_on','>=',$datestart)
                          ->whereDate('created_on','<=',$dateend)
                          ->get(); 
                 }
                 $pdf = PDF::loadHTML(view('adminlte::reports.report3')
                                 ->with('ids',$ids)
                                 ->with('user',$user)
                                 ->with('title',$title)
                                 ->with('date',"From ".date("d/m/Y", $startDate)." To ".date("d/m/Y", $endDate))
                                 );
         return $pdf->stream('homw.pdf');
   }

}
