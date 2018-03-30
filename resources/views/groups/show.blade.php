@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Group: {{ $group -> group_name }}</h1>
        <ul>
            @foreach($group->matches as $match)
                <li><a href="/matches/{{ $match->id }}">{{ $match->id }}</a></li>
            @endforeach
        </ul>
        <ul>
            @foreach($group->teams as $team)
                <li><a href="/teams/{{ $team->id }}">{{ $team->id }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection