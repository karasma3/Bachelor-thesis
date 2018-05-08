@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Skupina: {{ $group -> group_name }}</h1>
        <h2>Tímy:</h2>

        @foreach($group->teams as $team)
            <div class="form-group ml-md-5">
                <a href="/teams/{{ $team->id }}">{{ $team->team_name }}</a>
            </div>
        @endforeach
        <h2>Tabuľka:</h2>
        @include('layouts.table')
        <h2>Zápasy:</h2>
        @foreach($group->matches as $match)
            <div class="form-group ml-md-5">
                <a href="/matches/{{ $match->id }}">{{ $match->buildName() }}</a>
            </div>
        @endforeach
    </div>
@endsection