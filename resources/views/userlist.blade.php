@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Userlist <a href="/userlist/create" style="position:absolute; text-decoration: underline; right:2%;" data-toggle="modal" data-target="#create_user_modal">Create User +</a></div>

                <div class="card-body">
                    @include('alert')
                    <div class="table-responsive">
                        <table id="userlist" class="table-bordered" width="100%" cellspacing="0">
                            <thead style="text-align:center;">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>

                            <tbody style="text-align:center;">
                                <?php $i = 1; ?>
                                @foreach($userlist as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>@if($row->is_admin == 1) Admin @else Client @endif</td>
                                    <td>
                                        <a href="/userlist/edit/{{$row->id}}"><button class="btn btn-primary text-white custom">Edit</button></a>
                                        <a href="/userlist/delete/{{$row->id}}"><button class="btn btn-danger text-white custom">Delete</button></a>
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
                        <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/userlist/create">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                            <select class="form-control" name="role" required>
                                <option value="">Select User Role</option>
                                <option value="0">Client</option>
                                <option value="1">Admin</option>
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
@endsection
