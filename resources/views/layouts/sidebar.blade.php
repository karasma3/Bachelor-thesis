<div class="col-sm-3 offset-sm-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>Turnaje</h4>
        <ol class="list-unstyled">
            @foreach($archives as $archive)
                <li>
                    <a href="/tournaments/{{$archive->id}}">
                        {{$archive->tournament_name}}
                    </a>
                </li>
            @endforeach
        </ol>
    </div>
</div><!-- /.blog-sidebar -->