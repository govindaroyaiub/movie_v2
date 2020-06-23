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
                    @if(Auth::user()->is_admin == 1)
                    <div class="form-group">
                        <select class="form-control select2" id="client_id" name="client_id" required>
                            <option value="">Select Client</option>
                            @foreach($user_list as $row)
                            <option value="{{$row->id}}">{{$row->name}} ({{$row->email}})</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
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
