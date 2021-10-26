<?php

namespace App\Http\Controllers;
use App\Models\Grade;
use App\Models\classroom;


use Illuminate\Http\Request;

class classroomController extends Controller
{
    public function index()
    {
        $grade = Grade::get();
        $classroom = classroom::get();

        return view ('classrooms.classrooms',compact('grade','classroom'));

    }

    public function store(Request $request)
    {
        
        $validation = $request->validate([
            'List_Classes.*.name' => 'required',
            'List_Classes.*.name_class_en' => 'required',
            'List_Classes.*.grade_id' => 'required',
            

        ],
        [
            'List_Classes.*.name.required' => trans('validation.required'),
            'List_Classes.*.name_class_en.required' => trans('validation.required'),
            'List_Classes.*.grade_id.required' => trans('validation.required'),


        ]
    
    );

    $List_Classes = $request->List_Classes; 

        try {

            foreach ($List_Classes as $List_Class) {

                $My_Classes = new classroom();

                $My_Classes->name = ['en' => $List_Class['name_class_en'], 'ar' => $List_Class['name']];

                $My_Classes->grade_id = $List_Class['grade_id'];

                $My_Classes->save();

            }

            $msg = array('message' => trans('main_trans.success') ,
        'alert-type' => 'success');

        return redirect()->back()->with($msg);


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update (Request $request)

    {


       $id = $request->id;

       $validation = $request->validate([
        'name' => 'required',
        'name_class_en' => 'required',
        'grade_id' => 'required',
    
       ],
       [
        'name.required' => trans('validation.required'),
        'name_class_en.required' => trans('validation.required'),
        'grade_id.required' => trans('validation.required'),


       ]
 );


try {
    classroom::find($id)->update([

        'name' => ['en' => $request->name_class_en , 'ar' => $request->name ],
        'grade_id' => $request->grade_id
    
    ]);
    $msg = array('message' => trans('main_trans.update') ,
    'alert-type' => 'success');
    
    return redirect()->back()->with($msg);
    
}catch(\Exception $e){

    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}




    }

    public function delete(Request $request)

    {
        $id = $request->id;
try{
        classroom::find($id)->delete();
        $msg = array('message' => trans('main_trans.delete') ,
        'alert-type' => 'info');
    
        return redirect()->back()->with($msg);
   
   
       } catch(\Exception $e){
   
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);


       }


    }


public function deleteall (Request $request)

{
 
    $ids = explode(',',$request->delete_all_id);

    classroom::whereIn('id',$ids)->delete();

    $msg = array('message' => trans('main_trans.delete') ,
    'alert-type' => 'info');

    return redirect()->back()->with($msg);



}

public function filter (Request $request)

{

    $data = classroom::where('grade_id',$request->grade_id)->get();

    $grade = Grade::get();

    return view('classrooms.classrooms',compact('grade'))->withDetails($data);
}





   
}
