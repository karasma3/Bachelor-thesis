<?php

use Illuminate\Database\Seeder;
use App\Models\Tournament;
use App\Models\Team;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tournament::create([
            'tournament_name' => 'LS2016'
        ]);
        Tournament::first()->teams()->attach(Team::all());
        Tournament::first()->generateGroups();
        Tournament::create([
            'tournament_name' => 'ZS2016'
        ]);
        Tournament::create([
            'tournament_name' => 'LS2017'
        ]);
        Tournament::create([
            'tournament_name' => 'ZS2017'
        ]);
    }
}
