<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Movie;
use App\Showtime;
use App\Location;
use App\User;
use Auth;

class HomeController extends Controller
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
    public function index()
    {
        $user_list = User::where('is_admin', 0)->get();
        return view('home', compact('user_list'));
    }

    public function upload(Request $request)
    {
        
        //validate the xls file
        $this->validate($request, array(
        'file'      => 'required'
        ));
        if($request->client_id != NULL)
        {
            $user_id = $request->client_id;
        }
        else
        {
            $user_id = Auth::user()->id;
        }
    
        if($request->hasFile('file'))
        {
            $check_location_data = Location::first();
            $check_showtime_data = Showtime::first();
            $check_movie_details = Movie::first();

            $file = $request->file('file')->getClientOriginalName(); 
            $request->file->move(public_path('/'), $file);

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(TRUE);
            $spreadsheet = $reader->load($file);

            $worksheet1 = $spreadsheet->getSheet(0);
            $worksheet2 = $spreadsheet->getSheet(1);
            $worksheet3 = $spreadsheet->getSheet(2);

            $location_list = [];
            $showtime_list = [];
            $full_movie_details = [];

            $title = new \Imdb\Title(7374926);
            $rating = $title->rating();

            $app_url = 'https://movie.planetnine.com/';
            $movie_details = Movie::where('base_url', '=', $app_url)->first();

            if($worksheet3)
            {
                $highestRow = $worksheet3->getHighestDataRow(); 
                $highestColumn = $worksheet3->getHighestDataColumn();
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); 
                for ($row = 2; $row <= $highestRow; ++$row) {
                    $movie_title = $worksheet3->getCellByColumnAndRow(2, $row)->getValue();
                    $movie_description_short = $worksheet3->getCellByColumnAndRow(3, $row)->getValue();
                    $movie_description_long = $worksheet3->getCellByColumnAndRow(4, $row)->getValue();
                    $buy_tickets_text = $worksheet3->getCellByColumnAndRow(5, $row)->getValue();
                    $movie_description_short_nl = $worksheet3->getCellByColumnAndRow(6, $row)->getValue();
                    $movie_description_long_nl = $worksheet3->getCellByColumnAndRow(7, $row)->getValue();
                    $buy_tickets_text_nl = $worksheet3->getCellByColumnAndRow(8, $row)->getValue();
                    $cinema_date_sheet = $worksheet3->getCellByColumnAndRow(9, $row)->getValue();
                    $director = $worksheet3->getCellByColumnAndRow(10, $row)->getValue();
                    $producer = $worksheet3->getCellByColumnAndRow(11, $row)->getValue();
                    $writer = $worksheet3->getCellByColumnAndRow(12, $row)->getValue();
                    $actors = $worksheet3->getCellByColumnAndRow(13, $row)->getValue();
                    $youtube_url = $worksheet3->getCellByColumnAndRow(14, $row)->getValue();
                    $image1 = $worksheet3->getCellByColumnAndRow(15, $row)->getValue();
                    $image2 = $worksheet3->getCellByColumnAndRow(16, $row)->getValue();
                    $image3 = $worksheet3->getCellByColumnAndRow(17, $row)->getValue();
                    $duration = $worksheet3->getCellByColumnAndRow(18, $row)->getValue();
                    // $rating = $worksheet3->getCellByColumnAndRow(19, $row)->getValue();
                    $get_base_url = $worksheet3->getCellByColumnAndRow(20, $row)->getValue();
                    $get_ticket_url = $worksheet3->getCellByColumnAndRow(21, $row)->getValue();
                    $fb_link = $worksheet3->getCellByColumnAndRow(22, $row)->getValue();
                    $twitter_link = $worksheet3->getCellByColumnAndRow(23, $row)->getValue();
                    $hashtag = $worksheet3->getCellByColumnAndRow(24, $row)->getValue();
                    $cookies = $worksheet3->getCellByColumnAndRow(25, $row)->getValue();
                    $cookies_nl = $worksheet3->getCellByColumnAndRow(26, $row)->getValue();
                    $terms_of_use = $worksheet3->getCellByColumnAndRow(27, $row)->getValue();
                    $terms_of_use_nl = $worksheet3->getCellByColumnAndRow(28, $row)->getValue();
                    $privacy_policy = $worksheet3->getCellByColumnAndRow(29, $row)->getValue();
                    $privacy_policy_nl = $worksheet3->getCellByColumnAndRow(30, $row)->getValue();
                    $credits = $worksheet3->getCellByColumnAndRow(31, $row)->getValue();
                    $credits_nl = $worksheet3->getCellByColumnAndRow(32, $row)->getValue();
                    $fb_pixel = $worksheet3->getCellByColumnAndRow(33, $row)->getValue();
                    $google_pixel = $worksheet3->getCellByColumnAndRow(34, $row)->getValue();
                    $cinema_date = date('Y-m-d',\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($cinema_date_sheet));
                    
                    if($movie_title != NULL)
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
                        array_push($full_movie_details, $movie_details);
                    }
                }
                //if there is no data 
                if($check_movie_details == NULL)
                {
                    Movie::insert($full_movie_details);
                }
                else
                {
                    //match with uploaded data and existing data where base_url = app_url
                    $existing_movie_details = Movie::select(
                                                'movie_title',
                                                'movie_description_short',
                                                'movie_description_long',
                                                'buy_tickets',
                                                'movie_description_short_nl',
                                                'movie_description_long_nl',
                                                'buy_tickets_nl',
                                                'cinema_date',
                                                'director',
                                                'producer',
                                                'writer',
                                                'actors',
                                                'youtube_url',
                                                'image1',
                                                'image2',
                                                'image3',
                                                'duration',
                                                'ratings',
                                                'base_url',
                                                'ticket_url',
                                                'fb_link',
                                                'twitter_link',
                                                'hashtag',
                                                'cookies',
                                                'cookies_nl',
                                                'terms_of_use',
                                                'terms_of_use_nl',
                                                'privacy_policy',
                                                'privacy_policy_nl',
                                                'credits',
                                                'credits_nl',
                                                'fb_pixel',
                                                'google_pixel',
                                                'uploaded_by')
                                                ->where('base_url', '=', $app_url)
                                                ->first()
                                                ->toArray();
                    
                    $check_movie_result = array_diff($existing_movie_details, $full_movie_details[0]);
                    
                    if($check_movie_result != NULL)
                    {
                        Movie::where('base_url', '=', $app_url)->update($full_movie_details[0]);
                    }
                }
            }

            if($worksheet2)
            {   
                $movie_details = Movie::where('base_url', '=', $app_url)->first();
                $highestRow = $worksheet2->getHighestDataRow(); 
                $highestColumn = $worksheet2->getHighestDataColumn(); 
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

                for ($row = 2; $row <= $highestRow; ++$row) {
                    $cinema_id = $worksheet2->getCellByColumnAndRow(2, $row)->getValue();
                    $date_sheet = $worksheet2->getCellByColumnAndRow(3, $row)->getValue();
                    $time_sheet = $worksheet2->getCellByColumnAndRow(4, $row)->getValue();
                    $movie_id = $movie_details['id'];
                    $date = date('Y-m-d',\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($date_sheet));
                    $time = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($time_sheet)->format('H:i');
                    
                    if($cinema_id != NULL)
                    {
                        $showtime = [
                            'cinema_id' => $cinema_id,
                            'date' => $date,
                            'time' => $time,
                            'movie_id' => $movie_id
                        ];
                        array_push($showtime_list, $showtime);
                    }
                }
                if($check_showtime_data == NULL)
                {
                    Showtime::insert($showtime_list);
                }
                else
                {
                    //if data exists on the table, check for other data which is not matched with the current one. First save them and insert all together
                    Showtime::where('movie_id', $movie_details['id'])->delete();
                    $other_showtime_data = Showtime::select('cinema_id', 'date', 'time', 'movie_id')->get()->toArray();
                    if($other_showtime_data != NULL)
                    {
                        Showtime::truncate();
                        Showtime::insert($showtime_list);
                        Showtime::insert($other_showtime_data);
                    }
                    else
                    {
                        Showtime::truncate();
                        Showtime::insert($showtime_list);
                    }
                }
            }

            if($worksheet1)
            {
                $highestRow = $worksheet1->getHighestDataRow(); 
                $highestColumn = $worksheet1->getHighestDataColumn(); 
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                for ($row = 2; $row <= $highestRow; ++$row) {
                    $name = $worksheet1->getCellByColumnAndRow(2, $row)->getValue();
                    $address = $worksheet1->getCellByColumnAndRow(3, $row)->getValue();
                    $zip = $worksheet1->getCellByColumnAndRow(4, $row)->getValue();
                    $city = $worksheet1->getCellByColumnAndRow(5, $row)->getValue();
                    $phone = $worksheet1->getCellByColumnAndRow(6, $row)->getValue();
                    $url = $worksheet1->getCellByColumnAndRow(7, $row)->getValue();
                    $lat = $worksheet1->getCellByColumnAndRow(9, $row)->getValue();
                    $long = $worksheet1->getCellByColumnAndRow(10, $row)->getValue();
                    
                    if($name != NULL)
                    {
                        $location = [
                            'name' => $name,
                            'address' => $address,
                            'zip' => $zip,
                            'city' => $city,
                            'phone' => $phone,
                            'url' => $url,
                            'long' => $long,
                            'lat' => $lat
                        ];
                        array_push($location_list, $location);
                    }
                }
                if($check_location_data == NULL)
                {
                    Location::insert($location_list);
                }
                else
                {
                    Location::truncate();
                    Location::insert($location_list);
                }
            }
            return back()->with('success', 'File Uploaded!');
        }
    }

    public function update_info(Request $request)
    {
        $username = $request->name;
        $email = $request->email;
        $new_password = $request->new_password;
        $repeat_password = $request->repeat_password;
        $user_info = User::where('id', Auth::user()->id)->first();
        $old_password =$user_info['password'];

        if($new_password != $repeat_password)
        {
            return back()->with('error', 'Sorry Password Did Not Match!');
        }
        else
        {
            User::where('id', Auth::user()->id)->update(['password' => bcrypt($new_password), 'name' => $username, 'email' => $email]);
            Auth::logout();
            return redirect('/login')->with('success', 'Credentials Updated. Please Login Again');
        }
    }
}
