<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Team;
use App\Match;
use App\Venue;
use App\Player;
use App\Result;

class ApiController extends Controller
{
    /**
     * Display a listing of all matches.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTeams()
    {
        return Team::get();
    }

    /**
     * Display details of a player.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPlayer($id)
    {
        return Player::where('players.id','=',$id)
                    ->join('teams', 'teams.id', '=', 'players.team_id')
                    ->get();
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
         
        $matches =  Venue::join('matches', 'matches.venue_id', '=', 'venues.id')
                        ->join('results','results.id','=','matches.result_id')
                        ->get();

        $matches = json_decode($matches); 

        foreach($matches as $obj){
            $team_a_name[$obj->team_a_id] = Team::where('id','=',$obj->team_a_id)
                                            ->get(['team_name', 'team_code']);
        };
        foreach($matches as $obj){
            $team_b_name[$obj->team_b_id] = Team::where('id','=',$obj->team_b_id)
                                            ->get(['team_name', 'team_code']);
        };

        foreach($matches as $obj){
            foreach($team_a_name as $key=>$value){
                if($key == $obj->team_a_id){
                    $obj->team_a = $value;
                }
                if($key == $obj->winner_team_id)
                {
                    $obj->winner_team = $value;
                } 
                if($key == $obj->toss_win_team_id)
                {
                    $obj->toss_win_team = $value;
                } 
            }
            foreach($team_b_name as $key=>$value){
                if($key == $obj->team_b_id){
                    $obj->team_b = $value;
                } 
                if($key == $obj->loser_team_id)
                {
                    $obj->loser_team = $value;
                } 
                if($key == $obj->toss_win_team_id)
                {
                    $obj->toss_win_team = $value;
                } 
            }
               
        };
       
        return ([
            $matches
            ]);
    }

    /**
     * Display a listing of all matches.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResults()
    {
        return Result::get();
    }

    /** 
    * Display a listing of particular match details
    *
    * @return \Illuminate\Http\Response
    */
    public function getMatch($id){
        $matches =  Venue::join('matches', 'matches.venue_id', '=', 'venues.id')
                        ->join('results','results.id','=','matches.result_id')
                        ->get();

        $matches = json_decode($matches); 

        foreach($matches as $obj){
            $team_a_name[$obj->team_a_id] = Team::where('id','=',$obj->team_a_id)
                                            ->get(['team_name', 'team_code']);
        };
        foreach($matches as $obj){
            $team_b_name[$obj->team_b_id] = Team::where('id','=',$obj->team_b_id)
                                            ->get(['team_name', 'team_code']);
        };

        foreach($matches as $obj){
            foreach($team_a_name as $key=>$value){
                if($key == $obj->team_a_id){
                    $obj->team_a = $value;
                }
                if($key == $obj->winner_team_id)
                {
                    $obj->winner_team = $value;
                } 
                if($key == $obj->toss_win_team_id)
                {
                    $obj->toss_win_team = $value;
                } 
            }
            foreach($team_b_name as $key=>$value){
                if($key == $obj->team_b_id){
                    $obj->team_b = $value;
                } 
                if($key == $obj->loser_team_id)
                {
                    $obj->loser_team = $value;
                } 
                if($key == $obj->toss_win_team_id)
                {
                    $obj->toss_win_team = $value;
                } 
            }       
        };

        foreach($matches as $obj){
            if($obj->id == $id){
                $match = array($obj);
            }
        }
        return (
             $match
    );

        
    }


}
