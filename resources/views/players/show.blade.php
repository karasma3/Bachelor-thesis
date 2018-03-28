@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Player</h1>
        <ul>
            <li>Meno: {{ $player -> name }}</li>
            <li>Prijmeni: {{ $player -> surname }}</li>
            <li>e-mail: {{ $player -> email }}</li>
        </ul>
        <h2>Teams</h2>
        <ul>
            @foreach( $player -> teams as $team )
                <li> <a href="/teams/{{ $team->id }}">{{ $team -> team_name }}</a></li>
            @endforeach
        </ul>
        <h1>Edit:</h1>
        <a href="/players/{{ $player->id }}/edit">Edit player</a>
    </div>
@endsection