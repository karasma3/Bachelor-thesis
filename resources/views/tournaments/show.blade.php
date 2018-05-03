@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Turnaj: {{ $tournament -> tournament_name }}</h1>

        <h2>Prihlásené tímy:</h2>
        <ul>
            @foreach($tournament->teams as $team)
                <li><a href="/teams/{{ $team->id }}">{{ $team->team_name }}</a> </li>
            @endforeach
        </ul>
        @if($tournament->isGroupStage())
            <h2>Skupiny:</h2>
            @foreach($tournament->groups as $group)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{$group->group_name}}</th>
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
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endforeach
        @endif
        @if($tournament->isCreated())
            <a href="/tournaments/{{ $tournament->id }}/join"><button type="button" class="btn btn-info">Registrovať</button></a>
        @endif
        <a href="/tournaments"><button type="button" class="btn btn-dark">Späť</button></a>
        </br>
        <a href="/tournaments/{{ $tournament->id }}/edit">Správa turnaja</a>
    </div>
@endsection