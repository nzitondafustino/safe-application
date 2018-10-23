<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Exception;
use Auth;
use App\Accident;
use App\Province;
use App\Address;

class AccidentController extends Controller
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
        //get the list of available address
        $provinces=Province::all();
        return view('adminlte::accident.create',compact("provinces",$provinces));
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
            'province'      =>'required',
            'district'      =>'required',
            'sector'        =>'required',
            'comment'       =>'required|string',
            'datepicker'    =>'required|date',
            'dead'          =>'required|digits_between:1,4',
            'injury'        =>'required|digits_between:1,4'

        ]);
        //pick aall variable required
        $date = $request->datepicker;
        //var_dump($date);
        $comment =$request->comment;
        // $address = $request->address;
        $dead = $request->dead;
        $injury = $request->injury;

        try{
            $accident = Accident::create(array(
                    'user_id'    => Auth::id(),
                    'province_id'=>$request->province,
                    'district_id'=>$request->district,
                    'sector_id'  =>$request->sector,
                    'comment'   => $comment,
                    'date'      => strtotime($date),
                    'dead'      => $dead,
                    'injury'    => $injury
                ));
            if($accident){
                return view('adminlte::vehicle.create')->withAccident($accident);
            }
        } catch(Exception $e){
            
        return view('adminlte::accident.error')
                                            ->with('address', $address);
                                            ;
         
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accident=Accident::find($id);
        return view('adminlte::accident.show')->with('accident',$accident);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accident=Accident::find($id);
        $provinces=Province::all();
        $province=$accident->province;
        $districts=$province->districts;
        $district=$accident->district;
        $sectors=$district->sectors;
        return view('adminlte::accident.edit')->with('accident',$accident)
                                              ->with('provinces',$provinces)
                                              ->with('districts',$districts)
                                              ->with('sectors',$sectors);
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
            'province'      =>'required',
            'district'      =>'required',
            'sector'        =>'required',
            'comment'       =>'required|string',
            'datepicker'    =>'required|date',
            'dead'          =>'required|digits_between:1,4',
            'injury'        =>'required|digits_between:1,4'

        ]);
        $accident=Accident::find($id);
        $accident->province_id=$request->province;
        $accident->district_id=$request->district;
        $accident->sector_id=$request->sector;
        $accident->comment=$request->comment;
        $accident->date=$request->date;
        $accident->dead=$request->dead;
        $accident->injury=$request->injury;
        $accident->update();
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
