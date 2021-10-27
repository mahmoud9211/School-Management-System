<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class usertableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::insert([
            'name' => 'admin',
            'email' => 'mahmoudibrahim9211@gmail.com',
            'password' => Hash::make('123')
        ]);
        
    }
}
