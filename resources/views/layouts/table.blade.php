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