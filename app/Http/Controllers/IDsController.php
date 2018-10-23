<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Exception;
use Auth;
use App\ID;
Use App\Accident;

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
    public function create(Request $request)
    { 
        $id=$request->id;
        $accident=Accident::find($id);       
        return view("adminlte::ids.create")->withAccident($accident);
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
            'IdsType'      =>'required|digits:1',
            'status'        =>'required|digits:1',
            'cardNo'    =>'required|alpha_num',
            'owner'     =>'required|string',
            'amande'        =>'required|digits_between:1,10',

        ]);
        $accidentId=$request->accident;
        $id=new ID();
        $id->accident_id=$accidentId;
        $id->user_id=Auth::id();
        $id->type=$request->IdsType;
        $id->status=$request->status;
        $id->number=$request->cardNo;
        $id->owner=$request->owner;
        $id->amande=$request->amande;
        $id->save();
        return redirect("/home");

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id=ID::find($id);
        $accident=$id->accident;
        $user=$accident->user;
        return view("adminlte::ids.view")   ->with('accident', $accident)
                                            ->with('id', $id)
                                            ->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id=ID::find($id);
        $accident=$id->accident;
        return view("adminlte::ids.edit")->withAccident($accident)->withId($id);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $this->validate($request,[
            'IdsType'      =>'required|digits:1',
            'status'        =>'required|digits:1',
            'cardNo'    =>'required|alpha_num',
            'owner'     =>'required|string',
            'amande'        =>'required|digits_between:1,10',

        ]);
        $id=ID::find($id);
        $id->type=$request->IdsType;
        $id->status=$request->status;
        $id->number=$request->cardNo;
        $id->owner=$request->owner;
        $id->amande=$request->amande;
        $id->update();
        return redirect()->route('ids.show',$id);
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
