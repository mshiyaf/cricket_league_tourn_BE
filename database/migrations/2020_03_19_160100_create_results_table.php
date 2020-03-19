<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('toss_win_team_id')->unsigned();
            $table->string('toss_choice');
            $table->bigInteger('winner_team_id')->unsigned();
            $table->bigInteger('loser_team_id')->unsigned();
            $table->integer('winner_runs');
            $table->integer('winner_wicket');
            $table->integer('loser_runs');
            $table->integer('loser_wicket');
            $table->string('won_by');
            $table->bigInteger('player_of_the_match_id')->unsigned();
            $table->foreign('player_of_the_match_id')->references('id')->on('players');
            $table->foreign('toss_win_team_id')->references('id')->on('teams');
            $table->foreign('winner_team_id')->references('id')->on('teams');
            $table->foreign('loser_team_id')->references('id')->on('teams');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
