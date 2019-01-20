<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    /**
     * Show all players
     *
     * @param Request $request Query Arguments for filtering.
     *
     * @return JSON Response
     */
    public function index(Request $request)
    {
        $cleanData = $request->validate([
            'team_id' => 'numeric|exists:teams,id'
        ]);

        $players = Player::orderBy('id','asc')
            ->when(isset($cleanData['team_id']), function($query) use($cleanData){
                return $query->where('team_id','=',$cleanData['team_id']);
            })
            ->get();

        return response()
            ->json($players);
    }

    /**
     * Show Player of ID
     *
     * @param int $id Player ID
     *
     * @return JSON Response
     */
    public function show($id)
    {
        $player = Player::with(['team'])
            ->findOrFail($id);

        return response()
            ->json($player);
    }

    /**
     * Create New Player
     *
     * @param Request $request request containing create information
     *
     * @return JSON Response
     */
    public function store(Request $request)
    {
        $cleanData = $request->validate([
            'team_id' => 'bail|required|exists:teams,id',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
        ]);

        $newPlayer = Player::create($cleanData);

        return response()->json($newPlayer, 201);
    }

    /**
     * Update Player of ID
     *
     * @param Request $request request containing update information.
     * @param int $id Player ID
     *
     * @return JSON Response
     */
    public function update(Request $request, $id)
    {
        $cleanData = $request->validate([
            'team_id' => 'exists:teams,id',
            'first_name' => 'max:100',
            'last_name' => 'max:100',
        ]);

        $player = Player::findOrFail($id);

        $player->update($cleanData);

        //Perform Update.
        return response()
            ->json($player,200);
    }

    /**
     * Delete Player
     *
     * @param int $id Player ID
     *
     * @return JSON Response
     */
    public function destroy($id)
    {
        $player = Player::findOrFail($id);

        $player->delete();

        return response()
            ->json(null,204);
    }


}
