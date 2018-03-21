@extends('layouts.master')

@section('content')
    <div class="container">
        <ul>
            @foreach($groups as $group)
                <li>{{ $group }}</li>
            @endforeach
        </ul>
    </div>
@endsection