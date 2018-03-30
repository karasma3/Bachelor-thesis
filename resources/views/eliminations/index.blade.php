@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Eliminations:</h1>
        <ul>
            @foreach($eliminations as $elimination)
                <li><a href="/eliminations/{{ $elimination->id }}">{{ $elimination->elimination_name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection