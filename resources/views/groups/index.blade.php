@extends('layouts.master')

@section('content')
    <div class="container">
        <ul>
             @foreach($groups as $group)
                <ul>
                    <li><a href="/groups/{{ $group->id }}">{{ $group->group_name }}</a></li>
                </ul>
            @endforeach
        </ul>
    </div>
@endsection