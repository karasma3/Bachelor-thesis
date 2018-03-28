@extends('layouts.master')

@section('content')
    <h1>Edit: {{$team->team_name}}</h1>

    <div class="form-group">
        <form method="POST" action="/teams/{{$team->id}}/change_team_name">
            @csrf
            <div class="form-group">
                <label for="team_name">Team Name</label>
                <input type="text" class="form-control" id="team_name" name="team_name">
            </div>

            <button type="submit" class="btn btn-primary">Change team name</button>
        </form>
    </div>
    <div class="form-group">
        <form method="POST" action="/teams/{{$team->id}}/add_player">
            @csrf
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <button type="submit" class="btn btn-primary">Add player</button>
        </form>
    </div>

    <div class="form-group">
        <a href="/teams/{{$team->id}}"><button type="submit" class="btn btn-dark">Go back</button></a>
    </div>
    @include('layouts.errors')
@endsection