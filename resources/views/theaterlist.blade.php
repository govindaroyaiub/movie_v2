@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Theaterlist <a href="/theaterlist/create" style="position:absolute; text-decoration: underline; right:2%;" data-toggle="modal" data-target="#create_user_modal">Create Theater +</a></div>

                <div class="card-body">
                    @include('alert')
                    <div class="table-responsive">
                        <table id="userlist" class="table-bordered" width="100%" cellspacing="0">
                            <thead style="text-align:center;">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Zip</th>
                                    <th>City</th>
                                    <th>Phone</th>
                                    <th>Long</th>
                                    <th>lat</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>

                            <tbody style="text-align:center;">
                                <?php $i = 1; ?>
                                @foreach($theaterlist as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->address}}</td>
                                    <td>{{$row->zip}}</td>
                                    <td>{{$row->city}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->long}}</td>
                                    <td>{{$row->lat}}</td>
                                    <td>
                                        <a href="/theaterlist/edit/{{$row->id}}"><button class="btn btn-primary text-white custom">Edit</button></a>
                                        {{--<a href="/theaterlist/delete/{{$row->id}}"><button class="btn btn-danger text-white custom">Delete</button></a>--}}
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
<div class="modal fade" id="create_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Theater</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/theaterlist/create">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Theater Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" required>
                            </div>
                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" name="zip" id="zip" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="long">Long</label>
                                <input type="text" class="form-control" name="long" id="long" required>
                            </div>
                            <div class="form-group">
                                <label for="long">Lat</label>
                                <input type="text" class="form-control" name="lat" id="lat" required>
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
@endsection
