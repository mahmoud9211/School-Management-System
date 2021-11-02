<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student()
    {
        return $this->hasOne(student::class,'id','student_id');
    }

    public function grade()
    {
        return $this->hasOne(Grade::class,'id','from_grade');
    }

    public function t_grade()
    {
        return $this->hasOne(Grade::class,'id','to_grade');
    }

    public function classroom()
    {
        return $this->hasOne(classroom::class,'id','from_classroom');
    }

    public function t_classroom()
    {
        return $this->hasOne(classroom::class,'id','to_classroom');
    }

    public function section()
    {
        return $this->hasOne(section::class,'id','from_section');
    }

    public function t_section()
    {
        return $this->hasOne(section::class,'id','to_section');
    }

    
}
