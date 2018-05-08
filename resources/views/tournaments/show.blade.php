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
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><a href="/groups/{{$group->id}}">{{$group->group_name}}</a></th>
                        @foreach($group->teams as $team)
                            <th>{{$team->team_name}}</th>
                        @endforeach
                        <th>Body</th>
                        <th>Skore</th>
                        <th>Poradie</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($group->teams as $team)
                        <tr>
                            <th> {{$team->team_name}} </th>
                            @foreach($group->teams as $opponent)
                                @if($team->id==$opponent->id)
                                    <th class="text-center" bgcolor="#a9a9a9">X</th>
                                @else

                                    @if($group->findMatch($team->id,$opponent->id)->first()->team_id_first == $team->id)
                                        <th class="text-center">{{$group->findMatch($team->id,$opponent->id)->first()->buildResult()}}</th>
                                    @else
                                        <th class="text-center">{{$group->findMatch($team->id,$opponent->id)->first()->buildReverseResult()}}</th>
                                    @endif
                                @endif
                            @endforeach
                            <th class="text-center">{{$team->showPoints($group->id)}}</th>
                            <th class="text-center">{{$team->buildScore($group->id)}}</th>
                            @if(!$group->showOrdering())
                                <th></th>
                            @else
                                <th class="text-center">{{$team->showOrder($group->id)}}</th>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
        <a href="/tournaments/{{ $tournament->id }}/edit">Správa turnaja</a>
        </div>
    </div>
@endsection