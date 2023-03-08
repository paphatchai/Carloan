<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use auth;
use App\note;
use App\User;
use Hash;
use Illuminate\Http\Request;

class noteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(Auth::user()->isactive==0){
            Auth::logout();
            return back()->withInput();
        }
        $note = note::where('userid',Auth::user()->id)->get();
        return view('note', compact('note'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function addnote(Request $request)
    {
        $data = new note;
        $data->topic=$request->topic;
        $data->body=$request->body;
        $data->islock=$request->islock;
        $data->userid=Auth::user()->id;
        $data->save();
        return back()->withInput();
    }
    public function editnote(Request $request)
    {
        $data = note::find($request->id);
        $data->topic=$request->topic;
        $data->body=$request->body;
        $data->islock=$request->islock;
        $data->userid=Auth::user()->id;
        $data->save();
        return redirect('note');
    }
    public function shownote(Request $request)
    {
        $note = note::Where('id',$request->id)->first();
        $user = user::Where('id',$note->userid)->first();
        if(!Hash::check($request->password, $user->password)){
            return back()->withInput();
        }
        return view('shownote',compact('note'));
    }
    public function delnote($id)
    {
        $notecheck = note::find($id)->get();
        if(Auth::user()->isactive==0&&$notecheck->userid!=Auth::user()->id){
            Auth::logout();
            return back()->withInput();
        }
        $note = note::find($id);
        $note->delete();
        
        return back()->withInput();
    }
}
