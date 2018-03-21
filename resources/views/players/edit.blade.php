@extends('layouts.master')

@section('content')
    <h1>Edit {{$player}}</h1>
    <form method="PATCH" action="/players/{player}">
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