<div class="blog-masthead">
    <div class="container">
        <nav class="nav blog-nav">
            <a class="nav-link" href="/">Domov</a>
            <a class="nav-link" href="/tournaments">Turnaje</a>
            {{--<a class="nav-link" href="/groups">Groups</a>--}}
            {{--<a class="nav-link" href="/eliminations">Eliminations</a>--}}
            <a class="nav-link" href="/teams">Tímy</a>
            {{--<a class="nav-link" href="/matches">Matches</a>--}}
            <a class="nav-link" href="/players">Hráči</a>
            @if(Auth::check())
                <a class="nav-link" href="/teams/create">Vytvor tím</a>
                <a class="nav-link ml-auto" href="/players/{{Auth::id()}}">{{Auth::user()->name}} {{Auth::user()->surname}}</a>
                <a class="nav-link ml-auto" href="/logout">Odhlásiť</a>
            @else
                <a class="nav-link ml-auto" href="/register">Registrácia</a>
                <a class="nav-link ml-auto" href="/login">Prihlásiť sa</a>
            @endif
        </nav>
    </div>
</div>