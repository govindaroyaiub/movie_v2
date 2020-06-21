<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Movie;
use App\Showtime;
use App\Location;
use App\User;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function userlist()
    {
        $userlist = User::where('is_delete', 1)->orderBy('name')->get();
        return view('userlist', compact('userlist'));
    }

    public function create_user(Request $request)
    {
        $request->validate([
            'email' => 'unique:users',
        ]);

        $name = $request->name;
        $email = $request->email;
        $default_password = 'password';
        $user_role = $request->role;

        $params = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($default_password),
            'is_admin' => $user_role,
            'is_delete' => '1'
        ];
        User::insert($params);
        return back()->with('success-create-user', $name);
    }

    public function edit_user($id)
    {
        $user_details = User::find($id);
    
        return view('edit-user', compact('user_details', 'id'));
    }

    public function edit_user_post(Request $request, $id)
    {
        $name = $request->name;
        $email = $request->email;
        $role = $request->role;

        $params = [
            'name' => $name,
            'email' => $email,
            'is_admin' => $role
        ];
        User::where('id', $id)->update($params);
        return back()->with('info', $name.' has been updated!');
    }

    public function delete_user($id)
    {
        User::where('id', $id)->update(['is_delete' => 0]);
        return redirect('/userlist')->with('info', 'User has been deleted!');
    }

    public function movielist()
    {
        if(Auth::user()->is_admin == 0)
        {
            $movie_list = Movie::join('users', 'users.id', 'movie_details.uploaded_by')
                                ->select(
                                    'movie_details.id',
                                    'users.name',
                                    'users.is_admin',
                                    'movie_details.movie_title',
                                    'movie_details.base_url'
                                )
                                ->where('movie_details.is_delete', '0')
                                ->where('movie_details.uploaded_by', Auth::user()->id)
                                ->get();
        }
        else
        {
            $movie_list = Movie::join('users', 'users.id', 'movie_details.uploaded_by')
                                ->select(
                                    'movie_details.id',
                                    'users.name',
                                    'users.is_admin',
                                    'movie_details.movie_title',
                                    'movie_details.base_url'
                                )
                                ->where('movie_details.is_delete', '0')
                                ->get();

        }

        return view('movielist', compact('movie_list'));
    }

    public function movie_delete($id)
    {
        Movie::where('id', $id)->update(['is_delete' => '1']);
        return redirect('/movielist')->with('info', 'Movie has been deleted!');
    }

    public function movie_edit($id)
    {
        $movie_details = Movie::where('id', $id)->first();
        return view('edit-movie', compact('movie_details', 'id'));
    }
    
    public function movie_edit_post(Request $request, $id)
    {
        $movie_details = [
            'movie_title' => $movie_title,
            'movie_description_short' => $movie_description_short,
            'movie_description_long' => $movie_description_long,
            'buy_tickets' => $buy_tickets_text,
            'movie_description_short_nl' => $movie_description_short_nl,
            'movie_description_long_nl' => $movie_description_long_nl,
            'buy_tickets_nl' => $buy_tickets_text_nl,
            'cinema_date' => $cinema_date,
            'director' => $director,
            'producer' => $producer,
            'writer' => $writer,
            'actors' => $actors,
            'youtube_url' => $youtube_url,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'duration' => $duration,
            'ratings' => $rating,
            'base_url' => $get_base_url,
            'ticket_url' => $get_ticket_url,
            'fb_link' => $fb_link,
            'twitter_link' => $twitter_link,
            'hashtag' => $hashtag,
            'cookies' => $cookies,
            'cookies_nl' => $cookies_nl,
            'terms_of_use' => $terms_of_use,
            'terms_of_use_nl' => $terms_of_use_nl,
            'privacy_policy' => $privacy_policy,
            'privacy_policy_nl' => $privacy_policy_nl,
            'credits' => $credits,
            'credits_nl' => $credits_nl,
            'fb_pixel' => $fb_pixel,
            'google_pixel' => $google_pixel,
            'is_delete' => '0',
            'uploaded_by' => $user_id
        ];
    }
}
