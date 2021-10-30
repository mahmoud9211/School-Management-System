<?php

namespace App\Repository;
use App\Models\specialization;
use App\Models\gender;
use App\Models\blood;
use App\Models\nationality;
use App\Models\myparent;
use App\Models\Grade;
use App\Models\section;
use App\Models\classroom;
use App\Models\student;



use Illuminate\Support\Facades\Hash;

class studentrepository implements studentrepositoryinterface {


    public function create_teacher_page()

    {

        $data['gender'] = gender::get();
        $data['blood'] = blood::get();
        $data['nationality'] = nationality::get();
        $data['myparent'] = myparent::get();
        $data['Grade'] = Grade::get();
        $data['section'] = section::get();
        $data['classroom'] = classroom::get();

        return view ('students.add',$data);
    }


    public function students_store ($request)

    {

         
        $validation = $request->validate([
         
            'email' => 'required|unique:students',
            'password' => 'required|min:10',
            'name_ar' => 'required',
            'name_en' => 'required',
            'gender_id' => 'required',
            'nationalitie_id' => 'required',
            'blood_id' => 'required',
            'Date_Birth' => 'required',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'section_id' => 'required',
            'parent_id' => 'required',
            'academic_year' => 'required'
        ]);

       try{

        student::create([
       'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
       'email' => $request->email,
       'password' => $request->password,
       'gender_id' => $request->gender_id,
       'nationalitie_id' => $request->nationalitie_id,
       'blood_id' => $request->blood_id,
       'Date_Birth' => $request->Date_Birth,
       'Grade_id' => $request->Grade_id,
       'Classroom_id' => $request->Classroom_id,
       'section_id' => $request->section_id,
       'parent_id' => $request->parent_id,
       'academic_year' => $request->academic_year
        ]);

        $msg = array('message' => trans('main_trans.success'),
        'alert-type' => 'success');

        return redirect()->back()->with($msg); 



       }catch (Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
      

    }

    public function index()
    {
        $students = student::get();
        return view('students.students',compact('students'));
    }

    public function edit($id)
    {
        $data['gender'] = gender::get();
        $data['blood'] = blood::get();
        $data['nationality'] = nationality::get();
        $data['myparent'] = myparent::get();
        $data['Grade'] = Grade::get();
        $data['section'] = section::get();
        $data['classroom'] = classroom::get();
        $data['student'] = student::findOrFail($id);

        return view ('students.edit',$data);


    }


    public function update($request,$id)
    {

        //Validation!!

        try{
         student::findOrFail($id)->update([
            'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'email' => $request->email,
            'password' => $request->password,
            'gender_id' => $request->gender_id,
            'nationalitie_id' => $request->nationalitie_id,
            'blood_id' => $request->blood_id,
            'Date_Birth' => $request->Date_Birth,
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'parent_id' => $request->parent_id,
            'academic_year' => $request->academic_year


         ]);

         $msg = array('message' => trans('main_trans.update'),
         'alert-type' => 'success');
 
         return redirect()->route('students.index')->with($msg);

        }catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        
      

    }

    public function delete($request)
{
    student::findOrFail($request->id)->delete();

    $msg = array('message' => trans('main_trans.delete') ,
    'alert-type' => 'info');

    return redirect()->back()->with($msg);
}


}