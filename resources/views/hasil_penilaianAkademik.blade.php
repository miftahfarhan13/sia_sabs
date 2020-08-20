@extends('layouts.app_sidebar')

@section('content')
<html>

<head>
    <title>Hasil Penilaian Akademik</title>
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
        <h4 class="font-weight-bold"><i class="fas fa-tasks mr-4"></i>Hasil Penilaian Akademik</h4>
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

        <div class="row">
            <p class="col-form-label col-sm-2 font-weight-bold">Pilih Tahun Ajaran</p>
            <div class="input-group col-sm-4">
                <select class="custom-select" id="pilih_tahun_ajaran" name="pilih_tahun_ajaran">
                    @foreach ($daftartahunajaran as $daftartahunajarans)
                    <option value="{{ $daftartahunajarans->tahun_ajaran }}, Sems : {{ $daftartahunajarans->semester }}">
                        {{ $daftartahunajarans->tahun_ajaran }}, Sems : {{ $daftartahunajarans->semester }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button id="pilih_tahunajaran" class="btn btn-primary" type="button">Pilih</button>
                </div>
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col">
                <ul class="nav nav-tabs" id="myTabPendaftaran" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="materi-tab" data-toggle="tab" href="#penilaianMateri" role="tab"
                            aria-controls="Penilaian Materi" aria-selected="true">Penilaian Materi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sikap-tab" data-toggle="tab" href="#penilaianSikap" role="tab"
                            aria-controls="Penilaian Sikap" aria-selected="false">Penilaian Sikap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keterampilan-tab" data-toggle="tab" href="#penilaianKeterampilan"
                            role="tab" aria-controls="Penilaian Keterampilan" aria-selected="false">Penilaian
                            Keterampilan</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="penilaianMateri" role="tabpanel"
                        aria-labelledby="materi-tab">
                        <div class="mt-2">
                            <div class="card">
                                <div class="card-header">Penilaian Materi</div>
                                <div class="card-body">
                                    <label class="col-form-label" id="kategori_pengetahuan" hidden>Pengetahuan</label>
                                    <table class="table table-striped" id="penilaian_materi">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Mapel</th>
                                                <th scope="col">Mata Pelajaran</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Nama Guru</th>
                                                <th scope="col">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- @foreach ($matapelajaran as $index => $matapelajarans)
                                            <tr>
                                                <th scope="row">{{$index+1}}</th>
                                                <td><label id="nama_kelas">{{ $matapelajarans->kode_mapel }}</label>
                                                </td>
                                                <td>{{ $matapelajarans->nama_mata_pelajaran }}</td>
                                                <td>{{ $matapelajarans->nama_kelas }}</td>
                                                <td>{{ $matapelajarans->nama_guru_sekolah }}</td>
                                                <td><button type="button"
                                                        class="btn btn-primary tombolDetailNilaiPengetahuan"
                                                        id="{{ Auth::user()->id_user }}"
                                                        data-id="{{ Auth::user()->id_user }}"
                                                        data-idguru="{{ $matapelajarans->id_user }}"
                                                        value="{{ Auth::user()->id_user }}"> Lihat</button>

                                            </tr>
                                            @endforeach -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="penilaianSikap" role="tabpanel" aria-labelledby="sikap-tab">
                        <div class="mt-2">
                            <div class="card">
                                <div class="card-header">Penilaian Sikap</div>
                                <div class="card-body">
                                    <label class="col-form-label" id="kategori_sikap" hidden>Sikap</label>
                                    <table class="table table-striped" id="penilaian_sikap">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Mapel</th>
                                                <th scope="col">Mata Pelajaran</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- @foreach ($matapelajaran as $index => $matapelajarans)
                                            <tr>
                                                <th scope="row">{{$index+1}}</th>
                                                <td><label id="nama_kelas">{{ $matapelajarans->kode_mapel }}</label>
                                                </td>
                                                <td>{{ $matapelajarans->nama_mata_pelajaran }}</td>
                                                <td>{{ $matapelajarans->nama_kelas }}</td>
                                                <td><button type="button" class="btn btn-primary tombolDetailNilaiSikap"
                                                        id="{{ Auth::user()->id_user }}"
                                                        data-id="{{ Auth::user()->id_user }}"
                                                        value="{{ Auth::user()->id_user }}"> Lihat</button>

                                            </tr>
                                            @endforeach -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="penilaianKeterampilan" role="tabpanel"
                        aria-labelledby="keterampilan-tab">
                        <div class="mt-2">
                            <div class="card">
                                <div class="card-header">Penilaian Keterampilan</div>
                                <div class="card-body">
                                    <label class="col-form-label" id="kategori_keterampilan" hidden>Keterampilan</label>
                                    <table class="table table-striped" id="penilaian_keterampilan">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Mapel</th>
                                                <th scope="col">Mata Pelajaran</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- @foreach ($matapelajaran as $index => $matapelajarans)
                                            <tr>
                                                <th scope="row">{{$index+1}}</th>
                                                <td><label id="nama_kelas">{{ $matapelajarans->kode_mapel }}</label>
                                                </td>
                                                <td>{{ $matapelajarans->nama_mata_pelajaran }}</td>
                                                <td>{{ $matapelajarans->nama_kelas }}</td>
                                                <td><button type="button"
                                                        class="btn btn-primary tombolDetailNilaiKeterampilan"
                                                        id="{{ Auth::user()->id_user }}"
                                                        data-id="{{ Auth::user()->id_user }}"
                                                        value="{{ Auth::user()->id_user }}"> Lihat</button>

                                            </tr>
                                            @endforeach -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalDetailNilaiPengetahuan" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        Hasil Penilaian
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped" id="modal_nilai_pengetahuan">
                                            <thead>
                                                <tr>

                                                    <th scope="col">Tipe</th>
                                                    <th scope="col">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card mt-2">
                                    <div class="card-header">
                                        Deskripsi Nilai
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <textarea class="col-sm form-control rounded-0" id="deskripsi_pengetahuan"
                                                name="deskripsi_pengetahuan" placeholder="Deskripsi raport siswa"
                                                value="" rows="3" readonly></textarea>
                                            <!-- <label class="ml-3 col-form-label" id="deskripsi_pengetahuan"></label> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDetailNilaiSikap" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div style="max-width:1000px">
                            <div class="form-row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-striped" id="modal_nilai_sikap">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Tipe</th>
                                                        <th scope="col">Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-header">
                                            Deskripsi Nilai
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <textarea class="col-sm form-control rounded-0" id="deskripsi_sikap"
                                                    name="deskripsi_sikap" placeholder="Deskripsi raport siswa" value=""
                                                    rows="3" readonly></textarea>
                                                <!-- <label class="ml-3 col-form-label" id="deskripsi_pengetahuan"></label> -->
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDetailNilaiKeterampilan" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div style="max-width:1000px">
                            <div class="form-row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-striped" id="modal_nilai_keterampilan">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Tipe</th>
                                                        <th scope="col">Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-header">
                                            Deskripsi Nilai
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <textarea class="col-sm form-control rounded-0"
                                                    id="deskripsi_keterampilan" name="deskripsi_keterampilan"
                                                    placeholder="Deskripsi raport siswa" value="" rows="3"
                                                    readonly></textarea>
                                                <!-- <label class="ml-3 col-form-label" id="deskripsi_pengetahuan"></label> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $('#pilih_tahunajaran').on('click', function () {
        var tahun_ajaran = $('#pilih_tahun_ajaran option:selected').val();
        if (tahun_ajaran) {
            $.ajax({
                url: '/getMataPelajaran/',
                type: "GET",
                dataType: "json",
                data: {
                    'pilih_tahun': tahun_ajaran,
                },
                success: function (data) {

                    var markup = '';
                    var markup2 = '';
                    var markup3 = '';
                    var no_tabel = 0;
                    $.each(data, function (key, value) {
                        no_tabel++;

                        markup += '<tr> <td> ' + no_tabel +
                            ' </td> <td> <label id="nama_kelas">' + value.kode_mapel +
                            '</label> </td><td> ' + value.nama_mata_pelajaran +
                            ' </td><td> ' + value.nama_kelas + ' </td><td> ' + value
                            .nama_guru_sekolah +
                            ' </td><td><button type="button" class="btn btn-primary tombolDetailNilaiPengetahuan" id="{{ Auth::user()->id_user }}" data-id="{{ Auth::user()->id_user }}" data-idguru="{{ $matapelajarans->id_user }}" value="{{ Auth::user()->id_user }}"> Lihat</button></td></tr>';

                        markup2 += '<tr> <td> ' + no_tabel +
                            ' </td> <td> <label id="nama_kelas">' + value.kode_mapel +
                            '</label> </td><td> ' + value.nama_mata_pelajaran +
                            ' </td><td> ' + value.nama_kelas + ' </td><td> ' + value
                            .nama_guru_sekolah +
                            ' </td><td><button type="button" class="btn btn-primary tombolDetailNilaiSikap" id="{{ Auth::user()->id_user }}" data-id="{{ Auth::user()->id_user }}" data-idguru="{{ $matapelajarans->id_user }}" value="{{ Auth::user()->id_user }}"> Lihat</button></td></tr>';

                        markup3 += '<tr> <td> ' + no_tabel +
                            ' </td> <td> <label id="nama_kelas">' + value.kode_mapel +
                            '</label> </td><td> ' + value.nama_mata_pelajaran +
                            ' </td><td> ' + value.nama_kelas + ' </td><td> ' + value
                            .nama_guru_sekolah +
                            ' </td><td><button type="button" class="btn btn-primary tombolDetailNilaiKeterampilan" id="{{ Auth::user()->id_user }}" data-id="{{ Auth::user()->id_user }}" data-idguru="{{ $matapelajarans->id_user }}" value="{{ Auth::user()->id_user }}"> Lihat</button></td></tr>';
                    });
                    $('#penilaian_materi tbody').html(markup);
                    $('#penilaian_sikap tbody').html(markup2);
                    $('#penilaian_keterampilan tbody').html(markup3);
                }
            });
        }
    });

    $(document).ready(function () {
        $(document).on('click', '.tombolDetailNilaiPengetahuan', function () {
            
            $("textarea#deskripsi_pengetahuan").val('');
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            var idguru = $(this).data('idguru');
            var idmatapelajaran = $(this).closest('tr').find('label').html();
            var tahun_ajaran = $('#pilih_tahun_ajaran option:selected').val();
            $.ajax({
                url: "/getNilaiMataPelajaran",
                type: "get",
                data: {
                    'id_mata_pelajaran': idmatapelajaran,
                    'id_kategori': $('#kategori_pengetahuan').html(),
                    'id_gurusekolah': idguru,
                    'pilih_tahun': tahun_ajaran,
                },
                dataType: 'json',
                success: function (data) {
                    var no_tabel = 0;
                    var markup = '';
                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr>  <td> ' +
                            value.tipe_nilai +
                            ' </td><td>' + value.nilai +
                            '</td></tr>';
                    });
                    $('#modal_nilai_pengetahuan tbody').html(markup);

                }
            });

            $.ajax({
                url: "/getDeskripsiMataPelajaran",
                type: "get",
                data: {
                    'id_mata_pelajaran': idmatapelajaran,
                    'id_kategori': 'Pengetahuan',
                    'pilih_tahun': tahun_ajaran,
                },
                dataType: 'json',
                success: function (data) {

                    $.each(data, function (key, value) {
                        $("textarea#deskripsi_pengetahuan").val(value.nilai);
                    });


                }
            });

            $('#modalDetailNilaiPengetahuan').modal('show');

        });

        $(document).on('click', '.tombolDetailNilaiSikap', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            $("textarea#deskripsi_sikap").val('');
            var idmatapelajaran = $(this).closest('tr').find('label').html();
            var tahun_ajaran = $('#pilih_tahun_ajaran option:selected').val();
            $.ajax({
                url: "/getNilaiMataPelajaranSikap",
                type: "get",
                data: {
                    'id_mata_pelajaran': $(this).closest('tr').find('label').html(),
                    'pilih_tahun': tahun_ajaran,
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr>  <td> ' +
                            value.tipe_nilai +
                            ' </td><td>' + value.nilai +
                            '</td></tr>';


                    });
                    $('#modal_nilai_sikap tbody').html(markup);
                }
            });

            $.ajax({
                url: "/getDeskripsiMataPelajaran",
                type: "get",
                data: {
                    'id_mata_pelajaran': idmatapelajaran,
                    'id_kategori': 'Sikap',
                    'pilih_tahun': tahun_ajaran,
                },
                dataType: 'json',
                success: function (data) {

                    $.each(data, function (key, value) {
                        $("textarea#deskripsi_sikap").val(value.nilai);
                    });
                }
            });

            $('#modalDetailNilaiSikap').modal('show');
        });

        $(document).on('click', '.tombolDetailNilaiKeterampilan', function () {
            // $('#modalEditNilai').modal('show');
            $("textarea#deskripsi_keterampilan").val('');
            var id = $(this).data('id');
            var idmatapelajaran = $(this).closest('tr').find('label').html();
            var tahun_ajaran = $('#pilih_tahun_ajaran option:selected').val();
            $.ajax({
                url: "/getNilaiMataPelajaranKeterampilan",
                type: "get",
                data: {
                    'id_mata_pelajaran': $(this).closest('tr').find('label').html(),
                    'pilih_tahun': tahun_ajaran,
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr>  <td> ' +
                            value.tipe_nilai +
                            ' </td><td> ' +
                            value.nilai +
                            ' </td></tr>';
                    });
                    $('#modal_nilai_keterampilan tbody').html(markup);

                }
            });

            $.ajax({
                url: "/getDeskripsiMataPelajaran",
                type: "get",
                data: {
                    'id_mata_pelajaran': idmatapelajaran,
                    'id_kategori': 'Keterampilan',
                    'pilih_tahun': tahun_ajaran,
                },
                dataType: 'json',
                success: function (data) {
                    $.each(data, function (key, value) {
                        $("textarea#deskripsi_keterampilan").val(value.nilai);
                    });
                }
            });
            $('#modalDetailNilaiKeterampilan').modal('show');
        });




    })

</script>
@endsection
