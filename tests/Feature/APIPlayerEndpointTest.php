<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use App\Models\Team;
use App\Models\Player;
use App\User;

class APIPlayerEndpointTest extends TestCase
{
    use RefreshDatabase,InteractsWithExceptionHandling;

    protected $user;

    protected function setUp()
    {
        parent::setUp();
//        $this->withoutExceptionHandling();
        $this->user = factory(User::class)->create();
    }

    /**
     * Test show all players
     *
     * @return void
     */
    public function testAllPlayers()
    {
        $teams = factory(Team::class,3)->create();
        $teams->each(function($team){
            factory(Player::class,3)->create([
                'team_id' => $team->id
            ]);
        });

        $response = $this->json('GET','/api/player');

        $response
            ->assertStatus(200);
    }

    /**
     * Test show all players with query arguments.
     *
     * @return void
     */
    public function testAllPlayersQuery()
    {
        $teams = factory(Team::class,3)->create();
        $teams->each(function($team){
            factory(Player::class,3)->create([
                'team_id' => $team->id
            ]);
        });

        $response = $this->json('GET','/api/player',['team_id' => 1]);

        $response
            ->assertStatus(200)
            ->assertJsonCount(3);
    }

    /**
     * Show Player using ID
     *
     * @return void
     */
    public function testShowPlayerWithID()
    {
        $team = factory(Team::class)->create();
        $player = factory(Player::class)->create(['team_id' => $team->id]);

        $response = $this->json('GET','/api/player/' . $player->id);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['first_name' => $player->first_name])
            ->assertJsonFragment(['name' => $team->name]); //Ensure team return as well.
    }

    /**
     * Test Create New Player
     *
     * @return void
     */
    public function testCreateNewPlayer()
    {
        $team = factory(Team::class)->create();
        $player = factory(Player::class)->make(['team_id' => $team->id]);

        $response = $this->actingAs($this->user,'api')
            ->json('POST','/api/player',$player->toArray());

        $response
            ->assertStatus(201)
            ->assertJsonFragment(['first_name' => $player->first_name]);

    }

    /**
     * Test Update Existing Player
     *
     * @return void
     */
    public function testUpdatePlayer()
    {
        $team = factory(Team::class)->create();
        $player = factory(Player::class)->create(['team_id' => $team->id]);

        $response = $this->actingAs($this->user,'api')
            ->json('PUT','/api/player/' . $player->id,[
                'first_name' => 'tester',
                'last_name' => 'testington'
            ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'first_name' => 'Tester', // Title Case due to model config.
                'last_name' => 'Testington' // Title Case due to model config.
            ]);
    }

    /**
     * Test Delete Player
     *
     * @return void
     */
    public function testDeletePlayer()
    {
        $team = factory(Team::class)->create();
        $player = factory(Player::class)->create(['team_id' => $team->id]);

        $response = $this->actingAs($this->user,'api')
            ->json('DELETE','/api/player/' . $player->id);

        $response
            ->assertStatus(204);
    }


}
