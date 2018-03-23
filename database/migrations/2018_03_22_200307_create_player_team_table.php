<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_team', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('player_id');
             $table->integer('team_id');

             $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
             $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_team');
    }
}
