<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\religion;

class religiontableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->delete();

        $data = [

        [
            'en' => 'Muslim',
            'ar' => 'مسلم'
        ],

        [
            'en' => 'Christian',
            'ar' => 'مسيحي'
        ],

        [
            'en' => 'other',
            'ar' => 'غير ذلك'
        ]


        ];

        foreach ($data as $val)
        {
            religion::create(['name' => $val]);
        }
        
    }
}
