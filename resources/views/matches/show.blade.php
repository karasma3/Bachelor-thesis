@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Match: {{ $match->id }}</h1>

        <div class="form-group">
            Final score: {{ $match->score_first }}:{{ $match->score_second }}
        </div>
        <h1>Edit:</h1>
        <a href="/matches/{{ $match->id }}/edit">Edit match</a>
    </div>
@endsection