<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function remainCourses()
    {
        $courses = Course::whereNotIn('id', Auth::user()->courses)->get();
        $returnHTML = view('ajax.remain-courses',[ 'courses'=> $courses ])->render();// or method that you prefere to return data + RENDER is the key here
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }
    public function addCourse(Request $request)
    {
        try{       
            Auth::user()->courses()->attach($request->course);
            session()->flash('success','Course was added Successfully');
        }catch(\Exception $e){
            session()->flash('error','Something Gone Wrong');
        }
        return Redirect()->route('home');
    }
    public function deleteCourse($id)
    {
        try{  
            Auth::user()->courses()->detach($id);
        }catch(\Exception $e){
            return response()->json(['status'=>true,'error'=>true,'errors'=>$e]);
        }
        return response()->json(['status'=>true,'error'=>false]);
    }
}
