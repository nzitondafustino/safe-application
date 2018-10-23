<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Province;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces=Province::all();
        $districts=District::orderBy('name','ASC')->get();
        return view('adminlte::districts.index')->withProvinces($provinces)->withDistricts($districts);
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
            'province'=>'required|digits:1',
            'district'=>'required|alpha'
        ]);
        $district=new District();
        $district->province_id=$request->province;
        $district->name=$request->district;
        $district->save();
        return redirect()->route('districts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $district=District::find($id);
       $sectors=$district->sectors;
       $stations=$district->stations;
       return response(['sectors'=>$sectors,'stations'=>$stations]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district=District::find($id);
        $district->province_id=$request->province;
        $district->name=$request->district;
        $district->save();
        return redirect()->route('districts.index');
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
        $district=District::find($id);
        $district->province_id=$request->province;
        $district->name=$request->district;
        $district->update();
        return redirect()->route('districts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        return redirect()->route('districts.index');

    }
}
