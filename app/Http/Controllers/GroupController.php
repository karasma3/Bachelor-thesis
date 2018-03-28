<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function index(){
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }
    public function show(Group $group){

        return view('groups.show', compact('group'));
    }
    public function store(){

    }
}
