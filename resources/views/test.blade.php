<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $movie_details->movie_title }}</title>
    <link rel='stylesheet' href='//api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.css'/>
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
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
            <div class="row">
                <div class="col-xl-4 col-lg-6 d-none d-lg-block">
                    <div class="poster">
                        <img
                            class=""
                            {{--                            src="{{ $movie_details->image1 }}"--}}
                            alt="">
                    </div>


                    <div class="accordion" id="oreAccordion">
                        <div class="single">
                            <div class="" id="headingOne">
                                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Item #1
                                </button>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#oreAccordion">
                                <div class="card-body">
                                    <h1>01</h1> Anim pariatur cliche reprehenderit,
                                </div>
                            </div>
                        </div>
                        <div class="single">
                            <div class="" id="headingTwo">
                                <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Item #2
                                </button>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#oreAccordion">
                                <h1>02</h1> Anim pariatur cliche reprehenderit.
                            </div>
                        </div>
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

                            <p>bekijk de trailer</p>
                        </div>

                        <div class="youtube-trailer">
                            <iframe class="yt-iframe" src="{{ $youtube_url }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 ">
                    <div class="map-wrapper">
                        <div id='map' class='map'></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('movie.footer')

</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment-with-locales.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone.min.js"></script>
<script src='//api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.js'></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="{{ mix('js/main.js') }}"></script>
</body>
</html>

