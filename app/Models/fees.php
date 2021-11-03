<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;


class fees extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['title'];

    protected $guarded = [];



    public function grade()
    {
        return $this->hasOne(Grade::class,'id','Grade_id');
    }

    public function classroom()
    {
        return $this->hasOne(classroom::class,'id','Classroom_id');
    }


}
