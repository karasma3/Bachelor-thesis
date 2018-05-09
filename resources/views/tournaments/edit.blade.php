@extends('layouts.master')

@section('content')
    <h1>Správa: {{$tournament->tournament_name}}</h1>

    <div class="form-group">
        <form method="POST" action="/tournaments/{{$tournament->id}}/change_tournament_name">
            @csrf
            <div class="form-group">
                <label for="tournament_name">Meno turnaja</label>
                <input type="text" class="form-control" id="tournament_name" name="tournament_name">
            </div>

            <button type="submit" class="btn btn-primary">Zmeň</button>
        </form>
    </div>
    @if($tournament->isCreated())
        <div class="form-group">
            <a href="/tournaments/{{ $tournament->id }}/generate_groups">
                <button type="submit" class="btn btn-info">Generuj skupiny!</button>
            </a>
        </div>
    @endif
    @if($tournament->isGroupStage())
        <div class="form-group">
            <a href="/tournaments/{{ $tournament->id }}/calculate_score">
                <button type="submit" class="btn btn-info">Prepočítaj výsledky skupín!</button>
            </a>
        </div>
        <div class="form-group">
            <a href="/tournaments/{{ $tournament->id }}/create_bracket">
                <button type="submit" class="btn btn-info">Vytvor pavúka!</button>
            </a>
        </div>
    @endif
    @if($tournament->isEliminationStage())
        <div class="form-group">
            <a href="/tournaments/{{ $tournament->id }}/next_round">
                <button type="submit" class="btn btn-info">Ďalšie kolo!</button>
            </a>
        </div>
        <div class="form-group">
            <a href="/tournaments/{{ $tournament->id }}/close">
                <button type="submit" class="btn btn-info">Ukonči turnaj</button>
            </a>
        </div>
    @endif

    <div class="form-group">
        <a href="/tournaments/{{$tournament->id}}"><button type="submit" class="btn btn-dark">Späť</button></a>
    </div>
    @include('layouts.errors')
@endsection