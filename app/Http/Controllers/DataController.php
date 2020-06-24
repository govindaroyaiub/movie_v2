<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Showtime;
use App\Location;

class DataController extends Controller
{

    public function index()
    {
        $title = new \Imdb\Title(2762506);
        $rating = $title->rating();

        $app_url = 'https://bacurau-defilm.nl/';
        $movie_details = Movie::where('base_url', '=', $app_url)->first();
        $current_date = date('Y-m-d');
        if ($movie_details == NULL) {
            return view('coming_soon');
        } else {
            $youtube_url_db = Movie::select('youtube_url')->where('base_url', '=', $app_url)->first();
            $youtube_link = explode("/", $youtube_url_db['youtube_url']);
            $last_youtube_part = end($youtube_link);
            array_pop($youtube_link);
            $youtube_first = implode("/", $youtube_link);
            $youtube_url = 'https://youtube.com/embed/' . $last_youtube_part;

            $poster = Movie::select('image1', 'image2', 'image3')->where('base_url', '=', $app_url)->first();
            $showtime = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
                                ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
                                ->where('movie_details.base_url', '=', $app_url)
                                ->where('movie_showtimes.date', '>=', $current_date)
                                ->orderBy('show_location_static.name', 'ASC')
                                ->orderBy('movie_showtimes.date', 'ASC')
                                ->get();

            $city = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
                            ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
                            ->select('show_location_static.city')
                            ->where('movie_details.base_url', '=', $app_url)
                            ->where('movie_showtimes.date', '>=', $current_date)
                            ->orderBy('show_location_static.city', 'ASC')
                            ->distinct()
                            ->get();

            $d_details = Movie::join('distributors', 'distributors.id', 'movie_details.d_id')
                            ->select('distributors.logo')
                            ->where('movie_details.base_url', '=', $app_url)
                            ->first();

            $mp_details = Movie::join('media_partners', 'media_partners.id', 'movie_details.d_id')
                            ->select('media_partners.logo')
                            ->where('movie_details.base_url', '=', $app_url)
                            ->first();

            return view('movie.index', compact('movie_details', 'youtube_url', 'poster', 'showtime', 'city', 'rating', 'd_details', 'mp_details'));

//            dd($movie_details);
        }
    }

    public function english_landing()
    {
        $title = new \Imdb\Title(2762506);
        $rating = $title->rating();

        $app_url = 'https://bacurau-defilm.nl/';
        $movie_details = Movie::where('base_url', '=', $app_url)->first();
        $current_date = date('Y-m-d');
        if ($movie_details == NULL) {
            return view('coming_soon');
        } else {
            $youtube_url_db = Movie::select('youtube_url')->where('base_url', '=', $app_url)->first();
            $youtube_link = explode("/", $youtube_url_db['youtube_url']);
            $last_youtube_part = end($youtube_link);
            array_pop($youtube_link);
            $youtube_first = implode("/", $youtube_link);
            $youtube_url = 'https://youtube.com/embed/' . $last_youtube_part;

            $poster = Movie::select('image1', 'image2', 'image3')->where('base_url', '=', $app_url)->first();
            $showtime = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
                                ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
                                ->where('movie_details.base_url', '=', $app_url)
                                ->where('movie_showtimes.date', '>=', $current_date)
                                ->orderBy('show_location_static.name', 'ASC')
                                ->orderBy('movie_showtimes.date', 'ASC')
                                ->get();

            $city = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
                                ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
                                ->select('show_location_static.city')
                                ->where('movie_details.base_url', '=', $app_url)
                                ->where('movie_showtimes.date', '>=', $current_date)
                                ->orderBy('show_location_static.city', 'ASC')
                                ->distinct()
                                ->get();


            $d_details = Movie::join('distributors', 'distributors.id', 'movie_details.d_id')
                                ->select('distributors.logo')
                                ->where('movie_details.base_url', '=', $app_url)
                                ->first();

            $mp_details = Movie::join('media_partners', 'media_partners.id', 'movie_details.d_id')
                                ->select('media_partners.logo')
                                ->where('movie_details.base_url', '=', $app_url)
                                ->first();

            return view('movie.index-en', compact('movie_details', 'youtube_url', 'poster', 'showtime', 'city', 'rating', 'd_details', 'mp_details'));
        }
    }

    public function showsApi()
    {
        $app_url = 'https://bacurau-defilm.nl/';
        $movie_details = Movie::where('base_url', '=', $app_url)->first();
        $current_date = date('Y-m-d');
        $showtime = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
                            ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
                            ->select(
                                'movie_details.movie_title',
                                'movie_details.ticket_url',
                                'movie_details.base_url',
                                'movie_showtimes.id',
                                'movie_showtimes.cinema_id',
                                'movie_showtimes.date',
                                'movie_showtimes.time',
                                'show_location_static.name',
                                'show_location_static.address',
                                'show_location_static.zip',
                                'show_location_static.city',
                                'show_location_static.phone',
                                'movie_showtimes.url',
                                'show_location_static.long',
                                'show_location_static.lat')
                            ->where('movie_details.base_url', '=', $app_url)
                            ->where('movie_showtimes.date', '>=', $current_date)
                            ->orderBy('show_location_static.name', 'ASC')
                            ->orderBy('movie_showtimes.date', 'ASC')
                            ->get();

        return $showtime;

    }


    public function test()
    {
        $title = new \Imdb\Title(7374926);
        $rating = $title->rating();

        $app_url = 'https://bacurau-defilm.nl/';
        $movie_details = Movie::where('base_url', '=', $app_url)->first();
        $current_date = date('Y-m-d');

        $youtube_url_db = Movie::select('youtube_url')->where('base_url', '=', $app_url)->first();
        $youtube_link = explode("/", $youtube_url_db['youtube_url']);
        $last_youtube_part = end($youtube_link);
        array_pop($youtube_link);
        $youtube_first = implode("/", $youtube_link);
        $youtube_url = 'https://youtube.com/embed/' . $last_youtube_part;

        $poster = Movie::select('image1', 'image2', 'image3')->where('base_url', '=', $app_url)->first();
        $showtime = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
            ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
            ->where('movie_details.base_url', '=', $app_url)
            ->where('movie_showtimes.date', '>=', $current_date)
            ->orderBy('show_location_static.name', 'ASC')
            ->orderBy('movie_showtimes.date', 'ASC')
            ->get();

        $city = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
            ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
            ->select('show_location_static.city')
            ->where('movie_details.base_url', '=', $app_url)
            ->where('movie_showtimes.date', '>=', $current_date)
            ->orderBy('show_location_static.city', 'ASC')
            ->distinct()
            ->get();

        return view('test', compact('movie_details', 'youtube_url', 'poster', 'showtime', 'city', 'rating'));
    }

    public function get_google_sheet(Request $request)
    {
        $movie_details = Movie::where('id', $request->movie_id)->first();
        return $movie_details;
    }

}
