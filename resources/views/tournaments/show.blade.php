@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Tournament: {{ $tournament -> tournament_name }}</h1>

        <h2>Signed teams:</h2>
        <ul>
            @foreach($tournament->teams as $team)
                <li><a href="/teams/{{ $team->id }}">{{ $team->team_name }}</a> </li>
            @endforeach
        </ul>
        <a href="/tournaments/{{ $tournament->id }}/join"><button type="button" class="btn btn-info">Sign in</button></a>
        <a href="/tournaments"><button type="button" class="btn btn-dark">Go back</button></a>
        </br>
        <a href="/tournaments/{{ $tournament->id }}/edit">Edit tournament</a>
    </div>
@endsection