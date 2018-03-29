<div class="col-sm-3 offset-sm-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>Strahovská liga ve stolním tenise je studentská soutěž probíhající na strahovských kolejích, která vznikla v letním semetru 2011. Soutěž se hraje semestrálně (tj. 2 ročníky do roka) a může se jí zúčastnit kterýkoliv člen klubu Silicon Hill (chápej kluci i holky, když vás bude dost budete mít oddělenou soutěž).</p>
    </div>
    <div class="sidebar-module">
        <h4>Tournaments</h4>
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
    <div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
    </div>
</div><!-- /.blog-sidebar -->