@extends('layouts.master')

@section('content')
    <h1>Edit {{$match}}</h1>
    <form method="PATCH" action="/matches/match">
        <div class="form-group">
            <label for="result">result</label>
            <input type="text" class="form-control" id="result" name="result">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection