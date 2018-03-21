<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Match;

class MatchController extends Controller
{
    public function index(){
        $matches = Match::all();

        return view('matches.index', compact('matches'));
    }
    public function show(Match $match){

        return view('matches.show', compact('match'));
    }
}
