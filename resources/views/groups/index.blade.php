@extends('layouts.master')

@section('content')
    <div class="container">
        <ul>
            @foreach($archives as $archive)
                <li>{{$archive->tournament_name}}</li>
                @foreach($groups as $group)
                    @if($archive->id == $group->tournament_id)
                            <ul>
                                <li>{{ $group->group_name }}</li>
                            </ul>
                    @endif
                @endforeach
            @endforeach
        </ul>
    </div>
@endsection