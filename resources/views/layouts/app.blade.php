<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
    <style>
    .custom {
        width: 72px !important;
    }
    #infos{
        display:none;
    }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" target="_blank">
                Admin
                </a>
                @guest
                    
                @else
                    @if(Auth::user()->is_admin == 1)
                    <a class="navbar" href="{{ url('/home') }}" @if(request()->is('home')) style="background-color: #badefb;" @endif>
                    Showtime
                    </a>
                    <a class="navbar" href="{{ url('/userlist') }}" @if(request()->is('userlist') || request()->is('userlist/*')) style="background-color: #badefb;" @endif>Users</a>
                    <a class="navbar" href="{{ url('/theaterlist') }}" @if(request()->is('theaterlist') || request()->is('theaterlist/*')) style="background-color: #badefb;" @endif>Theaters</a>
                    <a class="navbar" href="{{ url('/movielist') }}" @if(request()->is('movielist') || request()->is('movielist/*')) style="background-color: #badefb;" @endif>
                    Movies
                    </a>
                    <div class="dropdown show">
                        <a class="navbar dropdown-toggle" href="#" @if(request()->is('partnerlist') || request()->is('partnerlist/*')) style="background-color: #badefb;" @endif id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            The Partners
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/partnerlist/distributors">Distributors</a>
                            <a class="dropdown-item" href="/partnerlist/media_partners">Media Partners</a>
                        </div>
                    </div>
                    @else
                    <a class="navbar" href="{{ url('/home') }}" @if(request()->is('home')) style="background-color: #badefb;" @endif>
                    Showtime
                    </a>
                    <a class="navbar" href="{{ url('/movielist') }}" @if(request()->is('movielist') || request()->is('movielist/*')) style="background-color: #badefb;" @endif>
                    Movies
                    </a>
                    @endif
                    
            @endguest
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @guest
                        {{--<li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#info_modal" data-toggle="modal"
                                   data-target="#info_modal">Change Info
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="info_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if(Auth::user())
                    <div class="modal-body">
                        <form method="post" action="/update-info">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                       value="{{ Auth::user()->email }}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       value="{{ Auth::user()->name }}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" name="repeat_password" id="repeat_password"
                                       required>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input sp" type="checkbox" onclick="show_password()">
                                        <label class="form-check-label" for="remember">
                                            Show Password
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="form-control-user btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <main class="py-4">
        @yield('content')
    </main>
</div>
{{--<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="{{ mix('js/admin.js') }}"></script>--}}
{{--<script src="{{ mix('js/main.js') }}"></script>--}}


<script src="//code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js" defer></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

<script type="text/javascript">
    function show_password() {
        var x = document.getElementById("new_password");
        var y = document.getElementById("repeat_password");
        if (x.value == '' || y.value == '') {
            alert('Enter Password First!!');
            $('.sp').prop('checked', false);
        } else {
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
        }
    }

    $(document).ready(function () {
        $('#userlist').DataTable({
            responsive: true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        $('#movielist').DataTable({
            responsive: true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        $('#distributorlist').DataTable({
            responsive: true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        $('#media_partner_list').DataTable({
            responsive: true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        $('.select2').select2();
    });
</script>
<script type="text/javascript">
    $(document).ready(function()
    {
      $('#movie_id').change(function()
      {
        var movie_id = $('#movie_id').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('google_sheet.check')}}",
            method: "POST",
            data: {movie_id:movie_id, _token:_token},
            success: function(result)
            {
              var google_sheet = result.google_sheet;
              if(google_sheet)
              {
                document.getElementById("infos").style.display = "block";
                document.getElementById("google_sheet_ajax").href = result.google_sheet;
              }
              else
              {
                document.getElementById("infos").style.display = "none";
              }
            }
          })
      });
    });
</script>
<script>
function change_d_logo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#d_logo')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
function change_mp_logo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#mp_logo')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
