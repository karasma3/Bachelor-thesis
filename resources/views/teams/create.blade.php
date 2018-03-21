@extends('layouts.master')

@section('content')
    <h1>Create a TEAM</h1>
    <form method="POST" action="/teams">
        @csrf
        <div class="form-group">
            <label for="Player2_Email">Email address</label>
            <input type="email" class="form-control" id="Player2_Email" name="email">
        </div>

        <div class="form-group">
            <label for="name">Player 2 Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="surname">Player 2 Surname</label>
            <input type="text" class="form-control" id="surname" name="surname">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection