@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Turnaj: {{ $tournament -> tournament_name }}</h1>
        <h3 class="mt-4 ml-5">Stav: {{$tournament->getState()}}</h3>
        <div class="mt-5">
        @if($tournament->isCreated())
            <h2>Prihlásené tímy:</h2>
            <ul>
                @foreach($tournament->teams as $team)
                    <li><a href="/teams/{{ $team->id }}">{{ $team->team_name }}</a> </li>
                @endforeach
            </ul>
        @endif
        @if($tournament->isGroupStage())
            <h2>Skupiny:</h2>
            @foreach($tournament->groups as $group)
                @include('layouts.table')
            @endforeach
        @endif
        @if($tournament->isEliminationStage())
            <h2>Pavúk:</h2>
            @foreach($tournament->brackets as $bracket)
                <h2>{{$bracket->group_name}}</h2>
                <h3>Tímy:</h3>
                <ul>
                @foreach($bracket->teams as $team)
                    <li><a href="/teams/{{ $team->id }}">{{ $team->team_name }}</a></li>
                @endforeach
                </ul>
                <h3>Zápasy:</h3>
                <ul>
                @foreach($bracket->matches as $match)
                    <li><a href="/matches/{{ $match->id }}">{{ $match->buildName() }}</a> <p style="display: inline">{{$match->played}}</p></li>
                @endforeach
                </ul>
            @endforeach
        @endif
        @if($tournament->isCreated() and Auth::check())
            <a href="/tournaments/{{ $tournament->id }}/join"><button type="button" class="btn btn-info">Registrovať</button></a>
        @endif
        <a href="/tournaments"><button type="button" class="btn btn-dark">Späť</button></a>
        </br>
        @if(Auth::check() and Auth::user()->isAdmin())
            <a href="/tournaments/{{ $tournament->id }}/edit">Správa turnaja</a>
        @endif
        </div>
    </div>
@endsection