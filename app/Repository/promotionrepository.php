<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\student;
use App\Models\promotions;

use DB;



class promotionrepository implements promotionrepositoryinterface{

public function create(){
 
    $grades = Grade::get();

    return view('students.promotion',compact('grades'));

}

public function store ($request)

{
    $validation = $request->validate([
      'from_grade' => 'required',
      'from_classroom' => 'required',
      'from_section' => 'required',
      'to_grade' => 'required',
      'to_classroom' => 'required',
      'to_section' => 'required'

    ]);

   // DB::beginTransaction();
try{
$students = student::where('Grade_id',$request->from_grade)->
where('Classroom_id',$request->from_classroom)->
where('section_id',$request->from_section)->where('academic_year',$request->from_academic_year)->get();

if ($students->count() == 0)

{
    $msg = array('message' =>trans('main_trans.student_num_warning'),
'alert-type' => 'info'); 

return Redirect()->back()->with($msg); 


    

}else{

foreach($students as $student)
{
    $student->update([
        'Grade_id' => $request->to_grade,
        'Classroom_id' => $request->to_classroom,
        'section_id' => $request->to_section,
        'academic_year' => $request->to_academic_year
    ]);


  
    promotions::updateOrCreate([
      'student_id' => $student->id,
      'from_grade' => $request->from_grade,
      'from_classroom' => $request->from_classroom,
      'from_section' => $request->from_section,
      'to_grade' => $request->to_grade,
      'to_classroom' => $request->to_classroom,
      'to_section' => $request->to_section,
      'from_academic_year' => $request->from_academic_year,
      'to_academic_year' => $request->to_academic_year

    ]);

}

//DB::commit();

$msg = array('message' => trans('main_trans.success'),
'alert-type' => 'success');

return redirect()->route('students.index')->with($msg); 

}}catch (Exception $e) {
   // DB::rollback();
    return redirect()->back()->with(['error' => $e->getMessage()]);
}



}


public function index()
{

    $promotions = promotions::get();

    return view ('students.index_promotion',compact('promotions'));
}



public function destroy($request){




    try {


   

        $promotions = promotions::get();

        foreach($promotions as $promotion)
        {
            $ids = explode(',',$promotion->student_id);
            
           student::whereIn('id',$ids)->update([
            
         'Grade_id' => $promotion->from_grade,
        'Classroom_id' => $promotion->from_classroom,
        'section_id' => $promotion->from_section,
        'academic_year' => $promotion->from_academic_year
         ]);

        }

        Promotions::truncate();



    
    

    $msg = array('message' =>trans('main_trans.success'),
'alert-type' => 'info'); 

return Redirect()->route('students.index')->with($msg); 

    

} catch (\Exception $e) {
    
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}


}



public function delete($id)
{

    $promotions = promotions::findOrFail($id);

    student::where('id',$promotions->student_id)->update([

        'Grade_id' => $promotions->from_grade,
        'Classroom_id' => $promotions->from_classroom,
        'section_id' => $promotions->from_section,
        'academic_year' => $promotions->from_academic_year

    ]);

    promotions::find($id)->delete();

    $msg = array('message' =>trans('main_trans.success'),
    'alert-type' => 'info'); 
    
    return Redirect()->back()->with($msg); 


}


}