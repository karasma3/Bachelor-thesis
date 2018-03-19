@extends('layouts.layout')

@section('content')
    <ul>
        @foreach($groups as $group)
            <li>{{ $group }}</li>
        @endforeach
    </ul>
@endsection