@extends('layouts.master')

@section('content')
    <h1>Registrácia</h1>
    <form method="POST" action="/register">
        @csrf
            <div class="form-group">
                <label for="name">Meno:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Priezvisko:</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Heslo:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Potvrdenie hesla:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Registruj</button>
            </div>
    </form>
    @include('layouts.errors')
@endsection