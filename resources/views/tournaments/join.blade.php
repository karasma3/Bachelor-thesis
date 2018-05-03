@extends('layouts.master')

@section('content')

    <h1>Do you want to join {{ $tournament->tournament_name }}?</h1>

    <div class="form-group">
        <form method="POST" action="/tournaments/{{$tournament->id}}/join">
            @csrf
            <div class="form-group">
                <label for="team_name">Team name:</label></br>
                <select type="text" class="form-control"  id="team_name" name="team_name">
                    <option disabled selected> -- select an option -- </option>
                    @foreach( auth()->user()->teams as $team)
                        <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Yes, sign me in</button>
        </form>
        <div class="form-group">

            <a href="/tournaments/{{ $tournament->id }}"><button type="submit" class="btn btn-dark">No, go back</button></a>
        </div>
    </div>
    @include('layouts.errors')
@endsection