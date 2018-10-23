<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\Province;
use App\District;
use DB;

class SectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces=Province::all();
        $sectors=Sector::paginate(50);
        return view('adminlte::sectors.index')->withProvinces($provinces)->withSectors($sectors);
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
        'sector'  =>'required|alpha'
    ]);
     $sector=new Sector();
     $sector->district_id=$request->district;
     $sector->name=$request->sector;
     $sector->save();
     return redirect()->route('sectors.index');
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
     $sector=Sector::find($id);
     $sector->district_id=$request->district;
     $sector->name=$request->sector;
     $sector->update();
     return redirect()->route('sectors.index');
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
                $sector=Sector::where('name','LIKE',trim($data[1]))->where('district_id','=',$district->id)->first();
                if(!$sector)
                {
                    $sector=new Sector();
                    $sector->district_id=$district->id;
                    $sector->name=trim($data[1]);
                    $sector->save();                }
                }

        }
        $message=session()->flash('success','Data uploaded Successfuly');
        return redirect()->route('sectors.index')->withMessage($message);
    }
}
}
