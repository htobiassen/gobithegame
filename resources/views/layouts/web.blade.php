<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta data -->
        <meta charset="utf-8">
        <meta content="ie=edge" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="language" content="en">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--STYLESHEET & SCRIPTS -->
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

        <script src="https://kit.fontawesome.com/7003644e09.js" crossorigin="anonymous"></script>

        <!--FAVICON -->
        <link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        @stack('head')



    </head>
    <body class="">

        <div class="container-full-page bg-main">
            @yield('content')
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
