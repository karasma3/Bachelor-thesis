@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Tím: {{ $team->team_name }}</h1>
        <h2>Hráči:</h2>
        <ul>
            <li><a href="/players/{{ $team->player_id_first }}">{{ $team->playerFirstFullName() }} </a> </li>
            @if($team->player_id_second)
                <li><a href="/players/{{ $team->player_id_second }}">{{ $team->playerSecondFullName() }} </a> </li>
            @endif
        </ul>
        @if(!$team->singles and Auth::check() and (Auth::user()->id==$team->player_id_first or Auth::user()->id==$team->player_id_second or Auth::user()->isAdmin()))
            <div class="form-group">
                <a href="/teams/{{ $team->id }}/inactivate">Deaktivuj tím</a>
            </div>
        @endif
        <a href="/teams"><button type="submit" class="btn btn-dark">Späť</button></a>
    </div>
@endsection