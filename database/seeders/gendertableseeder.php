<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\gender;




class gendertableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();

        $data = [
            [ 
                'en' => 'Male',
                'ar' => 'ذكر'
            ],
            [
                'en' => 'Female',
                'ar' => 'أنثي'
            ]
            ];

            foreach($data as $d)
            {
                gender::create(['name' => $d]);
            }
    }
}
