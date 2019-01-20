<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    // TODO - Frontend Methods

    /**
     * Show all teams
     *
     * @return JSON Response
     */
    //TODO - Params for filtering if data elements get more complex.
    public function index()
    {
        $teams = Team::all();

        return response()
            ->json($teams);
    }

    /**
     * Show team of ID
     *
     * @param int $id Team ID
     *
     * @return JSON Response
     */
    public function show($id)
    {
        $team = Team::with(['players'])
            ->findOrFail($id);

        return response()
            ->json($team);
    }

    /**
     * Create New Team
     *
     * @param Request $request request containing create information
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //TODO - Centralize validation create + update
        $cleanData = $request->validate([
            'name' => 'bail|required|regex:/[a-zA-Z0-9 _-]+/|unique:teams,name',
            'city' => 'bail|required|regex:/[a-zA-Z0-9 _-]+/',
            'color_main' => 'bail|required|regex:/#[a-zA-Z0-9]{6}/',
            'color_accent' => 'bail|required|regex:/#[a-zA-Z0-9]{6}/'
        ]);

        $newTeam = Team::create($cleanData);

        return response()->json($newTeam, 201);
    }

    /**
     * Update Team of ID
     *
     * @param Request $request request containing update information.
     * @param int $id Team ID
     *
     * @return JSON Response
     */
    public function update(Request $request, $id)
    {
        //TODO - Centralize validation create + update
        $cleanData = $request->validate([
            'name' => 'regex:/[a-zA-Z0-9 _-]+/|unique:teams,name',
            'city' => 'regex:/[a-zA-Z0-9 _-]+/',
            'color_main' => 'regex:/#[a-zA-Z0-9]{6}/',
            'color_accent' => 'regex:/#[a-zA-Z0-9]{6}/'
        ]);

        $team = Team::findOrFail($id);

        $team->update($cleanData);

        //Perform Update.
        return response()
            ->json($team);
    }

    /**
     * Delete Team and Players associated with team.
     *
     * @param int $id Team ID
     *
     * @return JSON Response
     */
    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $players = $team->players;

        Player::destroy($players->pluck('id')); //TODO - Delete players bool in request.
        $team->delete();

        return response()
            ->json(null,204);
    }


}
