@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Neodohrané zápasy</h1>
        @foreach($player->teams as $team)

            <h2>{{$team->team_name}}</h2>
            <ul>
            @foreach($team->matches as $match)
                @if(!$match->played)
                    <li><a href="/matches/{{ $match->id }}">{{$match->buildName()}}</a></li>
                @endif
            @endforeach
            </ul>
        @endforeach
        <h1>Hráč</h1>
        <ul>
            <li>Meno: {{ $player -> name }}</li>
            <li>Prijmeni: {{ $player -> surname }}</li>
            <li>e-mail: {{ $player -> email }}</li>
        </ul>
        <h1>Tímy</h1>
        <ul>
            @foreach( $player -> teams as $team )
                <li> <a href="/teams/{{ $team->id }}">{{ $team -> team_name }}</a></li>
            @endforeach
        </ul>
        <h1>Uprav:</h1>
        <a href="/players/{{ $player->id }}/edit">Uprav hráča</a>
    </div>
@endsection