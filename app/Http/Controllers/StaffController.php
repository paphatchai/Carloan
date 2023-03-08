<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use auth;
use DB;

class StaffController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->level==1){
            Auth::logout();
            return back()->withInput();
        }
        $user = User::All();
        return view('usermanager',compact('user'));
    }
    public function adduser(Request $request){
        if(Auth::user()->level==1){
            Auth::logout();
            return back()->withInput();
        }
        $image = $request->file('image');
        $filename = time().rand(1, 999).rand(1, 999).'.'.$image->getClientOriginalExtension();                
        $image->move( public_path().'/image/',$filename); 

        $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = $data['password'] = bcrypt($request->password);
                $user->level = $request->level;
                $user->image = $filename;
                $user->isactive = $request->isactive;
                $user->save();
        return back()->withInput();
    }

    public function edituser(Request $request){
        if(Auth::user()->level==1){
            Auth::logout();
            return back()->withInput();
        }
        $user = User::find($request->userID);
                $user->name = $request->name;
                $user->email = $request->email;
                if($request->password != "....."){
                 $user->password = bcrypt($request->password);
                }
               
                $user->level = $request->level;
                if($request->hasFile('image')){
                    $image = $request->file('image');
                    $filename = time().rand(1, 999).rand(1, 999).'.'.$image->getClientOriginalExtension();                
                    $image->move( public_path().'/image/',$filename); 
                    $user->image = $filename;
                }
                $user->isactive = $request->isactive;
                $user->save();
        return back()->withInput();
    }
}
