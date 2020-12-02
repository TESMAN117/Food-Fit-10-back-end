<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Food-Fit-INC -Administracion-</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css">
</head>

<body>

    <div class="container-ms">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href=""><img width="50" height="50" src="{{ asset('storage/logo.png') }}"
                    alt="food fit">Food Fit INC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">

                </ul>
                <div class="form-inline my-2 my-lg-0">
                    @if (Route::has('login'))

                        @auth
                            <a href="{{ url('/inicio') }}" class="">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success my-2 my-sm-0">
                                Inisiar Sesion
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-secondary my-2 my-sm-0">Register</a>
                            @endif
                        @endif

                        @endif
                    </div>
                </div>
            </nav>

            <div class="container-ms">

                <img src="{{ asset('storage/food_logo.gif') }}" class="img-fluid" alt="Responsive image">


            </div>

        </div>



        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" ></script>
    </body>

    </html>
