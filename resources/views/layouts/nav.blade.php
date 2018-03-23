<div class="blog-masthead">
    <div class="container">
        <nav class="nav blog-nav">
            <a class="nav-link active" href="/">Home</a>
            <a class="nav-link" href="#">New hires</a>
            <a class="nav-link" href="#">About</a>
            @if(Auth::check())
                <a class="nav-link" href="/teams/create">Create a team</a>
                <a class="nav-link ml-auto" href="/players/{{Auth::user()->id}}}">{{Auth::user()->name}} {{Auth::user()->surname}}</a>
                <a class="nav-link ml-auto" href="/logout">Logout</a>
            @else
                <a class="nav-link" href="/register">Register</a>
                <a class="nav-link ml-auto" href="/login">Login</a>
            @endif
        </nav>
    </div>
</div>