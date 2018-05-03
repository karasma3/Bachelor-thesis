@extends('layouts.master')

@section('content')
    <h1>Zapísanie výsledku zápasu: {{$match->buildName()}} </h1>
    <form method="POST" action="/matches/{{ $match->id }}">
        @csrf
        {{method_field('PATCH')}}
        <div class="form-group">
            <label for="score_first">Skóre {{$match->teamFirstName()}}</label>
            <input type="text" class="form-control" id="score_first" name="score_first">
            <label for="score_second">Skóre {{$match->teamSecondName()}}</label>
            <input type="text" class="form-control" id="score_second" name="score_second">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Odoslať</button>
            <a href="/matches/{{ $match->id }}"><button type="button" class="btn btn-dark">Späť</button></a>
        </div>
    </form>
    @include('layouts.errors')
@endsection