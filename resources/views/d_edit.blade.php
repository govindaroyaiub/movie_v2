@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Distributor: {{ $d_details->name }}</div>

                <div class="card-body">
                    @include('alert')

                    <form method="post" action="/partnerlist/distributor/edit/{{$id}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="d_name">Name</label>
                                <input type="text" class="form-control" name="d_name" id="d_name" value="{{ $d_details->name }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="d_email">Website</label>
                                <input type="text" class="form-control" name="d_email" id="d_email" value="{{ $d_details->email }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <img src="/distributors/{{$d_details->logo}}" id="d_logo" style="display: block; margin: 0 auto; width: 60%;">
                                <br>
                                <input type="file" name="d_logo" onchange="change_d_logo(this);">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="form-control-user btn btn-primary">Update</button>
                                <a href="/partnerlist/distributors"><button type="button" class="btn btn-secondary">Back</button></a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
