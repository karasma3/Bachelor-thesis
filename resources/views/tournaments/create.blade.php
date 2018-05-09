@extends('layouts.master')

@section('content')

    <h1>Vytvor turnaj</h1>
    <form method="POST" action="/tournaments">
        @csrf
        <div class="form-group">
            <label for="tournament_name">Meno turnaja</label>
            <input type="text" class="form-control" id="tournament_name" name="tournament_name">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Vytvor</button>
        </div>
    </form>

    @include('layouts.errors')
@endsection