<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class teacher extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['Name'];

    protected $guarded = [];


    public function gender ()

    {
        return $this->hasOne(gender::class,'id','Gender_id');
    }

    public function spec ()

    {
        return $this->hasOne(specialization::class,'id','Specialization_id');
    }


}
