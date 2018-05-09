@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Hráči:</h1>
        <ul>
            @foreach($players as $player)
                <li><a href="/players/{{ $player->id }}">{{ $player->name }} {{ $player->surname }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection