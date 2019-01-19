<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamAndPlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->truncate();
        DB::table('players')->truncate();

        $teams = factory(App\Models\Team::class, 32)->create();

        $users = $teams->map(function($team){
            $users = factory(App\Models\Player::class,32)->create([
                'team_id' => $team->id
            ]);

            return $users;
        });
    }
}
