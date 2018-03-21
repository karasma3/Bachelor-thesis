<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index(){
        $tournaments = Tournament::all();

        return view('tournaments.index', compact('tournaments'));
    }
    public function show(Tournament $tournament){

        return view('tournaments.show', compact('tournament'));
    }
}
