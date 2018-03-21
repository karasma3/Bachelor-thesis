@extends('layouts.master')

@section('content')
    <div class="container">
        <ul>
            @foreach($teams as $team)
                <li>{{ $team }}</li>
            @endforeach
        </ul>
    </div>
@endsection