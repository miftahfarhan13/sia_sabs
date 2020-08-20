@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Edit Nilai Asrama</title>
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
    <h4 class="font-weight-bold"><i class="fa fa-edit mr-4"></i>Edit Nilai Asrama</h4>
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
                <label class="col-form-label font-weight-bold col-sm-2">Guru</label>
                    <div class="col-sm-10">
                        @foreach ($guruasrama as $guruasramas)
                        <label class="col-form-label">{{ $guruasramas->nama_guru_asrama }}</label>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                <label class="col-sm-2 col-form-label font-weight-bold">Graha</label>
                    <div class="col-sm-10">
                        @foreach ($guruasrama as $guruasramas)
                        <label class="col-sm- col-form-label" style="display: none;"
                            id="kode_gedung">{{ $guruasramas->kode_gedung }}</label>
                        <label class="col-sm- col-form-label" id="nama_gedung">{{ $guruasramas->nama_gedung }}</label>
                        @endforeach
                    </div>
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
                    <a class="nav-link" id="akhlak-tab" data-toggle="tab" href="#penilaianPraktikum" role="tab"
                        aria-controls="Penilaian Akhlak" aria-selected="false">Penilaian Praktikum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="materi-tab" data-toggle="tab" href="#penilaianSikap" role="tab"
                        aria-controls="Penilaian Materi" aria-selected="true">Penilaian Sikap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="akhlak-tab" data-toggle="tab" href="#penilaianEkstrakulikuler" role="tab"
                        aria-controls="Penilaian Akhlak" aria-selected="false">Penilaian Ekstrakulikuler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="akhlak-tab" data-toggle="tab" href="#saranWaliKelas" role="tab"
                        aria-controls="Penilaian Akhlak" aria-selected="false">Saran Wali Kelas</a>
                </li>

            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="penilaianMateri" role="tabpanel"
                    aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Penilaian Materi</div>

                            <div class="card-body">
                                <input type="hidden" name="kategori_materi" id="kategori_materi" value="Materi Pokok">
                                <table id="presensi_sekolah" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Gedung</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($siswaasrama as $index => $siswaasramas)
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>{{ $siswaasramas->id_siswa }}</td>
                                            <td>{{ $siswaasramas->nama_siswa }}</td>
                                            <td>{{ $siswaasramas->nama_gedung }}</td>
                                            <td><input class="col-form-label" hidden
                                                    value="{{ $siswaasramas->kode_kelas_asrama }}">
                                                <label class="col-form-label"
                                                    id="nama_sub_kelas">{{ $siswaasramas->nama_sub_kelas }}</label>
                                            </td>
                                            <td><button type="button" class="btn btn-warning tombolEditNilaiMateri"
                                                    id="{{ $siswaasramas->id_siswa }}"
                                                    data-id="{{ $siswaasramas->id_siswa }}"
                                                    value="{{ $siswaasramas->id_siswa }}"> <i
                                                        class="fas fa-edit text-center mr-1"
                                                        style="color: black"></i>Edit Nilai</button></i></td>

                                        </tr>
                                        @endforeach
                                        <!-- ini isinya data -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade show" id="penilaianPraktikum" role="tabpanel" aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Penilaian Praktikum</div>

                            <div class="card-body">
                                <input type="hidden" name="kategori_praktikum" id="kategori_praktikum"
                                    value="Pemahaman Konsep dan Praktikum">
                                <table id="presensi_sekolah" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Gedung</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($siswaasrama as $index => $siswaasramas)
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>{{ $siswaasramas->id_siswa }}</td>
                                            <td>{{ $siswaasramas->nama_siswa }}</td>
                                            <td>{{ $siswaasramas->nama_gedung }}</td>
                                            <td><input class="col-form-label" hidden
                                                    value="{{ $siswaasramas->kode_kelas_asrama }}">
                                                <label class="col-form-label"
                                                    id="nama_sub_kelas">{{ $siswaasramas->nama_sub_kelas }}</label>
                                            </td>
                                            <td><button type="button" class="btn btn-warning tombolEditNilaiPraktikum"
                                                    id="{{ $siswaasramas->id_siswa }}"
                                                    data-id="{{ $siswaasramas->id_siswa }}"
                                                    value="{{ $siswaasramas->id_siswa }}"> <i
                                                        class="fas fa-edit text-center mr-1"
                                                        style="color: black"></i>Edit Nilai</button></i></td>

                                        </tr>
                                        @endforeach
                                        <!-- ini isinya data -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade show" id="penilaianSikap" role="tabpanel" aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Penilaian Sikap</div>

                            <div class="card-body">
                                <input type="hidden" name="kode_materi_table_sikap" id="kode_materi_table_sikap"
                                    value="Sikap dan Perilaku">
                                <table id="presensi_sekolah" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Gedung</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($siswaasrama as $index => $siswaasramas)
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>{{ $siswaasramas->id_siswa }}</td>
                                            <td>{{ $siswaasramas->nama_siswa }}</td>
                                            <td>{{ $siswaasramas->nama_gedung }}</td>
                                            <td><input class="col-form-label" hidden
                                                    value="{{ $siswaasramas->kode_kelas_asrama }}">
                                                <label class="col-form-label"
                                                    id="nama_sub_kelas">{{ $siswaasramas->nama_sub_kelas }}</label>
                                            </td>
                                            <td><button type="button" class="btn btn-warning tombolEditNilaiSikap"
                                                    id="{{ $siswaasramas->id_siswa }}"
                                                    data-id="{{ $siswaasramas->id_siswa }}"
                                                    value="{{ $siswaasramas->id_siswa }}"> <i
                                                        class="fas fa-edit text-center mr-1"
                                                        style="color: black"></i>Edit Nilai</button></i></td>

                                        </tr>
                                        @endforeach
                                        <!-- ini isinya data -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade show" id="penilaianEkstrakulikuler" role="tabpanel"
                    aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Penilaian Ekstrakulikuler</div>

                            <div class="card-body">
                                <input type="hidden" name="kode_materi_table_ekstrakulikuler"
                                    id="kode_materi_table_ekstrakulikuler"
                                    value="Kegiatan Ekstrakulikuler/Pengembangan Diri">
                                <table id="presensi_sekolah" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Gedung</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($siswaasrama as $index => $siswaasramas)
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>{{ $siswaasramas->id_siswa }}</td>
                                            <td>{{ $siswaasramas->nama_siswa }}</td>
                                            <td>{{ $siswaasramas->nama_gedung }}</td>
                                            <td><input class="col-form-label" hidden
                                                    value="{{ $siswaasramas->kode_kelas_asrama }}">
                                                <label class="col-form-label"
                                                    id="nama_sub_kelas">{{ $siswaasramas->nama_sub_kelas }}</label>
                                            </td>
                                            <td><button type="button"
                                                    class="btn btn-warning tombolEditNilaiEkstrakulikuler"
                                                    id="{{ $siswaasramas->id_siswa }}"
                                                    data-id="{{ $siswaasramas->id_siswa }}"
                                                    value="{{ $siswaasramas->id_siswa }}"> <i
                                                        class="fas fa-edit text-center mr-1"
                                                        style="color: black"></i>Edit Nilai</button></i></td>

                                        </tr>
                                        @endforeach
                                        <!-- ini isinya data -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade show" id="saranWaliKelas" role="tabpanel" aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Catatan dan Saran Wali Kelas</div>

                            <div class="card-body">
                                <input type="hidden" name="kode_materi_table_saran" id="kode_materi_table_saran"
                                    value="Catatan dan Saran Wali Kelas">
                                <table id="presensi_sekolah" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Gedung</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($siswaasrama as $index => $siswaasramas)
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>{{ $siswaasramas->id_siswa }}</td>
                                            <td>{{ $siswaasramas->nama_siswa }}</td>
                                            <td>{{ $siswaasramas->nama_gedung }}</td>
                                            <td><input class="col-form-label" hidden
                                                    value="{{ $siswaasramas->kode_kelas_asrama }}">
                                                <label class="col-form-label"
                                                    id="nama_sub_kelas">{{ $siswaasramas->nama_sub_kelas }}</label>
                                            </td>
                                            <td><button type="button" class="btn btn-warning tombolEditNilaiSaran"
                                                    id="{{ $siswaasramas->id_siswa }}"
                                                    data-id="{{ $siswaasramas->id_siswa }}"
                                                    value="{{ $siswaasramas->id_siswa }}"> <i
                                                        class="fas fa-edit text-center mr-1"
                                                        style="color: black"></i>Edit Saran</button></i></td>

                                        </tr>
                                        @endforeach
                                        <!-- ini isinya data -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>


    </div>

    <div class="modal fade" id="modalEditNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="/storeNilaiSekolah" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Nilai</h5>
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
                                            <table class="table" id="modal_nilai">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Tipe</th>
                                                        <th scope="col">Nilai</th>
                                                        <th scope="col">Action</th>

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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditSaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="/storeNilaiSekolah" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Nilai</h5>
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
                                            <table class="table" id="modal_saran">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Tipe</th>
                                                        <th scope="col">Nilai</th>
                                                        <th scope="col">Action</th>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDataKosong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary" role="alert">
                        Data tidak ditemukan, silahkan tambah terlebih dahulu di menu Penilaian Asrama
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="konfirmasiDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-primary" role="alert">
                        Apakah anda yakin untuk menghapus data ini?
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" name="tombolDeleteNilai"
                        id="tombolDeleteNilai">OK</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                </div>

            </div>

        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.tombolEditNilaiMateri', function () {

            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            var kategori = 'Materi Pokok';
            var kelas = $(this).closest('tr').find('label').html();
            $.ajax({
                url: "/get_nilai_asrama",
                type: "get",
                data: {
                    'id_user_siswa': id,
                    'kategori_materi': kategori,
                    'kelas_asrama': kelas,
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr> <td> ' + no_tabel +
                            ' <label class="" id="id_nilai" hidden>' + value
                            .id +
                            '</label></td> <td>' + value
                            .nama_materi +
                            ' </td><td> <input type="text" class="form-control" id="nilai" name="nilai" value="' +
                            value.nilai +
                            '"> </td><td><button type="button" class="btn btn-primary tombolUpdateNilai" id="' +
                            id + '" data-id="' +
                            id +
                            '" value="' + id +
                            '"> Update</button><button type="button" class="btn btn-danger tombolKonfirmasiDelete ml-2" id="' +
                            value.id + '" data-id="' + value.id +
                            '" value="' + value.id +
                            '"> </i>Delete</button></td></tr>';
                    });

                    $('#modal_nilai tbody').html(markup);
                    $('#modalEditNilai').modal('show');


                }
            });
        });

        $(document).on('click', '.tombolEditNilaiPraktikum', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            var kategori = 'Pemahaman Konsep dan Praktikum';
            var kelas = $(this).closest('tr').find('label').html();
            $.ajax({
                url: "/get_nilai_asrama",
                type: "get",
                data: {
                    'id_user_siswa': id,
                    'kategori_materi': kategori,
                    'kelas_asrama': kelas,
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {

                        no_tabel++;
                        markup += '<tr> <td> ' + no_tabel +
                            ' <label class="" id="id_nilai" hidden>' + value
                            .id +
                            '</label></td> <td>' + value
                            .nama_materi +
                            ' </td><td> <input type="text" class="form-control" id="nilai" name="nilai" value="' +
                            value.nilai +
                            '"> </td><td><button type="button" class="btn btn-primary tombolUpdatePraktikumSikapEkstrakulikuler" id="' +
                            id + '" data-id="' +
                            id +
                            '" value="' + id +
                            '"> Update</button><button type="button" class="btn btn-danger tombolKonfirmasiDelete ml-2" id="' +
                            value.id + '" data-id="' + value.id +
                            '" value="' + value.id +
                            '"> </i>Delete</button></td></tr>';
                    });
                    $('#modal_nilai tbody').html(markup);
                    $('#modalEditNilai').modal('show');
                }
            });
        });

        $(document).on('click', '.tombolEditNilaiSikap', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            var kategori = 'Sikap dan Perilaku';
            var kelas = $(this).closest('tr').find('label').html();
            $.ajax({
                url: "/get_nilai_asrama",
                type: "get",
                data: {
                    'id_user_siswa': id,
                    'kategori_materi': kategori,
                    'kelas_asrama': kelas,
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {

                        no_tabel++;
                        markup += '<tr> <td> ' + no_tabel +
                            ' <label class="" id="id_nilai" hidden>' + value
                            .id +
                            '</label></td> <td>' + value
                            .nama_materi +
                            ' </td><td> <input type="text" class="form-control" id="nilai" name="nilai" value="' +
                            value.nilai +
                            '"> </td><td><button type="button" class="btn btn-primary tombolUpdatePraktikumSikapEkstrakulikuler" id="' +
                            id + '" data-id="' +
                            id +
                            '" value="' + id +
                            '"> Update</button><button type="button" class="btn btn-danger tombolKonfirmasiDelete ml-2" id="' +
                            value.id + '" data-id="' + value.id +
                            '" value="' + value.id +
                            '"> </i>Delete</button></td></tr>';
                    });
                    $('#modal_nilai tbody').html(markup);
                    $('#modalEditNilai').modal('show');
                }
            });
        });
        $(document).on('click', '.tombolEditNilaiEkstrakulikuler', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            var kategori = 'Kegiatan Ekstrakulikuler/Pengembangan Diri';
            var kelas = $(this).closest('tr').find('label').html();
            $.ajax({
                url: "/get_nilai_asrama",
                type: "get",
                data: {
                    'id_user_siswa': id,
                    'kategori_materi': kategori,
                    'kelas_asrama': kelas,
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {

                        no_tabel++;
                        markup += '<tr> <td> ' + no_tabel +
                            ' <label class="" id="id_nilai" hidden>' + value
                            .id +
                            '</label></td> <td>' + value
                            .nama_materi +
                            ' </td><td> <input type="text" class="form-control" id="nilai" name="nilai" value="' +
                            value.nilai +
                            '"> </td><td><button type="button" class="btn btn-primary tombolUpdatePraktikumSikapEkstrakulikuler" id="' +
                            id + '" data-id="' +
                            id +
                            '" value="' + id +
                            '"> Update</button><button type="button" class="btn btn-danger tombolKonfirmasiDelete ml-2" id="' +
                            value.id + '" data-id="' + value.id +
                            '" value="' + value.id +
                            '"> </i>Delete</button></td></tr>';
                    });
                    $('#modal_nilai tbody').html(markup);
                    $('#modalEditNilai').modal('show');
                }
            });
        });

        $(document).on('click', '.tombolEditNilaiSaran', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            var kategori = 'Catatan dan Saran Wali Kelas';
            var kelas = $(this).closest('tr').find('label').html();
            $.ajax({
                url: "/get_nilai_asrama",
                type: "get",
                data: {
                    'id_user_siswa': id,
                    'kategori_materi': kategori,
                    'kelas_asrama': kelas,
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {

                        no_tabel++;
                        markup += '<tr><td><label class="" id="id_nilai" hidden>' +
                            value
                            .id +
                            '</label> ' + value
                            .nama_materi +
                            ' </td><td class="updaterow"> <textarea class="form-control rounded-0" id="nilai" name="nilai" placeholder="" value="" rows="3">' +
                            value.nilai +
                            ' </textarea> </td><td><button type="button" class="btn btn-primary tombolUpdateSaran" id="' +
                            id + '" data-id="' +
                            id +
                            '" value="' + id +
                            '"> Update</button><button type="button" class="btn btn-danger tombolKonfirmasiDelete ml-2" id="' +
                            value.id + '" data-id="' + value.id +
                            '" value="' + value.id +
                            '"> </i>Delete</button></td></tr>';
                        $("textarea#nilai").val(value.nilai);
                    });

                    $('#modal_saran tbody').html(markup);
                    $('#modalEditSaran').modal('show');
                }
            });
        });

        var nilai_id;
        $(document).on('click', '.tombolKonfirmasiDelete', function () {
            nilai_id = $(this).data('id');
            $('#konfirmasiDelete').modal('show');
        });

        $(document).on('click', '#tombolDeleteNilai', function () {
            // $('#modalEditNilai').modal('show');
            var $button = $(this);
            var table = $('#modal_nilai').DataTable();
            $.ajax({
                url: "/deleteNilaiAsrama/" + nilai_id,
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    $('#tombolDeleteNilai').text('Deleting...');
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#konfirmasiDelete').modal('hide');
                        $('#modalEditNilai').modal('hide');
                        table.row($button.closest('tr').find('label')).remove()
                            .draw();

                        alert('Data Presensi Berhasil Didelete');
                    }, 2000);

                }
            });
        });

        $(document).on('click', '.tombolUpdateNilai', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: "/updateNilaiAsrama",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id_nilai': $(this).closest('tr').find('label').html(),
                    'nilai': $(this).closest('tr').find('input').val(),
                },
                dataType: 'json',
                success: function (data) {

                    alert('Data Nilai Berhasil Diupdate');

                }
            });
        });

        $(document).on('click', '.tombolUpdatePraktikumSikapEkstrakulikuler', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            var nilai = $(this).closest('tr').find('input').val();
            if (nilai >= 1 && nilai <= 100) {
                $.ajax({
                    url: "/updateNilaiAsrama",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id_nilai': $(this).closest('tr').find('label').html(),
                        'nilai': $(this).closest('tr').find('input').val(),
                    },
                    dataType: 'json',
                    success: function (data) {

                        alert('Data Nilai Berhasil Diupdate');

                    }
                });
            } else {
                alert('Silahkan isi nilai 1 sampai 100!');
            }

        });


        $(document).on('click', '.tombolUpdateSaran', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            var text = $(this).parent().prev("td.updaterow").find("textarea").val();
            console.log(text);
            $.ajax({
                url: "/updateNilaiAsrama",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id_nilai': $(this).closest('tr').find('label').html(),
                    'nilai': text,
                },
                dataType: 'json',
                success: function (data) {

                    alert('Data Nilai Berhasil Diupdate');

                }
            });
        });
    })

</script>

@endsection
