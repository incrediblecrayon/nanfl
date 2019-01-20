<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use App\Models\Team;
use App\Models\Player;
use Log;

class APITeamEndpointTest extends TestCase
{
    use RefreshDatabase, InteractsWithExceptionHandling;

    /**
     * Get All Teams Test
     *
     * @return void
     */
    public function testAllTeams()
    {
        factory(Team::class,2)->create();

        $response = $this->json('GET','/api/team');

        $response
            ->assertStatus(200)
            ->assertJsonCount(2);
    }

    /**
     * Get specific team with ID and player information.
     *
     * @return void
     */
    public function testGetTeamWithID()
    {
        $team = factory(Team::class)->create();
        $players = factory(Player::class,12)->create(['team_id' => $team->id]);

        $response = $this->json('GET','/api/team/' . $team->id);

        $response
            ->assertStatus(200)
            ->assertJsonCount(12,'players');
    }

    /**
     * Update team of ID
     *
     * @return void
     */
    //TODO - Add API Auth Test.
    public function testUpdateTeamWithID()
    {
        $team = factory(Team::class)->create();

        $response = $this->json('PUT','/api/team/' . $team->id,[
            'name' => 'testers'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['name' => 'Testers']); // Title Case due to model config.
    }

    /**
     * Create new team
     *
     * @return void
     */
    public function testCreateNewTeam()
    {
        $this->withoutExceptionHandling();

        $team = factory(Team::class)->make();
        Log::info("Team: " . $team->toJson());

        $response = $this->json('POST','/api/team', $team->toArray());

        $response
            ->assertStatus(201)
            ->assertJsonFragment(['name' => $team->name]);
    }

    /**
     * Delete Team
     *
     * @return void
     */
    public function testDeleteTeam()
    {
        $team = factory(Team::class)->create();

        $response = $this->json('DELETE','/api/team/' . $team->id);

        $response
            ->assertStatus(204);
    }


}