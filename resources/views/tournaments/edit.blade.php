@extends('layouts.master')

@section('content')
    <h1>Edit: {{$tournament->tournament_name}}</h1>

    <div class="form-group">
        <form method="POST" action="/tournaments/{{$tournament->id}}/change_tournament_name">
            @csrf
            <div class="form-group">
                <label for="tournament_name">Tournament Name</label>
                <input type="text" class="form-control" id="tournament_name" name="tournament_name">
            </div>

            <button type="submit" class="btn btn-primary">Change tournament name</button>
        </form>
    </div>

    <div class="form-group">
        <a href="/tournaments/{{ $tournament->id }}/generate_groups">
            <button type="submit" class="btn btn-info">Generate groups!</button>
        </a>
    </div>
    <div class="form-group">
        <a href="/tournaments/{{ $tournament->id }}/create_bracket">
            <button type="submit" class="btn btn-info">Create bracket!</button>
        </a>
    </div>
    <div class="form-group">
        <a href="/tournaments/{{ $tournament->id }}/next_round">
            <button type="submit" class="btn btn-info">Next round!</button>
        </a>
    </div>
    <div class="form-group">
        <a href="/tournaments/{{ $tournament->id }}/calculate_score">
            <button type="submit" class="btn btn-info">Calculate score of all groups!</button>
        </a>
    </div>

    <div class="form-group">
        <a href="/tournaments/{{$tournament->id}}"><button type="submit" class="btn btn-dark">Go back</button></a>
    </div>
    @include('layouts.errors')
@endsection