<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\bloodtableseeder;
use Database\Seeders\nationalitytableseeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            bloodtableseeder::class,
            nationalitytableseeder::class,
            religiontableseeder::class,
            gendertableseeder::class,
            specializationtableseeder::class,
           
        ]);
     }
}
