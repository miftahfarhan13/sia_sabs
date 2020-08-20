<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIA | SABS</title>
    <link rel="shortcut icon" href="img/group-6.png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        /* Utility */
        .tombol {
            background-color: #1cc88a;
            border-color: #1cc88a;
            border-radius: 40px;
            padding-left: 40px;
            padding-right: 40px;
        }

        .navbar {
            position: relative;
            z-index: 1;
        }

        .navbar-brand {
            font-size: 32px;
        }

        /* jumbotron */
        .jumbotron {
            background-image: url(img/sabs.jpeg);
            background-size: cover;
            text-align: center;
            height: 640px;
            position: relative;
        }

        .jumbotron .container {
            position: relative;
            z-index: 1;
        }


        .jumbotron .display-4 {
            color: white;
            font-weight: 500;
            font-size: 40px;
            margin-top: 150px;
        }

        .jumbotron::after {
            content: '';
            display: block;
            width: 100%;
            height: 100%;
            position: absolute;
            bottom: 0;
            background-image: linear-gradient(to top, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0));
        }

        .info-panel {
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.5);
            border-radius: 12px;
            margin-top: -100px;
            background-color: white;
            padding: 30px;
            margin-bottom: 30px;
        }

        .info-panel img {
            width: 45px;
            height: 45px;
            margin-right: 20px;
            margin-bottom: 20px;
        }

        .info-panel h4 {
            font-size: 16px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .info-panel p {
            font-size: 14px;
            color: #ACACAC;
            margin-top: -5px;
            font-weight: 200;
        }

        a {
            color: #ACACAC;
        }

        img, .navbar-brand{
            width: 130px;
            height: 70px;
        }

        img, .developer-info{
            width: 10px;
            height: 10px;
        }


        /* DESKTOP VERSION */
        @media (min-width: 992px) {

            .navbar-brand,
            .nav-link {
                color: white !important;
                text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.7);
                font-weight: 500;
            }

            .nav-link:hover::after {
                content: '';
                display: block;
                border-bottom: 3px solid #006600;
                width: 50%;
                margin: auto;
                padding-bottom: 5px;
                margin-bottom: -8px;
            }

            .jumbotron {
                margin-top: -86px;
                height: 740px;
            }

            .jumbotron .display-4 {
                font-size: 62px;
            }

        }

    </style>
</head>

<body>
    <!-- awal navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <img src="img/logo-home.png" class="navbar-brand" alt="logo">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

        </div>
    </nav>

    <!-- akhir navbar -->

    <!-- jumbtron -->
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Sistem Informasi Akademik <br> Sulthon Aulia Boarding School</h1>
            <p class="lead" style="color:white; text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.7);">Selamat Datang!</p>
            @if (Route::has('login'))
            @auth
            <a class="nav-item btn btn-success tombol" href="{{ url('/home') }}">Home <span
                    class="sr-only">(current)</span></a>
            @else
            <a class="btn btn-success tombol" href="{{ route('login') }}" style="font-weight: 1000;">Login</a>
            @endif
            @endif
        </div>
    </div>
    <!-- akhir jumbotron -->

    <!-- info panel -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 info-panel">
                <div class="row">
                    <div class="col-lg">
                        <img src="/img/communications.png" alt="communications" class="float-left">
                        <h4>Call</h4>
                        <p>(021) 8490 2927 , 082 2608 89354<br>Fax : (021) 8490 2930</p>

                    </div>
                    <div class="col-lg">
                        <img src="/img/multimedia.png" alt="multimedia" class="float-left">
                        <h4>E-mail</h4>
                        <p>humas@sulthonaulia.org</p>
                    </div>
                    <div class="col-lg">
                        <img src="/img/locations.png" alt="location" class="float-left">
                        <h4>Location</h4>
                        <p>Jl. Batu Tumbuh I, Radar Selatan, Jaticempaka,
                            Pondok Gede, Bekasi 17411</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- akhir info panel -->
    <p style="text-align: center; font-size: 12px;">Developer Info : </p>
    <p style="text-align: center; font-size: 12px;"><img src="/img/linkedin.png" alt="linkedin" class="developer-info"> <a
            href="https://www.linkedin.com/in/miftah-muhammad-farhan-026081170/">miftah muhammad farhan</a> </p>
    <p style="text-align: center; font-size: 12px;"><img src="/img/instagram.png" alt="instagram" class="developer-info" > <a
            href="https://www.instagram.com/miftahfarhan13/">miftahfarhan13</a> </p>
    <p style="text-align: center; font-size: 12px;"><img src="/img/email.png" alt="email" class="developer-info">
        <a>miftahfarhan20@gmail.com</a> </p>

    </div> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
