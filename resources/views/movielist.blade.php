@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Movie List</div>

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
                                    <a href="/movielist/edit/{{$row->id}}" target="_blank"><button class="btn btn-primary text-white custom">Edit</button></a>
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
@endsection
