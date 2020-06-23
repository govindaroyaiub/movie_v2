@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Theater: {{ $theater_details->name }}</div>

                <div class="card-body">
                    @include('alert')

                    <form method="post" action="/theaterlist/edit/{{$id}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $theater_details->name }}" required>
                            </div>
                            <div class="col">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    value="{{ $theater_details->address }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" name="zip" id="zip"
                                    value="{{ $theater_details->zip }}" required>
                            </div>
                            <div class="col">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city"
                                    value="{{ $theater_details->city }}" required>
                            </div>
                            <div class="col">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    value="{{ $theater_details->phone }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="long">Long</label>
                                <input type="text" class="form-control" name="long" id="long"
                                    value="{{ $theater_details->long }}" required>
                            </div>
                            <div class="col">
                                <label for="lat">Lat</label>
                                <input type="text" class="form-control" name="lat" id="lat"
                                    value="{{ $theater_details->lat }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="form-control-user btn btn-primary">Update</button>
                            <a href="/theaterlist"><button type="button" class="btn btn-secondary">Back</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
