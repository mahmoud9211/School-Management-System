<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Grade;
use App\Models\section;
use App\Models\classroom;




class sectionController extends Controller
{
    public function index ()

    {
       $grade = Grade::with(['sections'])->get();

       $class = classroom::get();
     
        return view ('sections.sections',compact('grade','class'));
    }


    public function classbyajax ($grade_id)
    {
        $data = classroom::where('grade_id',$grade_id)->pluck('name','id');
        return $data;
    }


    public function store (Request $request)
    {
       
        $section = new section();
        
        $section->name = ['en' => $request->name_en , 'ar' => $request->name];
        $section->grade_id = $request->grade_id;
        $section->class_id = $request->class_id;
        $section->status = 1;

        $section->save();
       

       $msg = array('message' => trans('main_trans.success') ,
      'alert-type' => 'success');
  
      return redirect()->back()->with($msg);

    }

    public function update (Request $request)

    {
        $id = $request->id;
       try{

        $section = section::find($id);
        
        $section->name = ['en' => $request->name_en , 'ar' => $request->name];
        $section->grade_id = $request->grade_id;
        $section->class_id = $request->class_id;
       
        

        if (isset($request->status))
        {
            $section->status = 1;
        }
        else{
            $section->status = 0 ; 
        }

        $section->save();

        $msg = array('message' => trans('main_trans.update') ,
        'alert-type' => 'success');
        
        return redirect()->back()->with($msg);

        

       } catch(\Exception $e){

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  
  
      }
        

    }

    public function delete(Request $request)

    {
        $id = $request->id;

        try{
         
            section::find($id)->delete();

            $msg = array('message' => trans('main_trans.delete') ,
            'alert-type' => 'info');
        
            return redirect()->back()->with($msg);


        }catch(\Exception $e){

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  
  
      }
    }

}
