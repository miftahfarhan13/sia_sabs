@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Home</title>
    <link rel="shortcut icon" href="img/group-6.png">

    <style>
        .card-body-icon {
            position: absolute;
            z-index: 0;
            top: 25px;
            right: 4px;
            opacity: 0.4;
            font-size: 90px;
        }

    </style>
</head>

<body>
    <div>
        <h3 class="font-weight-bold"><i class="fa fa-tachometer-alt mr-4"></i>Dashboard</h3>
        <hr>
        <h4 class="font-weight-bold">Selamat Datang!</h4>
        <div style="max-width: 400px;">
            <div class="alert alert-primary" role="alert">
                <label class="font-weight-bold" style="font-size: 20px;">{{Auth::user()->name}}</label>
                <br>
                <p class="font-weight-bold" style="color: green; font-size:20px;">{{Auth::user()->id_user}}</p>
                <hr>

                @if(Auth::user()->role == 'Siswa')
                <div class="row">
                    <p class="ml-3">Anda sebagai : </p>&ensp;
                    <p class="font-weight-bold">{{Auth::user()->role}}</p>
                </div>

                <div class="row">
                    <p class="ml-3">Kelas Sekolah : </p>&ensp;
                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->nama_kelas }}</p>
                    @endforeach
                </div>

                <div class="row">
                    <p class="ml-3">Kelas Asrama : </p>&ensp;
                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->nama_sub_kelas }}</p>
                    @endforeach

                </div>

                <div class="row">
                    <p class="ml-3">Gedung : </p>&ensp;

                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->nama_gedung }}</p>
                    @endforeach

                </div>

                <div class="row">
                    <p class="ml-3">Jenis Kelamin : </p>&ensp;

                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->jenis_kelamin }}</p>
                    @endforeach

                </div>

                <div class="row">
                    <p class="ml-3">Tanggal Lahir :</p>&ensp;

                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->tanggal_lahir }}</p>
                    @endforeach

                </div>
                @endif

                @if(Auth::user()->role == 'Orang Tua')
                <div class="row">
                    <p class="ml-3">Anda sebagai : </p>&ensp;

                    <p class="font-weight-bold">{{Auth::user()->role}}</p>

                </div>

                <p>Data Anak Anda</p>

                <div class="row">
                    <p class="ml-3">Nama Anak : </p>&ensp;

                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->nama_siswa }}</p>
                    @endforeach

                </div>

                <div class="row">
                    <p class="ml-3">Kelas Sekolah : </p>&ensp;
                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->nama_kelas }}</p>
                    @endforeach
                </div>

                <div class="row">
                    <p class="ml-3">Kelas Asrama : </p>&ensp;
                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->nama_sub_kelas }}</p>
                    @endforeach

                </div>

                <div class="row">
                    <p class="ml-3">Gedung : </p>&ensp;

                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->nama_gedung }}</p>
                    @endforeach

                </div>

                <div class="row">
                    <p class="ml-3">Jenis Kelamin : </p>&ensp;

                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->jenis_kelamin }}</p>
                    @endforeach

                </div>

                <div class="row">
                    <p class="ml-3">Tanggal Lahir :</p>&ensp;

                    @foreach ($siswa as $siswas)
                    <p class="font-weight-bold">{{ $siswas->tanggal_lahir }}</p>
                    @endforeach

                </div>
                @endif


                @if(Auth::user()->role == 'Guru Sekolah')
                <div class="row">
                    <p class="ml-3">Anda sebagai : </p>&ensp;
                    <p class="font-weight-bold">{{Auth::user()->role}}</p>

                </div>
                
                <div class="row">
                    <p class="ml-3">Mata Pelajaran : </p>&ensp;
                    
                        @foreach ($gurusekolah as $gurusekolahs)
                        <p class="font-weight-bold">{{ $gurusekolahs->nama_mata_pelajaran }}</p>
                        @endforeach
                    
                </div>

                <div class="row">
                    <p class="ml-3">Jenis Kelamin : </p>&ensp;
                    
                        @foreach ($gurusekolah as $gurusekolahs)
                        <p class="font-weight-bold">{{ $gurusekolahs->jenis_kelamin }}</p>
                        @endforeach
                    
                </div>

                <div class="row">
                    <p class="ml-3">Tanggal Lahir : </p>&ensp;
                    
                        @foreach ($gurusekolah as $gurusekolahs)
                        <p class="font-weight-bold">{{ $gurusekolahs->tanggal_lahir }}</p>
                        @endforeach
                    
                </div>
                @endif

                @if(Auth::user()->role == 'Guru Asrama')
                <div class="row">
                    <p class="ml-3">Anda sebagai : </p>&ensp;
                    <p class="font-weight-bold">{{Auth::user()->role}}</p>

                </div>
                
                <div class="row">
                    <p class="ml-3">Gedung : </p>&ensp;
                    
                        @foreach ($guruasrama as $guruasramas)
                        <p class="font-weight-bold">{{ $guruasramas->nama_gedung }}</p>
                        @endforeach
                    
                </div>

                <div class="row">
                    <p class="ml-3">Jenis Kelamin : </p>&ensp;
                    
                        @foreach ($guruasrama as $guruasramas)
                        <p class="font-weight-bold">{{ $guruasramas->jenis_kelamin }}</p>
                        @endforeach
                    
                </div>

                <div class="row">
                    <p class="ml-3">Tanggal Lahir : </p>&ensp;
                    
                        @foreach ($guruasrama as $guruasramas)
                        <p class="font-weight-bold">{{ $guruasramas->tanggal_lahir }}</p>
                        @endforeach
                    
                </div>
                @endif

            </div>
        </div>
        @if(Auth::user()->role == 'Admin')
        <div>
            <div class="row">
                <label class="col-sm-2">Info Saat Ini :</label>
            </div>

            <div class="row text-white">
                <div class="card bg-info ml-3 mt-2 " style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-user mr-2"></i>
                        </div>
                        <h5 class="card-title">Jumlah Siswa</h5>
                        <div class="display-4">{{ $siswacount }}</div>

                    </div>
                </div>

                <div class="card bg-success ml-3 mt-2 " style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-user mr-2"></i>
                        </div>
                        <h5 class="card-title">Jumlah Guru Sekolah</h5>
                        <div class="display-4">{{ $gurusekolahcount }}</div>

                    </div>
                </div>

                <div class="card bg-danger ml-3 mt-2" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-user mr-2"></i>
                        </div>
                        <h5 class="card-title">Jumlah Guru Asrama</h5>
                        <div class="display-4">{{ $guruasramacount }}</div>

                    </div>
                </div>
            </div>
        </div>

        @endif


    </div>


</body>



@endsection
