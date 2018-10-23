<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Role;
use App\Province;
use App\RoleUser;
use Auth;
use Illuminate\validation\Rule;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        $provinces=Province::all();
        $roles=Role::all();
        return view("adminlte::users.index")->withUsers($users)
                                            ->withProvinces($provinces)
                                            ->withRoles($roles);
                                            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $provinces=Province::all();
        $roles=Role::all();
        return view("adminlte::users.create")->withProvinces($provinces)
                                             ->withRoles($roles);
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
            'name'      =>'required|string|min:2|max:100',
            'email'      =>'required|email|unique:users',
            'phone'      =>'required|unique:users',
            'title'        =>'required|alpha|max:15',
            'role'       =>'required|digits:1',
            'district'    =>'required|digits_between:1,2',
            'province'          =>'required|digits:1',
            'station'        =>'required|digits_between:1,5',
            'password'       =>'required|confirmed'

        ]);
        $user=new User();
        $user->name=$request->name;
        $user->station_id=$request->station;
        $user->province_id=$request->province;
        $user->district_id=$request->district;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->title=$request->title;
        $user->password=bcrypt($request->password);
        $user->remember_token=str_random(10);
        $user->save();
        $role=new RoleUser();
        $role->role_id=$request->role;
        $role->user_id=$user->id;
        $role->save();
        $message=session()->flash('success','User has been Successfully Created');
        return redirect('/users')->withMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {  
        $roles=Role::all(); 
        $provinces=Province::all();
        return view("adminlte::users.show")->withUser($user)
                                           ->withRoles($roles)
                                           ->withProvinces($provinces);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
         $provinces=Province::all();
         $roles=Role::all();
         return view("adminlte::users.edit")->withUser($user)->withProvinces($provinces)->withRoles($roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    { 
        if(Auth::id()==$user->id)
        {
             $this->validate($request,[
                'name'      =>'required|string',
                'email'      =>'required',Rule::unique('users')->ignore($user->id),
                'phone'      =>'required',Rule::unique('users')->ignore($user->id),
                'phone'      =>'required',
                'title'        =>'required|alpha|max:15',

            ]);
         }
         elseif(Auth::user()->hasAnyRole('overall-admin') and Auth::id()!=$user->id)
         {
            $this->validate($request,[
                'name'      =>'required|string',
                'email'      =>'required',Rule::unique('users')->ignore($user->id),
                'phone'      =>'required',Rule::unique('users')->ignore($user->id),
                'title'        =>'required|alpha|max:15',
                'role'       =>'required|digits:1',
                'district'    =>'required|digits_between:1,2',
                'province'          =>'required|digits:1',
                'station'        =>'required|digits_between:1,5'

            ]);
         }
         else 
         {
            return redirect()->back();
         }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->title=$request->title;
        if(Auth::user()->hasAnyRole('overall-admin') and Auth::id()!=$user->id)
        {
        $user->province_id=$request->province;
        $user->district_id=$request->district;
        $user->station_id=$request->station;
        $user->roles()->detach();
        $user->roles()->attach($request->role);
        }
        $user->update();
        $message=session()->flash('success','User has been Successfully Updated');
        return redirect()->route('users.index')->withMessage($message);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    return redirect()->back();


    }
    public function assign(Request $request,$id)
    {
        $user=User::find($id);
        $this->validate($request,[
            'password'=>'required|confirmed'
        ]);
        $user->password=bcrypt($request->password);
        $user->update();
        $message=session()->flash('success','Password has been Successfully Updated');
        return redirect()->route('users.index')->withMessage($message);
    }
     public function assignMy(Request $request,$id)
    {
        $user=User::find($id);
        $this->validate($request,[
            'password'=>'required|confirmed'
        ]);
        $user->password=bcrypt($request->password);
        $user->update();
        $message=session()->flash('success','Password has been Successfully Updated');
        return redirect()->route('users.index')->withMessage($message);
    }
     public function assignRole(Request $request,$id)
    {
        $user=User::find($id);
        $this->validate($request,[
            'role'=>'required'
        ]);
        $user->roles()->detach();
        $user->roles()->attach($request->role);
        $message=session()->flash('success','Role has been Successfully Updated');
        return redirect()->route('users.index')->withMessage($message);
    }
}
