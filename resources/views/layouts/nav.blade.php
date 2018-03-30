<div class="blog-masthead">
    <div class="container">
        <nav class="nav blog-nav">
            <a class="nav-link" href="/">Home</a>
            <a class="nav-link" href="/tournaments">Tournaments</a>
            <a class="nav-link" href="/groups">Groups</a>
            <a class="nav-link" href="/eliminations">Eliminations</a>
            <a class="nav-link" href="/teams">Teams</a>
            <a class="nav-link" href="/matches">Matches</a>
            <a class="nav-link" href="/players">Players</a>
            @if(Auth::check())
                <a class="nav-link" href="/teams/create">Create a team</a>
                <a class="nav-link ml-auto" href="/players/{{Auth::id()}}">{{Auth::user()->name}} {{Auth::user()->surname}}</a>
                <a class="nav-link ml-auto" href="/logout">Logout</a>
            @else
                <a class="nav-link ml-auto" href="/register">Register</a>
                <a class="nav-link ml-auto" href="/login">Login</a>
            @endif
        </nav>
    </div>
</div>