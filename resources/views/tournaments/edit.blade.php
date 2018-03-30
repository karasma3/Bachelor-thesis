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

    TODO
    Generate groups
    Generate eliminations

    <div class="form-group">
        <a href="/tournaments/{{$tournament->id}}"><button type="submit" class="btn btn-dark">Go back</button></a>
    </div>
    @include('layouts.errors')
@endsection