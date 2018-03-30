@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Matches:</h1>
        <ul>
            @foreach($matches as $match)
                <li><a href="/matches/{{ $match->id }}">{{ $match->buildName() }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection