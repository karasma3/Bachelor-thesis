@extends('layouts.master')

@section('content')
    <div class="container">
        <ul>
            @foreach($tournaments as $tournament)
                <li>{{ $tournament }}</li>
            @endforeach
        </ul>
    </div>
@endsection