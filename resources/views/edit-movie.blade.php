@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Movie: {{ $movie_details['movie_title'] }}</div>

                <div class="card-body">
                    @include('alert')

                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        The Major Details
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <form method="post" action="/movielist/edit/tmd/{{$id}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="movie_title">Title</label>
                                            <input type="text" class="form-control" name="movie_title" id="movie_title"
                                                value="{{ $movie_details['movie_title'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="director">Director</label>
                                            <input type="text" class="form-control" name="director" id="director"
                                                value="{{ $movie_details['director'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="producer">Producer</label>
                                            <input type="text" class="form-control" name="producer" id="producer"
                                                value="{{ $movie_details['producer'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="writer">Writer</label>
                                            <input type="text" class="form-control" name="writer" id="writer"
                                                value="{{ $movie_details['writer'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="actors">Actors</label>
                                            <input type="text" class="form-control" name="actors" id="actors"
                                                value="{{ $movie_details['actors'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="youtube_url">Youtube URL</label>
                                            <input type="text" class="form-control" name="youtube_url" id="youtube_url"
                                                value="{{ $movie_details['youtube_url'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="duration">Duration</label>
                                            <input type="text" class="form-control" name="duration" id="duration"
                                                value="{{ $movie_details['duration'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="base_url">Base URL</label>
                                            <input type="text" class="form-control" name="base_url" id="base_url"
                                                value="{{ $movie_details['base_url'] }}" required readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="image1">Poster URL</label>
                                            <input type="text" class="form-control" name="image1" id="image1"
                                                value="{{ $movie_details['image1'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="fb_link">Facebook Link</label>
                                            <input type="text" class="form-control" name="fb_link" id="fb_link"
                                                value="{{ $movie_details['fb_link'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="twitter_link">Twitter Link</label>
                                            <input type="text" class="form-control" name="twitter_link"
                                                id="twitter_link" value="{{ $movie_details['twitter_link'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="hashtag">Hashtag</label>
                                            <input type="text" class="form-control" name="hashtag" id="hashtag"
                                                value="{{ $movie_details['hashtag'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="fb_pixel">Facebook Pixel</label>
                                            <textarea name="fb_pixel" id="fb_pixel" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['fb_pixel'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="google_pixel">Google Pixel</label>
                                            <textarea name="google_pixel" id="google_pixel" class="form-control"
                                                rows="6" cols="50">{{ $movie_details['google_pixel'] }}</textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="form-control-user btn btn-primary">Update</button>
                                            <a href="/movielist"><button type="button"
                                                    class="btn btn-secondary">Back</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        EN Version
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <form method="post" action="/movielist/edit/en/{{$id}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="movie_description_short">Movie Description Short</label>
                                            <input type="text" class="form-control" name="movie_description_short"
                                                id="movie_description_short"
                                                value="{{ $movie_details['movie_description_short'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="movie_description_long">Movie Description Long</label>
                                            <textarea name="movie_description_long" id="movie_description_long"
                                                class="form-control" rows="6"
                                                cols="50">{{ $movie_details['movie_description_long'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="buy_tickets">Buy Tickets Text</label>
                                            <input type="text" class="form-control" name="buy_tickets" id="buy_tickets"
                                                value="{{ $movie_details['buy_tickets'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="cookies_en">Cookies</label>
                                            <textarea name="cookies_en" id="cookies_en" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['cookies'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="terms_of_use">Terms Of Use</label>
                                            <textarea name="terms_of_use" id="terms_of_use" class="form-control"
                                                rows="6" cols="50">{{ $movie_details['terms_of_use'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="privacy_policy">Privacy Policy</label>
                                            <textarea name="privacy_policy" id="privacy_policy" class="form-control"
                                                rows="6" cols="50">{{ $movie_details['privacy_policy'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="credits">Credits</label>
                                            <textarea name="credits" id="credits" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['credits'] }}</textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="form-control-user btn btn-primary">Update</button>
                                            <a href="/movielist"><button type="button"
                                                    class="btn btn-secondary">Back</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        NL Version
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <form method="post" action="/movielist/edit/nl/{{$id}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="movie_description_short_nl">Movie Description Short</label>
                                            <input type="text" class="form-control" name="movie_description_short_nl"
                                                id="movie_description_short_nl"
                                                value="{{ $movie_details['movie_description_short_nl'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="movie_description_long_nl">Movie Description Long</label>
                                            <textarea name="movie_description_long_nl" id="movie_description_long_nl"
                                                class="form-control" rows="6"
                                                cols="50">{{ $movie_details['movie_description_long_nl'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="buy_tickets_nl">Buy Tickets Text</label>
                                            <input type="text" class="form-control" name="buy_tickets_nl"
                                                id="buy_tickets_nl" value="{{ $movie_details['buy_tickets_nl'] }}"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="cookies_nl">Cookies</label>
                                            <textarea name="cookies_nl" id="cookies_nl" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['cookies_nl'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="terms_of_use_nl">Terms Of Use</label>
                                            <textarea name="terms_of_use_nl" id="terms_of_use_nl" class="form-control"
                                                rows="6" cols="50">{{ $movie_details['terms_of_use_nl'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="privacy_policy_nl">Privacy Policy</label>
                                            <textarea name="privacy_policy_nl" id="privacy_policy_nl"
                                                class="form-control" rows="6"
                                                cols="50">{{ $movie_details['privacy_policy_nl'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="credits_nl">Credits</label>
                                            <textarea name="credits_nl" id="credits_nl" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['credits_nl'] }}</textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="form-control-user btn btn-primary">Update</button>
                                            <a href="/movielist"><button type="button"
                                                    class="btn btn-secondary">Back</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
