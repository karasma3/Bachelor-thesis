@extends('layouts.master')

@section('content')
    <h1>Edit: {{$player->name}} {{ $player->surname }}</h1>
    <form method="POST" action="/players/{{ $player->id }}">
        @csrf
        {{method_field('PATCH')}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <h1>Change password</h1>
    <form method="POST" action="/players/{{ $player->id }}/password">
        @csrf
        {{method_field('PATCH')}}
        <div class="form-group">
            <label for="current-password">Current password:</label>
            <input type="password" class="form-control" id="current-password" name="current-password">
        </div>
        <div class="form-group">
            <label for="password">New password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Password Confirmation:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Change password</button>
        </div>
    </form>
    <div class="form-group">
        <a href="/players/{{ $player->id }}"><button type="button" class="btn btn-dark">Go back</button></a>
    </div>
    @include('layouts.errors')
@endsection