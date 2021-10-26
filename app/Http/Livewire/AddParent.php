<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\nationality;
use App\Models\blood;
use App\Models\religion;
use App\Models\myparent;
use App\Models\attachment;

use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;






class AddParent extends Component
{
    use WithFileUploads;

   public $currentStep = 1;

   public $updatemode = false;

   public $Parent_id;

   public $Email, $Password, $Name_Father, $Name_Father_en, $Job_Father, $Job_Father_en,
   $National_ID_Father, $Passport_ID_Father, $Phone_Father,$Nationality_Father_id,
   $Blood_Type_Father_id,$Religion_Father_id,$Address_Father,$successMessage;

   public $Name_Mother,$Name_Mother_en,$Job_Mother,$Job_Mother_en,$National_ID_Mother,
   $Passport_ID_Mother,$Phone_Mother,$Nationality_Mother_id,$Blood_Type_Mother_id,
   $Religion_Mother_id,$Address_Mother,$photos,$show_table = true;


   public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
         'Email' => 'required|unique:myparents|email',
         'Password' => 'required|min:10',
         'National_ID_Father' => 'required|unique:myparents|min:14|max:14|regex:/^([0-9\s\-\+\(\)]*)$/',
         'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
         'National_ID_Mother' => 'required|string|min:14|max:14|regex:/^([0-9\s\-\+\(\)]*)$/',
         'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'


        ]);
    }



    public function render()
    {
        return view('livewire.add-parent',[
          
           'Nationalities' => nationality::get(),
           'Type_Bloods' => blood::get(),
           'Religions' => religion::get(),
           'my_parents' => myparent::get()

        ]);
    }

    public function firstStepSubmit()
    {
       
        $this->validate([
            'Email' => 'required|unique:myparents,email,'.$this->id,
            'Password' => 'required',
            'Name_Father' => 'required|regex:/^[a-zA-Z]+$/u',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|regex:/^[0-9]+$/|min:14|max:14' . $this->id,
            'Passport_ID_Father' => 'required|unique:myparents,Passport_ID_Father,regex:/^[0-9]+$/' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',

        ]);
        


        $this->currentStep = 2;
    }

    public function secondStepSubmit ()
    {
        
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:myparents,National_ID_Mother,regex:/^[0-9]+$/' . $this->id,
            'Passport_ID_Mother' => 'required|unique:myparents,Passport_ID_Mother,regex:/^[0-9]+$/' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        


        $this->currentStep = 3;
    }

    public function back ($step)
    {
        $this->currentStep =  $step; 
    }

    public function submitForm ()

    {
        try{

            $myparent = new myparent();
            $myparent->Email = $this->Email;
            $myparent->Password = Hash::make($this->Password);
            $myparent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father ];
            $myparent->National_ID_Father = $this->National_ID_Father;
            $myparent->Passport_ID_Father = $this->Passport_ID_Father;
            $myparent->Phone_Father = $this->Phone_Father;
            $myparent->Job_Father = ['en' => $this->Job_Father_en , 'ar' => $this->Job_Father ];
            $myparent->Nationality_Father_id = $this->Nationality_Father_id;
            $myparent->Blood_Type_Father_id = $this->Blood_Type_Father_id;
            $myparent->Religion_Father_id = $this->Religion_Father_id;
            $myparent->Address_Father = $this->Address_Father;
    
    
    
            $myparent->Name_Mother = ['en' => $this->Name_Mother_en , 'ar' => $this->Name_Mother];
            $myparent->National_ID_Mother = $this->National_ID_Mother;
            $myparent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $myparent->Phone_Mother = $this->Phone_Mother;
            $myparent->Job_Mother = ['en' => $this->Job_Mother_en , 'ar' => $this->Job_Mother];
            $myparent->Nationality_Mother_id = $this->Nationality_Mother_id;
            $myparent->Blood_Type_Mother_id = $this->Blood_Type_Mother_id;
            $myparent->Religion_Mother_id = $this->Religion_Mother_id;
            $myparent->Address_Mother = $this->Address_Mother;
    
            $myparent->save();


            if(!empty($this->photos))
            {
                foreach($this->photos as $photo)
                {
            $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');

                attachment::insert([
                   'file_name' => $photo->getClientOriginalName(),
                   'parent_id' => myparent::latest()->first()->id
                ]);
                }
            }
    
            
            $this->successMessage = trans('main_trans.success');
            $this->clearform();
            $this->currentStep = 1;
    



        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }


       
       



    }


    public function clearform()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';

    }


    public function showformadd()

    {
        $this->show_table = false;
    }


    public function edit ($id)
    {
        $this->show_table = false;
        $this->updatemode = true;

        $myparent = myparent::find($id);
              $this->Parent_id = $id;
             $this->Email = $myparent->Email;
             $this->Password = $myparent->Password ;
              $this->Name_Father_en = $myparent->getTranslation('Name_Father','en') ;
              $this->Name_Father = $myparent->getTranslation('Name_Father','ar') ;
             $this->National_ID_Father = $myparent->National_ID_Father;
            $this->Passport_ID_Father =  $myparent->Passport_ID_Father ;
              $this->Phone_Father = $myparent->Phone_Father;
             $this->Job_Father_en =  $myparent->getTranslation('Job_Father','en') ;
            $this->Job_Father =  $myparent->getTranslation('Job_Father','ar') ;
             $this->Nationality_Father_id = $myparent->Nationality_Father_id ;
             $this->Blood_Type_Father_id = $myparent->Blood_Type_Father_id ;
             $this->Religion_Father_id = $myparent->Religion_Father_id ;
             $this->Address_Father = $myparent->Address_Father;
    
    
    
              $this->Name_Mother_en  = $myparent->getTranslation('Name_Mother','en');
              $this->Name_Mother  = $myparent->getTranslation('Name_Mother','ar');
             $this->National_ID_Mother = $myparent->National_ID_Mother ;
            $this->Passport_ID_Mother =  $myparent->Passport_ID_Mother ;
            $this->Phone_Mother =  $myparent->Phone_Mother ;
               $this->Job_Mother_en = $myparent->getTranslation('Job_Mother','en');
               $this->Job_Mother = $myparent->getTranslation('Job_Mother','ar');
              $this->Nationality_Mother_id = $myparent->Nationality_Mother_id;
              $this->Blood_Type_Mother_id = $myparent->Blood_Type_Mother_id;
             $this->Religion_Mother_id = $myparent->Religion_Mother_id ;
             $this->Address_Mother = $myparent->Address_Mother ;
       

    }


    public function firstStepSubmit_edit ()

    {
        

        $this->validate([
            'Email' => 'required|unique:myparents,email,'.$this->id,
            'Password' => 'required',
            'Name_Father' => 'required|regex:/^[a-zA-Z]+$/u',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|regex:/^[0-9]+$/|min:14|max:14' . $this->id,
            'Passport_ID_Father' => 'required|unique:myparents,Passport_ID_Father,regex:/^[0-9]+$/' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',

        ]);

        $this->currentStep = 2;
        $this->updatemode = true;

    }

    public function secondStepSubmit_edit ()

    {
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:myparents,National_ID_Mother,regex:/^[0-9]+$/' . $this->id,
            'Passport_ID_Mother' => 'required|unique:myparents,Passport_ID_Mother,regex:/^[0-9]+$/' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
        $this->updatemode = true;

    }

    public function submitForm_update ()

    {
        if($this->Parent_id)
        {
            $parent = myparent::find($this->Parent_id);
            $parent->update([
                  
                'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father ],
               'Email' => $this->Email,
                'Password' => Hash::make($this->Password),
                'National_ID_Father' => $this->National_ID_Father,
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'Phone_Father' => $this->Phone_Father,
               'Job_Father' => ['en' => $this->Job_Father_en , 'ar' => $this->Job_Father ],
               'Nationality_Father_id' =>$this->Nationality_Father_id,
                'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
                'Religion_Father_id' => $this->Religion_Father_id,
                'Address_Father' => $this->Address_Father,
        
        
        
               'Name_Mother' =>['en' => $this->Name_Mother_en , 'ar' => $this->Name_Mother],
                'National_ID_Mother' => $this->National_ID_Mother,
                'Passport_ID_Mother' => $this->Passport_ID_Mother,
                'Phone_Mother' => $this->Phone_Mother,
                'Job_Mother' => ['en' => $this->Job_Mother_en , 'ar' => $this->Job_Mother],
                'Nationality_Mother_id' => $this->Nationality_Mother_id,
                'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
                'Religion_Mother_id' => $this->Religion_Mother_id,
                'Address_Mother' => $this->Address_Mother,
        
                

             ]);

        }

        $msg = array('message' => trans('main_trans.update') ,
        'alert-type' => 'success');


        return redirect()->to('/AddParent');
    }

    public function delete ($id)
    {

        myparent::find($id)->delete();
    }





}
