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
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-5 mx-auto">
                    <img class="d-block w-100" src="{{ $movie_details->image1 }}" alt="">
                </div>
            </div>
            <div class="row">
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
                            <p><span>Directed by:</span> {{ $movie_details->director }}</p>
                            <p><span>Written by:</span> {{ $movie_details->writer }}</p>
                            <p><span>Produced by:</span> {{ $movie_details->producer }}</p>
                            <p><span>Casts:</span> {{ $movie_details->actors }}</p>
                            <p><span>Duration:</span> {{ $movie_details->duration }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('movie.footer')
</section>

<script src="{{ mix('js/main.js') }}"></script>
</body>
</html>


