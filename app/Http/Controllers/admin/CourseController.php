<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    public function index()
    {
        return view('admin.course')->with('courses', Course::all());
    }

    public function store(CourseRequest $request)
    {
        try{
            Course::create([
                'name' => $request->name
            ]);
            session()->flash('success','Insert was Successfully');
        }catch (\Exception $e){
            session()->flash('error','Something Gone Wronge <br />'.$e);
        }
        
        return redirect()->back();
    }

    public function update(Request $request)
    {
        try{
            $course = Course::find($request->id);
        
            $course->name = $request->name;
            $course->save();
            session()->flash('success','Update was Successfully');
        }catch (\Exception $e){
            session()->flash('error','Something Gone Wrong');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{  
            Course::find($id)->delete();
        }catch(\Exception $e){
            return response()->json(['status'=>true,'error'=>true,'errors'=>$e]);
        }
        return response()->json(['status'=>true,'error'=>false]);
    }

}
