@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        <button type="button" class="close" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('warning'))
<div class="alert alert-warning" role="alert">
    {{ session('warning') }}
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('success-vast-tag'))
<div class="alert alert-info" role="alert">
    VAST Tag has been accepted for: <b>{{ session('success-vast-tag') }}</b> !
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('success-create-user'))
<div class="alert alert-info" role="alert">
    Registered Successfully: <b>{{ session('success-create-user') }}. </b> <br> Deafult Password: <b>password</b>!
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('success-edit-user'))
<div class="alert alert-info" role="alert">
    User Has Been Updated: <b>{{ session('success-edit-user') }}!</b>
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('info'))
<div class="alert alert-info" role="alert">
    {{ session('info') }}
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('primary'))
<div class="alert alert-primary" role="alert">
    {{ session('primary') }}
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('secondary'))
<div class="alert alert-secondary" role="alert">
    {{ session('secondary') }}
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif