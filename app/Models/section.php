<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class section extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['name'];

    protected $guarded = [];



    public function classes ()
    {
        return $this->hasOne(classroom::class,'id','class_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(teacher::class,'section_teachers');
    }
}
