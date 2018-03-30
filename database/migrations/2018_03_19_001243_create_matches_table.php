<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('team_id_first');
            $table->integer('team_id_second');
            $table->integer('group_id')->nullable();
            $table->integer('elimination_id')->nullable();
            $table->integer('score_first')->nullable();
            $table->integer('score_second')->nullable();
            $table->foreign('team_id_first')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('team_id_second')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::dropIfExists('matches');
    }
}
