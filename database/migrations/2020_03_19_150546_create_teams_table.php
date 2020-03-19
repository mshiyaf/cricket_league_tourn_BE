<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   Schema::disableForeignKeyConstraints();
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('team_code');
            $table->string('team_name');
            $table->integer('cups_won');
            $table->integer('games_played');
            $table->bigInteger('captain_id')->unsigned();
            $table->string('team_image');
            $table->foreign('captain_id')->references('id')->on('players');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
