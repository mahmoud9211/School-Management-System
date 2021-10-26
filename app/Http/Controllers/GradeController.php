<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Grade;
use App\Models\classroom;


class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
   $grade = Grade::get();
   return view ('grades.grade',compact('grade')); 
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

    try
    {
      $validation = $request->validate([
        'name' => 'required',
        'name_en' => 'required'
      ],
      
      [
        'name.required' => trans('validation.required') ,
        'name_en.required' =>  trans('validation.required')
      ]
      );
  
      $grade = new Grade();
  
      $grade->name = ['en' => $request->name_en, 'ar' => $request->name ];
  
      $grade->notes = $request->notes;
  
      $grade->save();
  
      $msg = array('message' => trans('main_trans.success') ,
      'alert-type' => 'success');
  
      return redirect()->back()->with($msg);

    }
    catch(\Exception $e){

      return redirect()->back()->withErrors(['error' => $e->getMessage()]);


    }

    

    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
    $id = $request->id;

    $validation = $request->validate([
      'name' => 'required',
      'name_en' => 'required'
    ],
    
    [
      'name.required' => trans('validation.required') ,
      'name_en.required' =>  trans('validation.required')
    ]
    );

    try {
        Grade::find($id)->update([
         'name' => ['en' => $request->name_en, 'ar' => $request->name],
         'notes' => $request->notes
        ]);
        $msg = array('message' => trans('main_trans.update') ,
        'alert-type' => 'success');
    
        return redirect()->back()->with($msg);

    }
    catch(\Exception $e){

      return redirect()->back()->withErrors(['error' => $e->getMessage()]);

    
  }
}

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    $id = $request->id;

    $grade_id = classroom::where('grade_id',$id)->pluck('grade_id');
    

     if (count($grade_id) == 0)

     {
      Grade::find($id)->delete();

      $msg = array('message' => trans('main_trans.delete') ,
      'alert-type' => 'info');
  
      return redirect()->back()->with($msg);


     }else
     {
      $msg = array('message' => trans('main_trans.warning') ,
      'alert-type' => 'info');
  
      return redirect()->back()->with($msg);

     

     }


    
  }
  
}

?>