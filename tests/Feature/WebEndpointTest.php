<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Team;
use App\Models\Player;

class WebEndpointTest extends TestCase
{

    use RefreshDatabase;

    protected $teams;
    protected $players;

    /**
     * Setup for each test by seeding fake data.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        //Add teams and players for all tests.
        $this->teams = factory(Team::class,3)->create();
        $this->players = $this->teams->map(function($team){
            $tmpPlayers = factory(Player::class,3)->create([
                'team_id' => $team->id
            ]);

            return $tmpPlayers;
        });
    }


    /**
     * Root web element is up.
     *
     * @return void
     */
    public function testRootWebPageAccess()
    {
        $response = $this->get("/");

        $response
            ->assertStatus(200);
    }

    /**
     * Root web element is up.
     *
     * @return void
     */
    public function testTeamDetailPage()
    {
        $response = $this->get("/team/2");

        $response
            ->assertStatus(200);
    }

}
