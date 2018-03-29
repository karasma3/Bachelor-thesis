@extends('layouts.master')

@section('content')

    <h1>Create a TOURNAMENT</h1>
    <form method="POST" action="/tournaments">
        @csrf
        <div class="form-group">
            <label for="tournament_name">Tournament Name</label>
            <input type="text" class="form-control" id="tournament_name" name="tournament_name">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    @include('layouts.errors')
@endsection