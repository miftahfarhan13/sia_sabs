@extends('layouts.app_sidebar')

@section('content')
<head>
    <title>Surat Sakit</title>
    <link rel="shortcut icon" href="img/group-6.png">
    <style>
        #form_surat_sakit .error {
            color: red;
        }
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
    <h4 class="font-weight-bold"><i class="fa fa-envelope mr-4"></i>Buat Surat Sakit</h4>
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
    <div class="row mt-2">
        <div class="col-md-9">
            <form id="form_surat_sakit" action="/storeSuratSakit" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">Surat Sakit</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <div class="alert alert-primary" role="alert">
                                    Silahkan masukkan nama siswa yang sakit dan tidak bisa hadir disekolah beserta
                                    dengan keterangannya!
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">Nama Siswa</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="id_siswa" name="id_siswa">
                                            <option selected disabled>Pilih Siswa</option>
                                            @foreach ($siswagedung as $siswagedungs)
                                            <option value="{{ $siswagedungs->id_siswa }}">
                                                {{ $siswagedungs->nama_siswa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control rounded-0" id="keterangan" name="keterangan"
                                            placeholder="Keterangan Siswa Tidak Hadir" value="" rows="3"></textarea>
                                    </div>
                                </div>

                                <input id="submitSuratSakit" type="submit" class="btn btn-primary" style="float:right;"
                                    value="Simpan">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    
        <div class="form-row mt-2">
            <div class="col">
                <div class="card">
                    <div class="card-header">Daftar Sakit Hari Ini</div>
                    <div class="card-body">
                        <table class="table table-striped" id="data_table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarsakit as $index => $daftarsakits)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{ $daftarsakits->tanggal }}</td>
                                    <td>{{ $daftarsakits->nama_siswa }}</td>
                                    <td>{{ $daftarsakits->keterangan }}</td>

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
    $(document).ready(function () {
        $("#form_surat_sakit").validate({
            rules: {
                keterangan: {
                    required: true,
                }
            },
            messages: {
                keterangan: {
                    required: 'Silahkan isi keterangan!',
                }
            },

            submitHandler: function (form) {
                form.submit();
            }
        });

    })

</script>

@endsection
