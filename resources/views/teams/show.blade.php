@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Team: {{ $team->team_name }}</h1>
        <h2>Players:</h2>
        <ul>
            <li><a href="/players/{{ $team->player_id_first }}">{{ $team->playerFirstFullName() }} </a> </li>
            @if($team->player_id_second)
                <li><a href="/players/{{ $team->player_id_second }}">{{ $team->playerSecondFullName() }} </a> </li>
            @endif
        </ul>
        {{--<div class="form-group">--}}
            {{--<a href="/teams/{{ $team->id }}/edit">Edit a team</a>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<a href="/teams/{{ $team->id }}/delete">Delete a team</a>--}}
        {{--</div>--}}
        @if(!$team->singles)
            <div class="form-group">
                <a href="/teams/{{ $team->id }}/inactivate">Make a team inactive</a>
            </div>
        @endif
        <a href="/teams"><button type="submit" class="btn btn-dark">Go back</button></a>
    </div>
@endsection