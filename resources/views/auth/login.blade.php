<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIA | SABS - Login</title>
    <link rel="shortcut icon" href="img/group-6.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <style>
        .center-logo {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .card, .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 150px;
        }

        .logo {
            width: 150px;
            height: 40px;
        }

        .row {
            margin-right: -.75rem;
            margin-left: -.75rem
        }

        .row {
            margin-right: -.75rem;
            margin-left: -.75rem
        }

        .bg-gradient-primary {
            background-color: #31353D;
            background-size: cover
        }


    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="card center col-lg-6">
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                </div>
                <hr>
                <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input id="id_user" type="text"
                            class="form-control form-control-user @error('id_user') is-invalid @enderror" name="id_user"
                            value="{{ old('id_user') }}" required autocomplete="id_user" autofocus
                            placeholder="Masukan ID anda...">

                        @error('id_user')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password"
                            class="form-control form-control-user @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">

                            <input class="custom-control-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="custom-control-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-user btn-block">
                        {{ __('Login') }}
                    </button>
                </form>
                <hr>
                <img src="/img/logo-utama.png" class="center-logo logo" alt="logo-utama">
                <!-- <div class="text-center">
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link small" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </div> -->
            </div>
        </div>
    </div>



</body>

</html>
