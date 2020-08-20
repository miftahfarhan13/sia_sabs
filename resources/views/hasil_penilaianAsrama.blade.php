@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Hasil Penilaian Asrama</title>
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

<body>
    <div>
        <h4 class="font-weight-bold"><i class="fas fa-tasks mr-4"></i>Hasil Penilaian Asrama</h4>
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
                <div class="row">
                    <label class="col-form-label col-sm-2 font-weight-bold">Pilih Kelas</label>
                    <div class="input-group col-sm-3">
                        <select class="custom-select" id="kelas_asrama" name="kelas_asrama">
                            @foreach ($kelasasrama as $kelasasramas)
                            <option value="{{ $kelasasramas->nama_sub_kelas }}">
                                {{ $kelasasramas->nama_sub_kelas }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button id="pilih_kelas" class="btn btn-primary pilih_kelas" type="button">Pilih</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="alert alert-primary mt-2" role="alert">
            Silahkan pilih kelas terlebih dahulu untuk menampilkan nilai asrama!
        </div>
        <div class="form-row mt-3">
            <div class="col">
                <div class="tab-pane fade show active" id="penilaianMateri" role="tabpanel"
                    aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header">Materi Pokok</div>
                            <div class="card-body">
                                <label class="col-form-label" id="kategori_pengetahuan" hidden>Materi
                                    Pokok</label>
                                <table class="table table-striped" id="tabel_materi_pokok">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Materi</th>
                                            <th scope="col">Nama Materi</th>
                                            <th scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col">
                <div class="tab-pane fade show active" id="penilaianPraktikum" role="tabpanel"
                    aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header">Pemahaman Konsep dan Praktikum</div>
                            <div class="card-body">
                                <label class="col-form-label" id="kategori_pengetahuan" hidden>Pengetahuan</label>
                                <table class="table table-striped" id="tabel_praktikum">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Materi</th>
                                            <th scope="col">Nama Materi</th>
                                            <th scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col">
                <div class="tab-pane fade show active" id="penilaianMateri" role="tabpanel"
                    aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header">Sikap dan Perilaku</div>
                            <div class="card-body">
                                <label class="col-form-label" id="kategori_pengetahuan" hidden>Pengetahuan</label>
                                <table class="table table-striped" id="tabel_sikap">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Materi</th>
                                            <th scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col">
                <div class="tab-pane fade show active" id="penilaianMateri" role="tabpanel"
                    aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header">Kegiatan Ekstrakulikuler/Pengembangan Diri</div>
                            <div class="card-body">
                                <label class="col-form-label" id="kategori_pengetahuan" hidden>Pengetahuan</label>
                                <table class="table table-striped" id="tabel_ekstrakulikuler">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Materi</th>
                                            <th scope="col">Nama Materi</th>
                                            <th scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col">
                <div class="tab-pane fade show active" id="penilaianMateri" role="tabpanel"
                    aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header">Catatan dan Saran Wali Kelas</div>
                            <div class="card-body">
                                <label class="col-form-label" id="kategori_pengetahuan" hidden>Pengetahuan</label>
                                <table class="table table-striped" id="tabel_saran">
                                    <thead>
                                        <tr>

                                            <th scope="col">Saran</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>


<script>
    $(document).ready(function () {
        $(document).on('click', '.pilih_kelas', function () {
            var nama_kelas = $('#kelas_asrama option:selected').val();
            // $('#modalEditNilai').modal('show');
            $.ajax({
                url: "/getNilaiAsramaSiswaMateri",
                type: "get",
                data: {
                    'kelas_asrama': nama_kelas,
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr> <td class="font-weight-bold"> ' + no_tabel +
                            ' </td> <td> ' +
                            value.kode_materi +
                            ' </td><td> ' +
                            value.nama_materi +
                            ' </td><td> ' +
                            value.nilai +
                            ' </td></tr>';
                    });

                    $('#tabel_materi_pokok tbody').html(markup);
                }
            });

            $.ajax({
                url: "/getNilaiAsramaSiswaPraktikum",
                type: "get",
                data: {
                    'kelas_asrama': nama_kelas,
                },
                dataType: 'json',
                success: function (data) {

                    var markup2 = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup2 += '<tr> <td class="font-weight-bold"> ' +
                            no_tabel +
                            ' </td> <td> ' +
                            value.kode_materi +
                            ' </td><td> ' +
                            value.nama_materi +
                            ' </td><td> ' +
                            value.nilai +
                            ' </td></tr>';
                    });

                    $('#tabel_praktikum tbody').html(markup2);
                }
            });

            $.ajax({
                url: "/getNilaiAsramaSiswaSikap",
                type: "get",
                data: {
                    'kelas_asrama': nama_kelas,
                },
                dataType: 'json',
                success: function (data) {

                    var markup3 = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup3 += '<tr> <td class="font-weight-bold"> ' +
                            no_tabel +
                            ' </td> <td> ' +
                            value.nama_materi +
                            ' </td><td> ' +
                            value.nilai +
                            ' </td></tr>';
                    });

                    $('#tabel_sikap tbody').html(markup3);
                }
            });

            $.ajax({
                url: "/getNilaiAsramaSiswaEkstrakulikuler",
                type: "get",
                data: {
                    'kelas_asrama': nama_kelas,
                },
                dataType: 'json',
                success: function (data) {

                    var markup4 = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup4 += '<tr> <td class="font-weight-bold"> ' +
                            no_tabel +
                            ' </td> <td> ' +
                            value.kode_materi +
                            ' </td><td> ' +
                            value.nama_materi +
                            ' </td><td> ' +
                            value.nilai +
                            ' </td></tr>';
                    });

                    $('#tabel_ekstrakulikuler tbody').html(markup4);
                }
            });

            $.ajax({
                url: "/getNilaiAsramaSiswaSaran",
                type: "get",
                data: {
                    'kelas_asrama': nama_kelas,
                },
                dataType: 'json',
                success: function (data) {

                    var markup5 = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup5 += '<tr> <td> ' +
                            value.nilai +
                            ' </td></tr>';
                    });

                    $('#tabel_saran tbody').html(markup5);
                }
            });
        });
    })

</script>

@endsection
