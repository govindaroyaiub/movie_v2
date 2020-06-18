<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>

<body>
    <section class="welcome-page">
        <header class="header">
            <h1>{{ $movie_details['movie_title'] }}</h1>
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="poster mt-2">
                        <img class="img-fluid w-100" src="{{ $poster->image1 }}" alt="">
                    </div>
                </div>
                <div class="col-md-4 text-center text-uppercase">
                    <div class="showtimes">
                        <h5 class="mb-3">Showtime coming here soon</h5>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni fugiat aliquid soluta nemo a,
                            eum hic quos! Quaerat iusto numquam soluta facilis architecto
                        </p>
                        <p>Repellendus neque quae iure sed sequi eos.</p>
                        <iframe class="w-100" height="200" src="{{ $youtube_url }}" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="accordion mt-2" id="accordionExample">
                        <div id="movieShowtime">
                            <button class="showtime-btn" type="button" data-toggle="collapse"
                                data-target="#collapseShowtime" aria-expanded="true" aria-controls="collapseShowtime">
                                Movie showtime
                            </button>
                        </div>

                        <div id="collapseShowtime" class="collapse show" aria-labelledby="movieShowtime"
                            data-parent="#accordionExample">
                            <div class="showtime-content">
                                <ul>
                                    @foreach($showtime as $row)
                                        <li>
                                            {{ $row->name }}
                                            <span>{{ $row->address }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Movie Platform &copy; <?= Date('Y') ?>. All Right Reserved.</p>
                    <p>crafted with love by <a href="https://divaww.com">Diva Worldwide</a></p>
                </div>
            </div>
        </div>
    </footer>


    <script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>
