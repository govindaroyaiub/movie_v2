@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Media Partners <a href=""
                        style="position:absolute; text-decoration: underline; right:2%;" data-toggle="modal"
                        data-target="#create_media_partner_modal">Create Media Partner +</a></div>
                <div class="card-body">
                    @include('alert')
                    <div class="table-responsive">
                        <table id="media_partner_list" class="table-bordered" width="100%" cellspacing="0">
                            <thead style="text-align:center;">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Website</th>
                                    <th>Logo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">
                                <?php $i = 1; ?>
                                @foreach($mp_list as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->name}}</td>
                                    <td><a href="{{$row->email}}" target="_blank">{{$row->email}}</a></td>
                                    <td>
                                        <img src="/media_partners/{{$row->logo}}" width="150px">
                                    </td>
                                    <td>
                                        <a href="/partnerlist/media_partner/edit/{{$row->id}}"><button class="btn btn-primary text-white custom">Edit</button></a>
                                        <a href="/partnerlist/media_partner/delete/{{$row->id}}"><button class="btn btn-danger text-white custom">Delete</button></a>
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
<div class="modal fade" id="create_media_partner_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Media Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/partnerlist/media_partner/create" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="mp_name">Name</label>
                        <input type="text" class="form-control" name="mp_name" id="mp_name" required>
                    </div>
                    <div class="form-group">
                        <label for="mp_email">Email</label>
                        <input type="text" class="form-control" name="mp_email" id="mp_email" required>
                    </div>
                    <div class="form-group">
                        <input type="file" name="mp_logo" required>
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
