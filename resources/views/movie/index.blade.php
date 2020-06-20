<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $movie_details->movie_title }}</title>
    <link rel='stylesheet' href='//api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.css'/>
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css'/>
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
</head>
<body>

<a class="trailer-video d-none" href="{{ $youtube_url }}?autoplay=1&mute=1"></a>

<section id="root" class="mvoie-body">
    <header class="movie-header position-relative text-white py-3">
        <h1 class="text-center m-0">{{ $movie_details->movie_title }}
            - {{ $movie_details->movie_description_short_nl }}</h1>

        @include('movie._flag')
    </header>

    @include('movie.nav')

    <main class="movie-content text-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-lg-6 poster-hide">
                    <div class="poster">
                        <img
                            loading="lazy"
                            class="d-block mx-auto"
                            src="{{ $movie_details->image1 }}"
                            alt="">

                        <p class="d-md-none text-center m-0 mb-2">{{ $movie_details->movie_title }}
                            - {{ $movie_details->movie_description_short_nl }}</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 ">
                    <div class="showtimes">
                        <form class="search-form">
                            <input class="search-input map-search" type="text" name="search"
                                   placeholder="Search.."
                                   autocomplete="off">
                            <button class="search-button" type="submit">&times;</button>
                        </form>

                        <div class="search-meta text-center my-2">
                            <p>kies uw stad of locatie</p>
                            <p>meer vertoningen in deze steden</p>

                            <div class="main-accordion accordion d-none" id="mainAccordionId"></div>
                            <div class="city-accordion accordion d-none" id="cityAccordionId"></div>

                            <ul class="city-map-js my-3"></ul>
                        </div>

                        <p class="text-center my-2">bekijk de trailer</p>

                        <div class="youtube-trailer">
                            <iframe class="yt-iframe" src="{{ $youtube_url }}"
                                    frameborder="0"
                                    loading="lazy"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 ">
                    @include('movie._map')
                </div>
            </div>
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

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment-with-locales.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone.min.js"></script>
<script src='//api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.js'></script>
<script src="{{ mix('js/main.js') }}"></script>
</body>
</html>



