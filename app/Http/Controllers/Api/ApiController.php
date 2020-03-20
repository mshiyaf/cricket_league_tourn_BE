<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Team;
use App\Match;

class ApiController extends Controller
{
    /**
     * Display a listing of all teams.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTeams()
    {
        return Team::get();
    }



    /**
     * Display the specified team details.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function getTeam($name)
    {
        return $team_details= Team::where('team_name','=',$name)
                                    ->leftJoin('players', 'teams.id', '=', 'players.team_id')
                                    ->get();
       
    }

    /**
     * Display matches
     *
     * @return \Illuminate\Http\Response
     */
    public function getMatches()
    {
        return Match::left('matches', 'venues.id', '=', 'matches.venue_id')
                    ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
