@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Media Partner: {{ $mp_details->name }}</div>

                <div class="card-body">
                    @include('alert')

                    <form method="post" action="/partnerlist/media_partner/edit/{{$id}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="mp_name">Name</label>
                                <input type="text" class="form-control" name="mp_name" id="mp_name" value="{{ $mp_details->name }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="mp_email">Website</label>
                                <input type="text" class="form-control" name="mp_email" id="mp_email" value="{{ $mp_details->email }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <img src="/media_partners/{{$mp_details->logo}}" id="mp_logo" style="display: block; margin: 0 auto; width: 60%;">
                                <br>
                                <input type="file" name="mp_logo" onchange="change_mp_logo(this);">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="form-control-user btn btn-primary">Update</button>
                                <a href="/partnerlist/media_partners"><button type="button" class="btn btn-secondary">Back</button></a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
