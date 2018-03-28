@extends('layouts.master')

@section('content')
    <h1>Delete: {{$team->team_name}}?</h1>

    <div class="form-group">
        <form method="POST" action="/teams/{{$team->id}}">
            @csrf
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-primary">Delete team</button>
        </form>
    </div>
    <div class="form-group">
        <a href="/teams/{{$team->id}}"><button type="submit" class="btn btn-dark">Go back</button></a>
    </div>
@endsection