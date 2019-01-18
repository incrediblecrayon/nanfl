<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //TODO - Truncate tables first
//        DB::table('users')->truncate();

         $this->call(UserSeeder::class);
    }
}
