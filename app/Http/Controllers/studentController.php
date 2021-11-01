<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repository\studentrepositoryinterface;

use App\Models\classroom;
use App\Models\section;




class studentController extends Controller
{
    
 protected $student;

 public function __construct(studentrepositoryinterface $student)
 {
   $this->student = $student;
 }

    public function index()
    {
      return $this->student->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return $this->student->create_teacher_page();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->student->students_store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->student->student_details($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->student->edit($id);
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
        return $this->student->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->student->delete($request);
    }



    public function getclasses ($id)

    {

        $data = classroom::where('grade_id',$id)->pluck('name','id');

        return $data;


    }

    public function getsections ($id)

    {

        $data = section::where('class_id',$id)->pluck('name','id');

        return $data;


    }

    public function attachment (Request $request)
    {


        return $this->student->add_attachment($request);
    }

    public function download ($studentsname,$filename)
    {
       return $this->student->download($studentsname,$filename);
    }

    
}
