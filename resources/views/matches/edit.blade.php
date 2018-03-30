@extends('layouts.master')

@section('content')
    <h1>Edit score of match: {{$match->id}} </h1>
    <form method="POST" action="/matches/{{ $match->id }}">
        @csrf
        {{method_field('PATCH')}}
        <div class="form-group">
            <label for="score_first">First team score</label>
            <input type="text" class="form-control" id="score_first" name="score_first">
            <label for="score_second">Second team score</label>
            <input type="text" class="form-control" id="score_second" name="score_second">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/matches/{{ $match->id }}"><button type="button" class="btn btn-dark">Go back</button></a>
        </div>
    </form>
    @include('layouts.errors')
@endsection