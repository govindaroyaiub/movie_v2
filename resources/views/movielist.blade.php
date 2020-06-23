@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Movie List
                @if(Auth::user()->is_admin == 1)
                <a href="" style="position:absolute; text-decoration: underline; right:2%;" data-toggle="modal" data-target="#create_movie_modal">Create Movie +</a>
                @endif
                </div>
                <div class="card-body">
                    @include('alert')
                    <div class="table-responsive">
                        <table id="movielist" class="table-bordered" width="100%" cellspacing="0">
                            <thead style="text-align:center;">
                                <tr>
                                    <th>#</th>
                                    <th>Movie Title</th>
                                    <th>Base URL</th>
                                    @if(Auth::user()->is_admin == 1)
                                    <th>Uploaded By</th>
                                    @endif
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>

                            <tbody style="text-align:center;">
                                <?php $i = 1; ?>
                                @foreach($movie_list as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->movie_title}}</td>
                                    <td><a href="{{$row->base_url}}" target="_blank">{{$row->base_url}}</a></td>
                                    @if(Auth::user()->is_admin == 1)
                                    <td>{{$row->name}} (@if($row->is_admin == 1) Admin @else Client @endif)</td>
                                    @endif
                                    <td>
                                        <a href="/movielist/edit/{{$row->id}}"><button class="btn btn-primary text-white custom">Edit</button></a>
                                        <a href="/movielist/delete/{{$row->id}}"><button class="btn btn-danger text-white custom">Delete</button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->is_admin == 1)
<div class="modal fade" id="create_movie_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Movie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/movielist/create">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="movie_title">Movie Title</label>
                                <input type="text" class="form-control" name="movie_title" id="movie_title" required>
                            </div>
                            <div class="form-group">
                                <label for="base_url">Base URL</label>
                                <input type="text" class="form-control" name="base_url" id="base_url" required>
                            </div>
                            <div class="form-group">
                                <label for="google_sheet">Google Sheet URL</label>
                                <input type="text" class="form-control" name="google_sheet" id="google_sheet" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control select2" id="client_id" name="client_id" style="width: 100%;" required>
                                    <option value="">Select Client</option>
                                    @foreach($user_list as $row)
                                    <option value="{{$row->id}}">{{$row->name}} ({{$row->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="form-control-user btn btn-primary">Create</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endif
@endsection
