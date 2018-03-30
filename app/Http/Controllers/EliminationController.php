<?php

namespace App\Http\Controllers;

use App\Models\Elimination;
use Illuminate\Http\Request;

class EliminationController extends Controller
{
    public function index(){
        $eliminations = Elimination::all();

        return view('eliminations.index', compact('eliminations'));
    }
    public function show(Elimination $elimination){

        return view('eliminations.show', compact('elimination'));
    }
    public function store(){

    }
}
