@extends('layouts.master')

@section('content')

    <h1>Prihlásiť sa na {{ $tournament->tournament_name }}</h1>

    <div class="form-group">
        <form method="POST" action="/tournaments/{{$tournament->id}}/join">
            @csrf
            <div class="form-group">
                <label for="team_id">Tím:</label></br>
                <select type="text" class="form-control"  id="team_id" name="team_id">
                    <option disabled selected> -- vyber možnosť -- </option>
                    @foreach( auth()->user()->teams as $team)
                        <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registruj</button>
        </form>
        <div class="form-group">

            <a href="/tournaments/{{ $tournament->id }}"><button type="submit" class="btn btn-dark">Späť</button></a>
        </div>
    </div>
    @include('layouts.errors')
@endsection