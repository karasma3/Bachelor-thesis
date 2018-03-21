@extends('layouts.master')

@section('content')
    <div class="container">
        <ul>
            @foreach($eliminations as $elimination)
                <li>{{ $elimination }}</li>
            @endforeach
        </ul>
    </div>
@endsection