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

    @include('movie.footer')
</section>

<script src="{{ mix('js/main.js') }}"></script>
</body>
</html>

