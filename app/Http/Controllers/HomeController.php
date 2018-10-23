<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Accident;
use App\User;

use DB;
use Auth;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $accidents;
        // get all accidents to display to home view
        if(Auth::user()->hasRole('user'))
        {
        $accidents=Accident::where('user_id',Auth::id());
        }
        elseif(Auth::user()->hasRole('district-admin'))
        {
         $accidents=Accident::where('district_id',Auth::id());  
        }
         elseif(Auth::user()->hasRole('province-admin'))
        {
         $accidents=Accident::where('province_id',Auth::id());  
        }
         elseif(Auth::user()->hasRole('overall-admin'))
        {
         $accidents=Accident::all();  
        }
        // dd($accidents);
        return view('adminlte::home')->withAccidents($accidents);
    }
}