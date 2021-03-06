<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Exception;
use Auth;
use App\Vehicle;
use App\Accident;

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
    public function create(Request $request)
    {
        if(!$accidentId=$request->id)
         {
            return redirect()->back();
         }
        $accident=Accident::find($accidentId);
        return view('adminlte::vehicle.create')->withAccident($accident);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'accident'      =>'required|digits:1',
            'vehicleType'      =>'required|digits:1',
            'status'        =>'required|digits:1',
            'mark'       =>'required|alpha',
            'plate'    =>'required|alpha_num',
            'chasis'          =>'required|alpha_num',
            'owner'        =>'required|string',
            'ownerLicence'        =>'required|digits_between:1,20',
            'ownerId'        =>'required|digits:15',
            'amande'        =>'required|digits_between:1,10',

        ]);
        $accidentId=$request->accident;
        $accident=Accident::find($accidentId);
        $vehicle=new Vehicle();
        $vehicle->accident_id=$accidentId;
        $vehicle->user_id=Auth::id();
        $vehicle->type=$request->vehicleType;
        $vehicle->status=$request->status;
        $vehicle->mark=$request->mark;
        $vehicle->plate=$request->plate;
        $vehicle->shasis=$request->chasis;
        $vehicle->owner=$request->owner;
        $vehicle->ownerLicence=$request->ownerLicence;
        $vehicle->ownerId=$request->ownerId;
        $vehicle->amande=$request->amande;
        $vehicle->save();
        return redirect('/home');

        // return view('adminlte::vehicle.view')
        //                                 ->with('accident',$accident)
        //                                 ->with('vehicles', $vehicles)
        //                                 ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle=Vehicle::find($id);
        $accident=$vehicle->accident;
        $user=$accident->user;
        return view('adminlte::vehicle.view')->with('accident',$accident)
                                             ->with('user',$user)
                                             ->with('vehicle',$vehicle);
                                       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $vehicle=Vehicle::find($id);
      $accident=$vehicle->accident;
      return view('adminlte::vehicle.edit')->withAccident($accident)->withVehicle($vehicle);
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
         $this->validate($request,[
            'accident'      =>'required|digits:1',
            'vehicleType'      =>'required|digits:1',
            'status'        =>'required|digits:1',
            'mark'       =>'required|alpha',
            'plate'    =>'required|alpha_num',
            'chasis'          =>'required|alpha_num',
            'owner'        =>'required|string',
            'ownerLicence'        =>'required|digits_between:1,20',
            'ownerId'        =>'required|digits:15',
            'amande'        =>'required|digits_between:1,10',

        ]);
        $vehicle=Vehicle::find($id);
        $vehicle->type=$request->vehicleType;
        $vehicle->status=$request->status;
        $vehicle->mark=$request->mark;
        $vehicle->plate=$request->plate;
        $vehicle->shasis=$request->chasis;
        $vehicle->owner=$request->owner;
        $vehicle->ownerLicence=$request->ownerLicence;
        $vehicle->ownerId=$request->ownerId;
        $vehicle->amande=$request->amande;
        $vehicle->update();
        return redirect('/home');
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
