@extends('layouts.master')

@section('content')
    <div class="container">
        <ul>
            @foreach($players as $player)
                <li>{{ $player }}</li>
            @endforeach
        </ul>
    </div>
@endsection