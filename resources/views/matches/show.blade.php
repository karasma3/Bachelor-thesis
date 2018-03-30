@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Match:</h1>
        <h2>{{ $match->buildName() }}</h2>
        <div class="form-group">
            Final score: {{ $match->buildResult() }}
        </div>
        <h1>Edit:</h1>
        <a href="/matches/{{ $match->id }}/edit">Edit match</a>
    </div>
@endsection