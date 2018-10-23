<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accident;
use Auth;
use App\User;
use App\District;
use PDF;
class DistrictReportController extends Controller
{
    public function index()
    {
        $district=District::find(Auth::user()->district->id);
        $accidents=$district->accidents;
        $totalAccident=$accidents->count();
        $user=User::find(Auth::id());
        $station=$user->station;
        $startDate  = date('Y-m-01',time());
        $endDate    = date('Y-m-d',time());
        $injury=$accidents->sum('injury');
        $dead=$accidents->sum('dead');
            $holdCars=$district->vehicles()->where('type',1)->whereDate('created_on','>=',$startDate)
                                                            ->whereDate('created_on','<=',$endDate)
                                                            ->get()->count();
            $holdMotocycle=$district->vehicles()->where('type',2) ->whereDate('created_on','>=',$startDate)
                                                                   ->whereDate('created_on','<=',$endDate)
                                                                   ->get()
                                                                   ->count();
            $holdBicycle=$district->vehicles()->where('type',3)->whereDate('created_on','>=',$startDate)
                                                               ->whereDate('created_on','<=',$endDate)
                                                               ->get()
                                                               ->count();
            $holdLicense=$district->identifications()->where('type',1)
                                                                ->whereDate('created_on','>=',$startDate)
                                                                ->whereDate('created_on','<=',$endDate)
                                                                ->get()
                                                                ->count();
            $holdMatriculation=$district->identifications()->where('type',2) 
                                                               ->whereDate('created_on','>=',$startDate)
                                                               ->whereDate('created_on','<=',$endDate)
                                                               ->get()
                                                               ->count();
            $holdInsurance=$district->identifications()->where('type',3)
                                                                ->whereDate('created_on','>=',$startDate)
                                                                ->whereDate('created_on','<=',$endDate)
                                                                ->get()
                                                                ->count();         
            return view('adminlte::report.district')->with('accidents',$totalAccident)
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
        $datestart=date('Y-m-d',strtotime($request->startdate));
        $dateend=date('Y-m-d',strtotime($request->enddate));
      if($reportId==1)
         {
          $accidents=Accident::where('district_id',Auth::user()->district->id)
                                                               ->whereDate('created_at','>=',$datestart)
                                                               ->whereDate('created_at','<=',$dateend)
                                                               ->get();
          $pdf = PDF::loadHTML(view('adminlte::reports.report1')
                                    ->with('accidents',$accidents)
                                    ->with('user',$user)
                                    ->with('title',"Accident Summary Report")
                                    ->with('date',"From ".date("d/m/Y", $startDate)." To ".date("d/m/Y", $endDate))
                                    );
            return $pdf->stream('homw.pdf');

         }
         elseif($reportId==2)
         { 
                  $district=District::find(Auth::user()->district->id);
                  $vehicleType="Car Accident Report";
                  $vehicles=$district->vehicles()->where('type',1)
                                                            ->whereDate('created_on','>=',$datestart)
                                                            ->whereDate('updated_on','<=',$dateend)
                                                            ->get();
                 if($request->type==2)
                 {
                 $vehicles=$district->vehicles()->where('type',2)
                                               ->whereDate('created_on','>=',$datestart)
                                                ->whereDate('updated_on','<=',$dateend)

                                                ->get();
                 $vehicleType="Motocycle Accident Report";
                 }
                 elseif($request->type==3)
                 {
                 $vehicles=$district->vehicles()->where('type',3)
                                                           ->whereDate('created_on','>=',$datestart)
                                                           ->whereDate('updated_on','<=',$dateend)
                                                            ->get();
                 $vehicleType="Bicycle Accident Report";
                 }
                 elseif($request->type==4)
                 {
                 $vehicles=$district->vehicles;
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
                 $district=District::find(Auth::user()->district->id);
                 $ids=$district->identifications()->where('type',1)
                                                 ->whereDate('created_on','>=',$datestart)
                                                 ->whereDate('updated_on','<=',$dateend)

                                                  ->get();
                 if($request->type==2)
                 {
                 $title="Immatriculation Summary Report";
                 $ids=$district->identifications()->where('type',2)
                                                            ->whereDate('created_on','>=',$datestart)
                                                            ->whereDate('updated_on','<=',$dateend)

                                                            ->get();
                 }
                 elseif($request->type==3)
                 {
                 $title="Insurance Summary Report";
                 $ids=$district->identifications()->where('type',3)
                                                  ->whereDate('created_on','>=',$datestart)
                                                  ->whereDate('updated_on','<=',$dateend)

                                                  ->get();
                 }
                 elseif($request->type==4)
                 {
                 $title="Documents Summary Report";
                 $ids=$district->identifications; 
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
