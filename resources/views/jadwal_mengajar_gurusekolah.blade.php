@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Jadwal Mengajar</title>
    <link rel="shortcut icon" href="img/group-6.png">
</head>

<div>
    <h4 class="font-weight-bold"><i class="fa fa-calendar-alt mr-4"></i>Jadwal Mengajar</h4>
    <hr>

    <div class="col-md-9 pl-0">
        <div>
            <div class="row">
                <label class="col-form-label font-weight-bold col-sm-2">Tahun Ajaran</label>
                <div class="col-sm-10">
                    @foreach ($tahunajaran as $tahunajarans)
                    <label class="col-form-label">{{ $tahunajarans->tahun_ajaran }}</label>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label font-weight-bold">Semester</label>
                <div class="col-sm-10">
                    @foreach ($tahunajaran as $tahunajaran)
                    <label class="col-form-label">{{ $tahunajarans->semester }}</label>
                    @endforeach
                </div>

            </div>

        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="card">
                <div class="card-header">Jadwal Mengajar Guru Sekolah</div>
                <div class="card-body">
                    <table class="table table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Jam</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalmengajarguru as $index => $jadwalmengajargurus)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{ $jadwalmengajargurus->nama_kelas }}</td>
                                <td>{{ $jadwalmengajargurus->hari }}</td>
                                <td>{{ $jadwalmengajargurus->jam }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>


    </div>

</div>

@endsection
