<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Add User information and create an API token.
     *
     * @return void
     */
    public function run()
    {
        //Create new user.
        $newUser = DB::table('users')->insert([
            'name' => 'witty username',
            'email' => 'w.username@fakeemail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
