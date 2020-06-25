@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @include('alert')

                    <form method="post" action="/upload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Select movie from the drop down list</label>
                            <select class="form-control select2" id="movie_id" name="movie_id" style="width: 100%;" required>
                                <option value="">Select Movie</option>
                                @foreach($movie_list as $row)
                                <option value="{{$row->id}}">{{$row->movie_title}} ({{$row->base_url}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="infos">
                            <label>&#8226; Please use the Google Sheet from <a href="" id="google_sheet_ajax" target="_blank">here.</a></label>
                            <br>
                            <label>&#8226; Download the sheet as Xlsx format and upload.</label>
                            <br>
                            <label style="color: red; text-decoration:underline;">&#8226; Please do not delete the previous data from the sheet!!.</label>
                            <br>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="file" name="file" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary text-white">Upload file</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
