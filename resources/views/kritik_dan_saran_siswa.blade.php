@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Kritik dan Saran</title>
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
    <h4 class="font-weight-bold"><i class="fa fa-list mr-4"></i>Kritik dan Saran</h4>
    <hr>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
    @endif

    <div class="col-md-9 pl-0">
        <div>

            <div class="form-group row">

                <label class="col-form-label font-weight-bold col-sm-2">Tahun Ajaran</label>
                <div class="col-sm-10">
                    @foreach ($tahunajaran as $tahunajarans)
                    <label class="col-form-label">{{ $tahunajarans->tahun_ajaran }}</label>
                    @endforeach
                </div>
                <label class="col-sm-2 col-form-label font-weight-bold">Semester</label>
                <div class="col-sm-10">
                    @foreach ($tahunajaran as $tahunajarans)
                    <label class="col-form-label">{{ $tahunajarans->semester }}</label>
                    @endforeach
                </div>

            </div>

        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="card">
                <div class="card-header">Kritik dan Saran Guru Sekolah</div>
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        Anda akan memberikan kritik dan saran kepada guru sekolah!
                        <br>Silahkan sampaikan kritik dan saran dengan baik dan sopan agar guru dapat mengevaluasi diri!
                    </div>
                    <table class="table" id="data_table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Guru</th>
                                <th scope="col">Kritik dan Saran</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gurusekolah as $index => $gurusekolahs)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{ $gurusekolahs->nama_guru_sekolah }}</td>
                                <td class="updaterow"><textarea class="form-control rounded-0" id="kritik_gurusekolah"
                                        name="kritik_gurusekolah" placeholder="Berikan Kritik Anda" value=""
                                        rows="5"></textarea></td>
                                <td><button type="button" class="btn btn-primary tombolSimpanGuruSekolah" id=""
                                        data-id="{{ $gurusekolahs->id_user }}" value=""> Simpan</button>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-header">Kritik dan Saran Guru Asrama</div>
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        Anda akan memberikan kritik dan saran kepada guru asrama!
                        <br>Silahkan sampaikan kritik dan saran dengan baik dan sopan agar guru dapat mengevaluasi diri!
                    </div>
                    <table class="table" id="data_table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Guru</th>
                                <th scope="col">Kritik dan Saran</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guruasrama as $index => $guruasramas)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{ $guruasramas->nama_guru_asrama }}</td>
                                <td class="kritikrow"><textarea class="form-control rounded-0" id="kritik_guruasrama"
                                        name="kritik_guruasrama" placeholder="Berikan Kritik Anda" value=""
                                        rows="5"></textarea></td>
                                <td><button type="button" class="btn btn-primary tombolSimpanGuruAsrama" id=""
                                        data-id="{{ $guruasramas->nik_guruasrama }}" value=""> Simpan</button>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    
    $(document).on('click', '.tombolSimpanGuruSekolah', function () {
        var id = $(this).data('id');
        var kritik = $(this).parent().prev("td.updaterow").find("textarea").val();
        console.log(kritik);
        $.ajax({
            url: "/store_kritik_dan_saran_siswa",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id_guru': id,
                'kritik': $(this).parent().prev("td.updaterow").find("textarea").val(),
            },
            dataType: 'json',
            success: function (data) {
                alert('Berhasil menyimpan kritik dan saran');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Silahkan isi kritik dan saran anda!");
            }
        });
    });

    $(document).on('click', '.tombolSimpanGuruAsrama', function () {
        var id = $(this).data('id');
        var kritik = $(this).parent().prev("td.kritikrow").find("textarea").val();
        console.log(kritik);
        $.ajax({
            url: "/store_kritik_dan_saran_siswa",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id_guru': id,
                'kritik': $(this).parent().prev("td.kritikrow").find("textarea").val(),
            },
            dataType: 'json',
            success: function (data) {
                alert('Berhasil menyimpan kritik dan saran');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Silahkan isi kritik dan saran anda!");
            }
        });
    });

</script>

@endsection
