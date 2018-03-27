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
        <a href="/teams/{{ $team->id }}/edit">Edit a team</a>
    </div>
@endsection