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
                    {{ $movie_details->cookies }}
                </p>
            </div>
            <div id="Gebruiksvoorwaarden" class="container tab-pane fade">
                <p>
                    {{ $movie_details->terms_of_use }}
                </p>
            </div>
            <div id="privacy-policy" class="container tab-pane fade">
                <p>
                    {{ $movie_details->privacy_policy }}
                </p>
            </div>
            <div id="credits" class="container tab-pane fade">
                <p>
                    {{ $movie_details->credits }}
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <ul class="footer-social">
                    <li><a target="_blank" href="{{ $movie_details->fb_link }}"><i class="fab fa-facebook-square"></i></a></li>
                    <li><a target="_blank" href="{{ $movie_details->twitter_link }}"><i class="fab fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
