@extends('layouts.master')

@section('content')
    <div class="container">

            {{ $player -> name }}
            {{ $player -> surname }}
            {{ $player -> email }}
        <ul>
            @foreach( $player -> teams as $team )
                <li> {{ $team -> team_name }}</li>
            @endforeach
        </ul>
    </div>
@endsection