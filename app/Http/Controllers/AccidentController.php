<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Exception;
use Auth;
use App\Accident;

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
        $address = DB::select("SELECT   a.id AS id,
                                        CONCAT( b.name, ' - ',
                                                c.name, ' - ',
                                                d.name, ' - ',
                                                e.name, ' - ',
                                                f.name
                                        ) AS name
                                        FROM Address AS a
                                        INNER JOIN Province AS b
                                            ON a.proviceId = b.id
                                        INNER JOIN District AS c
                                            ON a.districtId = c.id
                                        INNER JOIN Sector AS d
                                            ON a.sectorId = d.id
                                        INNER JOIN Cell AS e
                                            ON a.cellId = e.id
                                        INNER JOIN Village AS f
                                            ON a.villageId = f.id
                                      ");
        return view('adminlte::accident.create')
                                            ->with('address', $address);
                                            ;
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
        $address = $request->address;
        $dead = $request->dead;
        $injury = $request->injury;

        try{
            $accident = Accident::create(array(
                    'address_id' => $address,
                    'user_id'    => Auth::id(),
                    'comment'   => $comment,
                    'date'      => strtotime($date),
                    'dead'      => $dead,
                    'injury'    => $injury
                ));
            if($accident){
                return redirect("/home");
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
    public function update(Request $request, $id)
    {
        //
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
