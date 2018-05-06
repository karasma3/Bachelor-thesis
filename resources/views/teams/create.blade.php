@extends('layouts.master')

@section('content')
    <h1>Vytvor tím pre štvorhru</h1>
    <form method="POST" action="/teams">
        @csrf
        {{--<div class="form-group">--}}
            {{--<label for="team_name">Team Name</label>--}}
            {{--<input type="text" class="form-control" id="team_name" name="team_name">--}}
        {{--</div>--}}
        <div class="form-group">
            <label for="email">E-mail druhého hráča</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Vytvor</button>
        </div>
    </form>

    @include('layouts.errors')
@endsection