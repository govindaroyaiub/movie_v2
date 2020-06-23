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
    <style>
        .panel-heading a:before {
            font-family: 'Glyphicons Halflings';
            content: "\e114";
            float: right;
            transition: all 0.5s;
        }

        .panel-heading.active a:before {
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            transform: rotate(180deg);
        }
    </style>
</head>
<body>

<a class="trailer-video d-none" href="{{ $youtube_url }}?autoplay=1&mute=1"></a>

<section id="root" class="mvoie-body">
    <header class="movie-header position-relative text-white py-3">
        <h1 class="text-center m-0">{{ $movie_details->movie_title }}
            - {{ $movie_details->movie_description_short_nl }}</h1>

        @include('movie._flag')
    </header>

    <div class="menu-toggler">
        <div class="container">
            <span class="menu-toggle">&#9776;</span>
        </div>
    </div>

    <section class="movie-menu text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <a href="javascript:void(0)" class="closebtn">&times;</a>
                    <nav class="nav-menu">
                        <ul>
                            <li><a href="#" class="menu-link tablink" onclick="openPage('bp', this)" id="defaultOpen">Bioscopen</a></li>
                            <li><a href="#" class="menu-link tablink" onclick="openPage('vdo', this)">Videos</a></li>
                            <li><a href="#" class="menu-link tablink" onclick="openPage('sy', this)">Synopsis</a>
                            </li>
                            <li class="hastag">{{ $movie_details->hashtag }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>


    <div class="movie-content text-white">
        <div id="bp" class="tabcontent container-fluid">
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
                                   placeholder="Zoek.."
                                   autocomplete="off">
                            <button class="search-button" type="submit">&times;</button>
                        </form>

                        <div class="search-meta text-center my-2">
                            <p>KIES UW STAD OF LOCATIE</p>
                            <p>MEER VERTONINGEN IN DEZE STEDEN</p>

                            <div class="main-accordion accordion d-none" id="mainAccordionId"></div>
                            <div class="city-accordion accordion d-none" id="cityAccordionId"></div>

                        </div>

                        <ul class="city-map-js my-3"></ul>

                        <div class="synopsis desk-sy">
                            <h3 class="text-center mb-2 my-3">
                                {{ $movie_details->movie_description_short_nl }}
                            </h3>
                            <p>
                                {{ $movie_details->movie_description_long_nl }}
                            </p>
                        </div>

                        <p class="text-center my-3">BEKIJK DE TRAILER</p>

                        <div class="youtube-trailer">
                            <div class="iframe-container mb-2">
                                <iframe src="{{ $youtube_url }}" class="iframe-video"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 ">
                    @include('movie._map')
                </div>
            </div>
        </div>

        <div id="vdo" class="tabcontent container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="iframe-container">
                        <iframe src="{{ $youtube_url }}" class="iframe-video"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>


        <div id="sy" class="tabcontent container">
            <div class="row">
                <div class="col-md-3 mb-5 mx-auto">
                    <img class="d-block w-100" src="{{ $movie_details->image1 }}" alt="">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="synopsis">
                        <h3 class="text-center mb-2">
                            {{ $movie_details->movie_description_short_nl }}
                        </h3>
                        <p>
                            {{ $movie_details->movie_description_long_nl }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="synopsis">
                        <div class="synopsis-meta mt-2">
                            <p><span>Regisseur:</span> {{ $movie_details->director }}</p>
                            <p><span>Schrijver:</span> {{ $movie_details->writer }}</p>
                            <p><span>Producent:</span> {{ $movie_details->producer }}</p>
                            <p><span>Acteurs:</span> {{ $movie_details->actors }}</p>
                            <p><span>Speeltijd:</span> {{ $movie_details->duration }}</p>
                            <p><span>Waardering:</span> {{ $rating }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                            <li class="mr-2"><a target="_blank" href="{{ $movie_details->fb_link }}">
                                    <img src="{{ asset('images/facebook.svg') }}" alt="">
                                </a>
                            <li><a target="_blank" href="{{ $movie_details->twitter_link }}">
                                    <img src="{{ asset('images/twitter.svg') }}" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="footer-dist-logos">
                    <img src="/distributors/{{ $d_details['logo'] }}" alt="">
                    <img src="{{ asset('images/p9.png') }}" alt="">
                    <img src="/media_partners/{{ $mp_details['logo'] }}" alt="">
                </div>
            </div>
        </footer>
    </div>

</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment-with-locales.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone.min.js"></script>
<script src='//api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.js'></script>
<script src="{{ mix('js/main.js') }}"></script>
<script>
    document.querySelectorAll('.tablink').forEach(navTabLink => navTabLink.addEventListener('click', e => e.preventDefault()));

    function openPage(pageName, element) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        document.getElementById(pageName).style.display = "block";
    }

    document.getElementById("defaultOpen").click();
</script>
</body>
</html>



