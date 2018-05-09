<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTournamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_tournament', function (Blueprint $table) {
            $table->integer('team_id');
            $table->integer('tournament_id');
            $table->boolean('elimination_stage')->default(false);
            $table->integer('last_placement')->default(65);
            $table->primary(['team_id', 'tournament_id']);

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_tournament');
    }
}
