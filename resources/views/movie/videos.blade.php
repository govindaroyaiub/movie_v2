<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $movie_details->movie_title }}</title>
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
    {!! $movie_details->fb_pixel !!}
    {!! $movie_details->google_pixel !!}
</head>
<body>

<section id="root" class="mvoie-body">
    <header class="movie-header position-relative text-white py-3">
        <h1 class="text-center m-0">{{ $movie_details->movie_title }}
            - {{ $movie_details->movie_description_short_nl }}</h1>

        @include('movie._flag')
    </header>

    @include('movie.nav')

    <main class="movie-content text-white">
        <div class="container-fluid">
            <iframe class="yt-iframe" src="{{ $youtube_url }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>
    </main>


    <footer class="movie-footer text-white text-center">
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#cookies">Cookies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Gebruiksvoorwaarden">Gebruiksvoorwaarden</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#privacy-policy">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#credits">Credits</a>
                </li>
            </ul>

            <div class="tab-content pt-3">
                <div id="cookies" class="container tab-pane">
                    <p>
                        {{ $movie_details->cookies_nl }}
                    </p>
                </div>
                <div id="Gebruiksvoorwaarden" class="container tab-pane fade">
                    <p>
                        {{ $movie_details->terms_of_use_nl }}
                    </p>
                </div>
                <div id="privacy-policy" class="container tab-pane fade">
                    <p>
                        {{ $movie_details->privacy_policy_nl }}
                    </p>
                </div>
                <div id="credits" class="container tab-pane fade">
                    <p>
                        {{ $movie_details->credits_nl }}
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <ul class="footer-social">
                        <li><a target="_blank" href="{{ $movie_details->fb_link }}"><i
                                    class="fab fa-facebook-square"></i></a></li>
                        <li><a target="_blank" href="{{ $movie_details->twitter_link }}"><i class="fab fa-twitter"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</section>

<script src="{{ mix('js/main.js') }}"></script>
</body>
</html>

