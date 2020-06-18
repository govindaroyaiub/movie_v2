@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User: {{ $user_details->name }}</div>

                <div class="card-body">
                    @include('alert')

                    <form method="post" action="/userlist/edit/{{$id}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $user_details->email }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user_details->name }}"
                                    required>
                            </div>
                            <div class="form-group">
                            <select class="form-control" name="role" required>
                                <option value="">Select User Role</option>
                                <option value="0" @if($user_details['is_admin'] == 0) selected @else @endif>Client</option>
                                <option value="1"  @if($user_details['is_admin'] == 1) selected @else @endif>Admin</option>
                            </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="form-control-user btn btn-primary">Update</button>
                                <a href="/userlist"><button type="button" class="btn btn-secondary">Back</button></a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
