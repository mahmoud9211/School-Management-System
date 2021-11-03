<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\fees;
use App\Models\classroom;









class feesrepository implements feesrepositoryinterface{

    public function study_fees_index()

    {
        $fees = fees::get();
         
        return view ('fees.index',compact('fees'));


    }

    public function create_fees_page()
    {
        $grades = Grade::get();
        return view ('fees.create',compact('grades'));
    }

    public function study_fees_store ($request)
    {
        $validation = $request->validate([
        'title_ar' => 'required',
        'title_en' => 'required',
        'Grade_id' => 'required',
        'Classroom_id' => 'required',
        'year' => 'required',
        'amount' => 'required',
        'description' => 'required'
      
        ]);


        fees::create([

        'title' => ['en' => $request->title_en , 'ar' => $request->title_ar],
        'Grade_id' => $request->Grade_id,
        'Classroom_id' => $request->Classroom_id,
        'year' => $request->year,
        'amount' => $request->amount,
        'description' => $request->description
      


        ]);


        $msg = array('message' => trans('main_trans.success'),
        'alert-type' => 'success');

        return redirect()->back()->with($msg); 
    }

    public function study_fees_edit($id)

    {

        $fees = fees::findOrFail($id);
        $grades = Grade::get();
       
        
        return view ('fees.edit',compact('fees','grades'));

        
    }

    public function study_fees_update ($id,$request)
    {
        $validation = $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'year' => 'required',
            'amount' => 'required',
            'description' => 'required'
          
            ]);

            fees::find($id)->update([
                'title' => ['en' => $request->title_en , 'ar' => $request->title_ar],
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'year' => $request->year,
                'amount' => $request->amount,
                'description' => $request->description



            ]);

            $msg = array('message' => trans('main_trans.success'),
            'alert-type' => 'success');
    
            return redirect()->back()->with($msg); 



    }

    public function fees_study_delete($id)

    {

        fees::find($id)->delete();

        $msg = array('message' => trans('main_trans.delete') ,
        'alert-type' => 'info');
    
        return redirect()->back()->with($msg);
    }















}
