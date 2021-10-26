<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Grade extends Model 
{
    use HasTranslations;

    public $translatable = ['name'];


    protected $table = 'grades';
    public $timestamps = true;
    protected $guarded = [];


    public function sections ()
    {
        return $this->hasMany(section::class,'grade_id');
    }

}