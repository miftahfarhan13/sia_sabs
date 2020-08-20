@extends('layouts.app_sidebar')

@section('content')
<head>
    <title>Jadwal Mengajar Asrama</title>
    <link rel="shortcut icon" href="img/group-6.png">
    <style>
        @media screen and (max-width: 520px),
        (max-width: 768px) {
            table {
                width: 100%;
            }

            thead th.column-primary {
                width: 100%;
            }

            thead th:not(.column-primary) {
                display: none;
            }

            th[scope="row"] {
                vertical-align: top;
            }

            td {
                display: block;
                width: auto;
                text-align: right;
            }

            thead th::before {
                text-transform: uppercase;
                font-weight: bold;
                content: attr(data-header);
            }

            thead th:first-child span {
                display: none;
            }

            td::before {
                float: left;
                text-transform: uppercase;
                font-weight: bold;
                content: attr(data-header);
            }
        }

    </style>
</head>

<div>
    <h4 class="font-weight-bold"><i class="fa fa-calendar-alt mr-4"></i>Jadwal Mengajar</h4>
        <hr>
    <div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group row">
                    <label class="col-form-label font-weight-bold col-sm-2">Tahun Ajaran</label>
                    <div class="col-sm-10">
                        @foreach ($tahunajaran as $tahunajarans)
                        <label class="col-form-label">{{ $tahunajarans->tahun_ajaran }}</label>
                        @endforeach
                    </div>
                    <label class="col-sm-2 col-form-label font-weight-bold">Semester</label>
                    <div class="col-sm-10">
                        @foreach ($tahunajaran as $tahunajaran)
                        <label class="col-form-label">{{ $tahunajarans->semester }}</label>
                        @endforeach
                    </div>
                    <label class="col-sm-2 col-form-label font-weight-bold">Tanggal</label>
                    <div class="col-sm-10">                       
                        <label class="col-form-label"><?php $tgl=date('l, d-m-Y'); echo $tgl;?></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="form-row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Jadwal Mengajar Guru Asrama</div>
                    <div class="card-body">
                        <table class="table table-striped" id="data_table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Nama Kegiatan</th>
                                    <th scope="col">Nama Tempat</th>
                                    <th scope="col">Kelas</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalmengajarguru as $index => $jadwalmengajargurus)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{ $jadwalmengajargurus->tanggal }}</td>
                                    <td>{{ $jadwalmengajargurus->jam }}</td>
                                    <td>{{ $jadwalmengajargurus->nama_kegiatan }}</td>
                                    <td>{{ $jadwalmengajargurus->nama_tempat }}</td>
                                    <td>{{ $jadwalmengajargurus->nama_kelas_asrama }}</td>

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
