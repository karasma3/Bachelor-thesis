@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Elimination: {{ $elimination -> elimination_name }}</h1>
        <ul>
            @foreach($elimination->matches as $match)
                <li><a href="/matches/{{ $match->id }}">{{ $match->id }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection