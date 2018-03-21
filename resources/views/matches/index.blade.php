@extends('layouts.master')

@section('content')
    <div class="container">
        <ul>
            @foreach($matches as $match)
                <li>{{ $match }}</li>
            @endforeach
        </ul>
    </div>
@endsection