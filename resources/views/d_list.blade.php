@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Distributors <a href=""
                        style="position:absolute; text-decoration: underline; right:2%;" data-toggle="modal"
                        data-target="#create_distributor_modal">Create Distributor +</a></div>
                <div class="card-body">
                    @include('alert')
                    <div class="table-responsive">
                        <table id="distributorlist" class="table-bordered" width="100%" cellspacing="0">
                            <thead style="text-align:center;">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Logo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach($d_list as $row)
                            <tbody style="text-align:center;">
                                <?php $i = 1; ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>
                                        <img src="/distributors/{{$row->logo}}" width="150px">
                                    </td>
                                    <td>
                                        <a href="/partnerlist/distributor/edit/{{$row->id}}"><button class="btn btn-primary text-white custom">Edit</button></a>
                                        <a href="/partnerlist/distributor/delete/{{$row->id}}"><button class="btn btn-danger text-white custom">Delete</button></a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create_distributor_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Distributor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/partnerlist/distributor/create" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="d_name">Name</label>
                        <input type="text" class="form-control" name="d_name" id="d_name" required>
                    </div>
                    <div class="form-group">
                        <label for="d_email">Email</label>
                        <input type="text" class="form-control" name="d_email" id="d_email" required>
                    </div>
                    <div class="form-group">
                        <input type="file" name="d_logo" required>
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