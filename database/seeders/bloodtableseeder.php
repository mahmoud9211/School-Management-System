<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\blood;

class bloodtableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bloods')->delete();

        $data = ['O+','O-','A+','A-','B+','B-','AB+','AB-'];

        foreach ($data as $val)
        {
            blood::create(['name' => $val]);
        }
        
    }
}
