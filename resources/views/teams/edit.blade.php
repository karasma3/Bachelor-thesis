@extends('layouts.master')

@section('content')
    <h1>Edit {{$team}}</h1>
    <form method="POST" action="/players/{{Auth::user()->id}}">
        {{method_field('PATCH')}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection