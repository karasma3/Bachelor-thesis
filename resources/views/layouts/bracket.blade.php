
<div class="elimination_bracket">
</div>

@section('scripts')
    <script>
        var data ={
            teams:[

            ],
            results:[
            ]
        }
        @foreach($tournament->brackets as $bracket)
                var score =[]
            @foreach($bracket->matchesInOrder as $match)
                score.push([{{$match->scoreFirst()}}, {{$match->scoreSecond()}}]);
            @endforeach
                data.results.push(score);
        @endforeach
        @foreach($tournament->matchesInBracket($tournament->firstRoundBracket) as $match)
            data.teams.push(["{{$match->teamFirstName()}}", "{{$match->teamSecondName()}}"]);
        @endforeach
        $('.elimination_bracket').bracket({
            init:data
        });
        @if( $tournament->teams->count() >32 )
            $('.jQBracket').css('width','1050px');
            $('.jQBracket').css('height','1040px');
        @elseif($tournament->teams->count() >16)
            $('.jQBracket').css('width','850px');
            $('.jQBracket').css('height','520px');
        @else
            $('.jQBracket').css('width','650px');
            $('.jQBracket').css('height','260px');
        @endif
        $('.round').css('width','150px');
        $('.team').css('width','150px');
        $('.label').css('width','120px');
    </script>
@stop