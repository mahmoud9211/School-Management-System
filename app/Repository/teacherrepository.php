<?php

namespace App\Repository;
use App\Models\teacher;
use App\Models\specialization;
use App\Models\gender;
use Illuminate\Support\Facades\Hash;



class teacherrepository implements teacherrepositoryinterface {


    public function getteachers()
    {
        $data = teacher::get();
        return view('teachers.teachers',compact('data'));
    }

    public function teacher_create_page()
    {
        $spec = specialization::get();
        $gender = gender::get();
        return view('teachers.addteacher',compact('spec','gender'));
    }

    public function  teacher_store($request)
    {

        
        $validation = $request->validate([
         
            'Email' => 'required|unique:teachers',
            'Password' => 'required|min:10',
            'Name_en' => 'required',
            'Name_ar' => 'required',
            'Specialization_id' => 'required',
            'Gender_id' => 'required',
            'Joining_Date' => 'required',
            'Address' => 'required'

        ]);
try{
        teacher::create([
         'Email' => $request->Email,
         'Password' => Hash::make($request->Password),
         'Name' => ['en' => $request->Name_en , 'ar' => $request->Name_ar],
         'Specialization_id' => $request->Specialization_id,
         'Gender_id' => $request->Gender_id,
         'Joining_Date' => $request->Joining_Date,
         'Address' => $request->Address
        ]);

        $msg = array('message' => trans('main_trans.success'),
        'alert-type' => 'success');

        return redirect()->route('teachers.index')->with($msg); 
    }catch (Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
    
    }


    public function edit ($id)

    {
      $data = teacher::findOrFail($id);
      $spec = specialization::get();
      $gender = gender::get();

      return view ('teachers.edit',compact('data','spec','gender'));


    }

    public function update($request,$id)
    {
         

        //validation !!
try{
        teacher::findOrFail($id)->update([
         'Email' => $request->Email,
         'Password' => Hash::make($request->Password),
         'Name' => ['en' => $request->Name_en , 'ar' => $request->Name_ar],
         'Specialization_id' => $request->Specialization_id,
         'Gender_id' => $request->Gender_id,
         'Joining_Date' => $request->Joining_Date,
         'Address' => $request->Address
        ]);

        $msg = array('message' => trans('main_trans.update'),
        'alert-type' => 'success');

        return redirect()->route('teachers.index')->with($msg); 
    }catch (Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
      



    }


    public function delete($request)

    {
       
        teacher::findOrFail($request->id)->delete();

        
        $msg = array('message' => trans('main_trans.delete') ,
        'alert-type' => 'info');
    
        return redirect()->back()->with($msg);

    }









}