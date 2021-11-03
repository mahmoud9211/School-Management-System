<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;



class student extends Model
{
    use HasFactory;

    use SoftDeletes;

    use HasTranslations;

    public $translatable = ['name'];

    protected $guarded = [];



    public function gender()
    {
        return $this->hasOne(gender::class,'id','gender_id');
    }

    public function nationality()
    {
        return $this->hasOne(nationality::class,'id','nationalitie_id');
    }

    public function parent()
    {
        return $this->hasOne(myparent::class,'id','parent_id');
    }

    public function grade()
    {
        return $this->hasOne(Grade::class,'id','Grade_id');
    }

    public function section()
    {
        return $this->hasOne(section::class,'id','section_id');
    }

    public function classroom()
    {
        return $this->hasOne(classroom::class,'id','Classroom_id');
    }




    public function image()
    {
        return $this->morphMany(image::class, 'imageable');
    }

    public function myparent ()
    {
        return $this->hasOne(myparent::class,'id','parent_id');
    }
}
