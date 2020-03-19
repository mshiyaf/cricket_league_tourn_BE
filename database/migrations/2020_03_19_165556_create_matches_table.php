<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->date('match_date');
            $table->bigInteger('team_a_id')->unsigned();
            $table->bigInteger('team_b_id')->unsigned();
            $table->bigInteger('venue_id')->unsigned();
            $table->bigInteger('result_id')->unsigned();
            $table->foreign('team_a_id')->references('id')->on('teams');
            $table->foreign('team_b_id')->references('id')->on('teams');
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->foreign('result_id')->references('id')->on('results');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
