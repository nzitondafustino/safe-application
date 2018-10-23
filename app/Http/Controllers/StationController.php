<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\Station;
use App\District;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces=Province::all();
        $stations=Station::orderBy('name','ASC')->paginate(50);
        return view('adminlte::stations.index')->withProvinces($provinces)->withStations($stations);
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
        $this->validate($request,[
        'province' =>'required|digits_between:1,2',
        'district' =>'required|digits_between:1,2',
        'station'  =>'required|alpha'
    ]);
     $station=new Station();
     $station->district_id=$request->district;
     $station->name=$request->station;
     $station->save();
     return redirect()->route('stations.index');
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
    public function update(Request $request,$id)
    { 
     $station=Station::find($id);
     $station->district_id=$request->district;
     $station->name=$request->station;
     $station->update();
     return redirect()->route('stations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
         public function import(Request $request)
            {
                $this->validate($request,[
                    'file'=>'required|mimes:csv,txt'
                ]);
                if(($handle=fopen($_FILES['file']['tmp_name'], 'r')) !==FALSE)
                {
                    fgetcsv($handle);//remove the first line of exel or text file
                    $i=0;
                    while(($data=fgetcsv($handle,1000,',')) !==FALSE)
                    {
                        $district=District::where('name',trim($data[0]))->first();
                        if($district)
                        {
                        $station=Station::where('name','LIKE',trim($data[1]))->where('district_id','=',$district->id)->first();
                        if(!$station)
                        {
                            $station=new Station();
                            $station->district_id=$district->id;
                            $station->name=trim($data[1]);
                            $station->save();                }
                        }

        }
        $message=session()->flash('success','Data uploaded Successfuly');
        return redirect()->route('stations.index')->withMessage($message);
    }
}
}
