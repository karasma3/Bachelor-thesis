<?php

namespace App\Http\Controllers;

use App\Models\Elimination;
use Illuminate\Http\Request;

class EliminationController extends Controller
{
    public function index(){
        $eliminations = Elimination::all();

        $archives_eliminations = Elimination::selectRaw('year(created_at) year, monthname(created_at) month, count(*) created')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();

        return view('eliminations.index', compact('eliminations', 'archives_eliminations'));
    }
    public function show(Elimination $elimination){

        return view('eliminations.show', compact('elimination'));
    }
    public function store(){

    }
}
