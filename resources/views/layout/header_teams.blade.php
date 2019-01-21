<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">NaNFL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarToggler">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/team/create">Create Team</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/player/create">Create Player</a>
            </li>
        </ul>

        <team-select :teams-data="{{json_encode($teams)}}" teams-endpoint="/api/team"/>
    </div>
</nav>