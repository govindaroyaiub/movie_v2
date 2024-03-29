<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Movie;
use App\Showtime;
use App\Location;
use App\User;
use App\Distributor;
use App\MediaPartner;
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
            $user_list = User::where('is_admin', 0)->where('is_delete', 1)->get();
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

        return view('movielist', compact('movie_list', 'user_list'));
    }

    public function movie_create(Request $request)  
    {
        $movie_title = $request->movie_title;
        $movie_details = [
            'movie_title' => $request->movie_title,
            'base_url' => $request->base_url,
            'google_sheet' => $request->google_sheet,
            'uploaded_by' => $request->client_id,
            'is_delete' => 0
        ];
        Movie::insert($movie_details);
        return back()->with('success', $movie_title.' has been created!');
    }

    public function movie_delete($id)
    {
        Movie::where('id', $id)->update(['is_delete' => '1']);
        return redirect('/movielist')->with('info', 'Movie has been deleted!');
    }

    public function movie_edit($id)
    {
        $movie_details = Movie::where('id', $id)->first();
        $d_list = Distributor::get();
        $mp_list = MediaPartner::get();
        return view('edit-movie', compact('movie_details', 'id', 'd_list', 'mp_list'));
    }

    public function tmd_edit(Request $request, $id)
    {
        $tmd_details = [
            'movie_title' => $request->movie_title,
            'director' => $request->director,
            'producer' => $request->producer,
            'writer' => $request->writer,
            'actors' => $request->actors,
            'youtube_url' => $request->youtube_url,
            'duration' => $request->duration,
            'base_url' => $request->base_url,
            'image1' => $request->image1,
            'fb_link' => $request->fb_link,
            'twitter_link' => $request->twitter_link,
            'hashtag' => $request->hashtag,
            'fb_pixel' => $request->fb_pixel,
            'google_pixel' => $request->google_pixel,
            'd_id' => $request->d_id,
            'mp_id' => $request->mp_id
        ];

        Movie::where('id', $id)->update($tmd_details);
        return redirect('/movielist/edit/'.$id)->with('info', 'The Major Details has been updated!');
    }

    public function en_edit(Request $request, $id)
    {
        $en_details = [
            'movie_description_short' => $request->movie_description_short,
            'movie_description_long' => $request->movie_description_long,
            'buy_tickets' => $request->buy_tickets,
            'cookies' => $request->cookies_en,
            'terms_of_use' => $request->terms_of_use,
            'privacy_policy' => $request->privacy_policy,
            'credits' => $request->credits
        ];

        Movie::where('id', $id)->update($en_details);
        return redirect('/movielist/edit/'.$id)->with('info', 'EN Details has been updated!');
    }

    public function nl_edit(Request $request, $id)
    {
        $nl_details = [
            'movie_description_short_nl' => $request->movie_description_short_nl,
            'movie_description_long_nl' => $request->movie_description_long_nl,
            'buy_tickets_nl' => $request->buy_tickets_nl,
            'cookies_nl' => $request->cookies_nl,
            'terms_of_use_nl' => $request->terms_of_use_nl,
            'privacy_policy_nl' => $request->privacy_policy_nl,
            'credits_nl' => $request->credits_nl
        ];

        Movie::where('id', $id)->update($nl_details);
        return redirect('/movielist/edit/'.$id)->with('info', 'NL Details has been updated!');
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

    public function theaterlist()
    {
        $theaterlist = Location::orderBy('name', 'ASC')->get();
        return view('theaterlist', compact('theaterlist'));
    }

    public function theater_create(Request $request)
    {
        // dd('Function will be available soon');

        $request->validate([
            'name' => 'unique:show_location_static',
            'phone' => 'unique:show_location_static',
            'long' => 'numeric',
            'lat' => 'numeric'
        ]);

        $name = $request->name;
        $address = $request->address;
        $zip = $request->zip;
        $city = $request->city;
        $phone = $request->phone;
        $long = $request->long;
        $lat = $request->lat;

        $theater_details = [
            'name' => $name,
            'address' => $address,
            'zip' => $zip,
            'city' => $city,
            'phone' => $phone,
            'long' => $long,
            'lat' => $lat
        ];
        Location::insert($theater_details);
        return back()->with('info', 'Theater: '. $name. ' has been created');

    }

    public function theater_delete($id)
    {
        Location::where('id', $id)->delete();
        return back()->with('info', 'Theater has been deleted!');
    }

    public function theater_edit($id)
    {
        $theater_details = Location::where('id', $id)->first();
        return view('theater-edit', compact('id', 'theater_details'));
    }

    public function theater_edit_post(Request $request, $id)
    {
        $name = $request->name;
        $theater_details = [
            'name' => $request->name,
            'address' => $request->address,
            'zip' => $request->zip,
            'city' => $request->city,
            'phone' => $request->phone,
            'long' => $request->long,
            'lat' => $request->lat
        ];
        Location::where('id', $id)->update($theater_details);
        return back()->with('info', 'Theater '.$name. ' has been updated!');
    }

    public function d_list()
    {
        $d_list = Distributor::get();
        return view('d_list', compact('d_list'));
    }

    public function d_create(Request $request)
    {
        $request->validate([
            'd_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->d_logo->extension();  
        $request->d_logo->move(public_path('distributors'), $imageName);

        $d_details = [
            'name' => $request->d_name,
            'email' => $request->d_email,
            'logo' => $imageName,
        ];
        Distributor::insert($d_details);
        return back()->with('info', 'Distributor created!');
    }

    public function d_edit(Request $request, $id)
    {
        $d_details = Distributor::where('id', $id)->first();
        return view('d_edit', compact('d_details', 'id'));
    }

    public function d_edit_post(Request $request, $id)
    {
        $request->validate([
            'd_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $d_details = Distributor::where('id', $id)->first();

        if($request->has('d_logo'))
        {
            unlink(public_path('distributors/'.$d_details['logo']));

            $imageName = time().'.'.$request->d_logo->extension();  
            $request->d_logo->move(public_path('distributors'), $imageName);
        }
        else
        {
            $imageName = $d_details['logo'];
        }

        $d_details = [
            'name' => $request->d_name,
            'email' => $request->d_email,
            'logo' => $imageName,
        ];
        Distributor::where('id', $id)->update($d_details);
        return back()->with('info', 'Distributor updated!');
    }

    public function d_delete(Request $request, $id)
    {
        Distributor::where('id', $id)->delete();
        return back()->with('info', 'Distributor is deleted');
    }
    
    public function mp_list()
    {
        $mp_list = MediaPartner::get();
        return view('mp_list', compact('mp_list'));
    }

    public function mp_create(Request $request)
    {
        $request->validate([
            'mp_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->mp_logo->extension();  
        $request->mp_logo->move(public_path('media_partners'), $imageName);

        $mp_details = [
            'name' => $request->mp_name,
            'email' => $request->mp_email,
            'logo' => $imageName,
        ];
        MediaPartner::insert($mp_details);
        return back()->with('info', 'Media Partner created!');
    }

    public function mp_edit(Request $request, $id)
    {
        $mp_details = MediaPartner::where('id', $id)->first();
        return view('mp_edit', compact('mp_details', 'id'));
    }

    public function mp_edit_post(Request $request, $id)
    {
        $request->validate([
            'mp_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $mp_details = MediaPartner::where('id', $id)->first();

        if($request->has('mp_logo'))
        {
            unlink(public_path('media_partners/'.$mp_details['logo']));

            $imageName = time().'.'.$request->mp_logo->extension();  
            $request->mp_logo->move(public_path('media_partners'), $imageName);
        }
        else
        {
            $imageName = $mp_details['logo'];
        }

        $mp_details = [
            'name' => $request->mp_name,
            'email' => $request->mp_email,
            'logo' => $imageName,
        ];
        MediaPartner::where('id', $id)->update($mp_details);
        return back()->with('info', 'Media Partner updated!');
    }

    public function mp_delete(Request $request, $id)
    {
        MediaPartner::where('id', $id)->delete();
        return back()->with('info', 'Media Partner is deleted');
    }


}
