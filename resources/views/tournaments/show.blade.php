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
            <div class="m-md-5">
            <h2>Pavúk:</h2>
            @include('layouts.bracket')
            <h2>Timy:</h2>
            <ul>
            @foreach($tournament->teamsInEliminationStage as $team)
                    <li><a href="/teams/{{$team->id}}">{{$team->team_name}}</a></li>
            @endforeach
            </ul>
            @foreach($tournament->brackets as $bracket)
                <h2>{{$bracket->group_name}}</h2>
                <h3>Zápasy:</h3>
                <ul>
                @foreach($bracket->matchesInOrder as $match)
                    <li><a href="/matches/{{ $match->id }}">{{ $match->buildName() }}</a> <p style="display: inline">{{$match->buildResult()}}</p></li>
                @endforeach
                </ul>
            @endforeach
            </div>
        @endif
        @if($tournament->isClosed())

        @endif
        <div class="buttons">
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

    </div>
@endsection