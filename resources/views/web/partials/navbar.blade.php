<nav class="navbar navbar-expand-lg sticky-top bg-none" style="box-shadow: none; background-image: none;">
    <div class="container-fluid text-white">
        <!-- Left Navigation -->
        <ul class="navbar-nav me-auto">
            <div class="btn-group">
                <a href="/" class="btn btn-outline-primary fs-6 fw-bold text-white {{ request()->is('/') ? 'active' : '' }}">
                    Play <img src="{{ asset('images/favicon/favicon-32x32.png') }}" height="22px">
                </a>

                <a href="{{ route('scoreboard') }}" class="btn btn-outline-primary fs-6 fw-bold text-white {{ request()->is('scoreboard') ? 'active' : '' }}">
                    Scoreboard
                </a>
            </div>
        </ul>

        <!-- Right Icons -->
        <div class="d-flex align-items-center ms-auto list-unstyled">
            <li class="nav-item pe-md-5">
                <a class="nav-link text-white fw-bold" aria-current="page" href="/">$GOBI</a>
            </li>
            <a href="https://twitter.com/heintriss" title="X" class="me-3" target="_blank">
                <i class="fa-brands fa-x-twitter fs-5 text-white"></i>
            </a>
        </div>
    </div>
</nav>


