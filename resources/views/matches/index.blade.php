@extends('layouts.master')

@section('content')
    <div class="container">
        <ul>
            @foreach($matches as $match)
                <li><a href="/matches/{{ $match->id }}">{{ $match->id }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection