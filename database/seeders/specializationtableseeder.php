<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\specialization;

class specializationtableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();

        $data = [
            [ 
                'en' => 'Maths',
                'ar' => 'رياضيات'
            ],
            [
                'en' => 'Science',
                'ar' => 'علوم'
            ],
            [
                'en' => 'Arabic',
                'ar' => 'لغه عربيه'
            ],
            [ 
                'en' => 'English',
                'ar' => 'لغه انجليزيه'
            ],
            [
                'en' => 'Computer Science',
                'ar' => ' علوم الحاسب الألي'
            ],
            [
                'en' => 'Social Studies',
                'ar' => 'دراسات إجتماعيه'
            ],

            ];

            foreach($data as $d)
            {
                specialization::create(['name' => $d]);
            }
    }
}
