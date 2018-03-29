@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Tournament: {{ $tournament -> tournament_name }}</h1>

        <h2>Signed players:</h2>
        <ul>
            @foreach($tournament->teams as $team)
                <li><a href="/teams/{{ $team->id }}">{{ $team->team_name }}</a> </li>
            @endforeach
        </ul>
        <a href="/tournaments/{{ $tournament->id }}/join"><button type="button" class="btn btn-info">Sign in</button></a>
        <a href="/tournaments"><button type="button" class="btn btn-dark">Go back</button></a>
    </div>
@endsection