@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Team: {{ $team->team_name }}</h1>
        <h2>Players:</h2>
        <ul>
            @foreach( $team->players as $player)
                <li><a href="/players/{{ $player->id }}">{{ $player->name }} {{ $player->surname }}</a> </li>
            @endforeach
        </ul>
        <div class="form-group">
            <a href="/teams/{{ $team->id }}/edit">Edit a team</a>
        </div>
        <div class="form-group">
            <a href="/teams/{{ $team->id }}/delete">Delete a team</a>
        </div>
        <a href="/teams"><button type="submit" class="btn btn-dark">Go back</button></a>
    </div>
@endsection