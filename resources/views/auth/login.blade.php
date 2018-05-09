@extends('layouts.master')

@section('content')
    <h1>Prihlásenie</h1>
    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="password">Heslo:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Prihlásiť</button>
        </div>
    </form>
    @include('layouts.errors')
@endsection