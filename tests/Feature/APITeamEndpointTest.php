<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use App\Models\Team;
use App\Models\Player;
use App\User;

class APITeamEndpointTest extends TestCase
{
    use RefreshDatabase, InteractsWithExceptionHandling;

    protected $user;

    protected function setUp()
    {
        parent::setUp();
//        $this->withoutExceptionHandling();
        $this->user = factory(User::class)->create();
    }

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

        $response = $this->actingAs($this->user,'api')
            ->json('PUT','/api/team/' . $team->id,[
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
        $team = factory(Team::class)->make();

        $response = $this->actingAs($this->user,'api')
            ->json('POST','/api/team', $team->toArray());

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

        $response = $this->actingAs($this->user,'api')
            ->json('DELETE','/api/team/' . $team->id);

        $response
            ->assertStatus(204);
    }


}