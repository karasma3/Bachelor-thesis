@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Turnaje:</h1>
        <ul>
            @foreach($tournaments->sortBy(function($tournament){return $tournament->tournament_name;}) as $tournament)
                <li><a href="/tournaments/{{ $tournament->id }}">{{ $tournament->tournament_name }}</a></li>
            @endforeach
        </ul>
        @if(Auth::check() and Auth::user()->isAdmin())
            <a href="/tournaments/create">Vytvor turnaj</a>
        @endif
    </div>
@endsection