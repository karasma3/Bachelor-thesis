@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Tímy:</h1>
        <ul>
            @foreach($teams as $team)
                @if($team->active)
                    <div class="form-group">
                        <a href="/teams/{{ $team->id }}">
                            {{ $team->team_name }}
                        </a>
                    </div>
                @endif
            @endforeach
        </ul>
    </div>
@endsection