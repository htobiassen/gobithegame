<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta data -->
        <meta charset="utf-8">
        <meta content="ie=edge" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="language" content="en">

        <!-- Primary Meta Tags -->
        <title>$GOBI the Game</title>
        <meta name="description" content="$GOBI the Game is an exciting strategy game where you gather resources, upgrade goblins, and fend off sneaky enemies. Built for the $GOBI community!">
        <meta name="keywords" content="$GOBI the Game, $GOBI Game, strategy game, goblins, resource gathering, crypto gaming, game development, Laravel game">
        <meta name="author" content="@heintriss">

        <!-- Open Graph / Facebook -->
        <meta property="og:title" content="$GOBI the Game">
        <meta property="og:description" content="Dive into the world of $GOBI the Game! Manage goblins, collect resources, and defend against enemies in this fun, strategy game built for the $GOBI community.">
        <meta property="og:image" content="{{ asset('images/backgrounds/main.webp') }}">
        <meta property="og:url" content="https://gobithegame.com">
        <meta property="og:type" content="website">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="$GOBI the Game">
        <meta name="twitter:description" content="Play $GOBI the Game! Gather resources, upgrade goblins, and defend your base in this exciting game for the $GOBI community.">
        <meta name="twitter:image" content="{{ asset('images/backgrounds/main.webp') }}">
        <meta name="twitter:site" content="@Heintriss">
        <meta name="twitter:creator" content="@Heintriss">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--STYLESHEET & SCRIPTS -->
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

        <script src="https://kit.fontawesome.com/7003644e09.js" crossorigin="anonymous"></script>

        <!--FAVICON -->
        <link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        @stack('head')

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-1EHXMJM3Z5"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-1EHXMJM3Z5');
        </script>

    </head>
    <body class="">

        <div class="container-full-page bg-main">
            @yield('content')
        </div>

        <!-- Game Over Modal -->
        <div class="modal fade" id="game-over-modal" tabindex="-1" role="dialog" aria-labelledby="gameOverModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-secondary text-white">
                    <div class="modal-header">
                        <h5 class="modal-title" id="gameOverModalLabel">Game Over!</h5>
                    </div>
                    <div class="modal-body">
                        <p>You achieved a score of <span id="final-score"></span>.</p>
                        <p>Enter your name to save your score:</p>
                        <input type="text" id="player-name-input" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submit-score-button" class="btn btn-primary">Submit Score</button>
                    </div>
                </div>
            </div>
        </div>



        @include('web.partials.toast')
        @include('web.partials.footer')


        <!--YIELD EXTRA SCRIPT IN BLADES-->
        @yield('scripts')
        @stack('scripts')


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


        @section('scripts')

        @endsection
    </body>
</html>
