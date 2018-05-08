@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Zápas:</h1>
        <h2><a href="/teams/{{$match->team_id_first}}">{{$match->teamFirst->team_name}}</a> vs <a href="/teams/{{$match->team_id_second}}">{{$match->teamSecond->team_name}}</a></h2>
        <div class="form-group">
            Výsledné skóre: {{ $match->buildResult() }}
        </div>
        @if(Auth::check() and (Auth::user()->participant($match->team_id_first, $match->team_id_second) or Auth::user()->isAdmin()))
            <h1>Zapíš výsledok:</h1>
            <a href="/matches/{{ $match->id }}/edit">Zapíš výsledok</a>
        @endif
    </div>
@endsection