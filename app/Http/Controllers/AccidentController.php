<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Exception;
use Auth;
use App\Accident;
use App\Province;

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
        //pick aall variable required
        $date = $request->datepicker;
        //var_dump($date);
        $comment =$request->comment;
        // $address = $request->address;
        $dead = $request->dead;
        $injury = $request->injury;

        try{
            $accident = Accident::create(array(
                    'address_id' => 20,
                    'user_id'    => Auth::id(),
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
        return view('adminlte::accident.edit',["accident"=>$accident,'provinces'=>$provinces]);
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
        $accident=Accident::find($id);
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
