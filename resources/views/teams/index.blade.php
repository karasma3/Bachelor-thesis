@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Teams:</h1>
        <ul>
            @foreach($teams as $team)
                <div class="form-group">
                    <a href="/teams/{{ $team->id }}">
                        {{ $team->team_name }}
                    </a>
                </div>
            @endforeach
        </ul>
    </div>
@endsection