<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
use App\Ban;

class ControllerStudent extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $info = DB::table("student")
        //                 ->leftjoin("ban","student.b_id","=","ban.b_id")
        //                 ->orderBy("s_id","asc")
        //                 ->get();
        $info = Student::leftjoin("ban","student.b_id","=","ban.b_id")
                        ->orderBy("s_id","asc")
                        ->get();
        // dd($info);
        return view("student.index",["info"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $studentInfo = DB::table("ban")->get();
        $studentInfo = Ban::get();
        return view("student.create",["studentInfo"=>$studentInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = $request->except("_token");
        // $res = DB::table("student")->insert($arr);
        $res = Student::create($arr);
        if($res){
            return redirect("/student/index");
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
        // $info = DB::table("student")->where("s_id",$id)->first();
        // dd($info);
        $info = Student::find($id);
        // $info = Student::where("s_id",$id)->first();
        $studentInfo = Ban::get();
        return view("student.edit",["info"=>$info,"studentInfo"=>$studentInfo]);
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
        $arr = $request->except("_token");
        // $res = DB::table("student")->where("s_id",$id)->update($arr);

        // $res = Student::where("s_id",$id)->update($arr);

        $student = new Student;
        $res = $student::find($id);
        $student->s_name = $request->s_name;
        $student->s_sex = $request->s_sex;
        $student->b_id = $request->b_id;

        $res = $student->save();
        if($res!==false){
            return redirect("/student/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $res = DB::table("student")->where("s_id","$id")->delete();

        $res = Student::destroy($id);
        if($res){
            return redirect("/student/index");
        }
    }
}
