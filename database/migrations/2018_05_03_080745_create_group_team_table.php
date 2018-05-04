<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_team', function (Blueprint $table) {
            $table->integer('group_id');
            $table->integer('team_id');
            $table->primary(['group_id', 'team_id']);
            $table->integer('score_won')->default(0);
            $table->integer('score_lost')->default(0);
            $table->integer('points')->default(0);
            $table->integer('ordering')->nullable();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
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
        Schema::dropIfExists('group_team');
    }
}
