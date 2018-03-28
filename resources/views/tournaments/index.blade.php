@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Tournaments:</h1>
        <ul>
            @foreach($tournaments as $tournament)
                <li><a href="/tournaments/{{ $tournament->id }}">{{ $tournament->tournament_name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection