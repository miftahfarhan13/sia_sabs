@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Edit Nilai</title>
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
    <h4 class="font-weight-bold"><i class="fa fa-edit mr-4"></i>Edit Nilai</h4>
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
                    <label class="col-form-label" id="tahunAjaran">{{ $tahunajarans->tahun_ajaran }}</label>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label font-weight-bold">Semester</label>
                <div class="col-sm-10">
                    @foreach ($tahunajaran as $tahunajaran)
                    <label class="col-form-label" id="semester">{{ $tahunajarans->semester }}</label>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 col-form-label font-weight-bold">Mata Pelajaran</label>
                <div class="col-sm-10">
                    @foreach ($gurusekolahs as $gurusekolah)
                    <label class="col-sm- col-form-label" style="display: none;"
                        id="id_matapelajaran">{{ $gurusekolah->id_mata_pelajaran }}</label>
                    <label class="col-sm- col-form-label"
                        id="id_matapelajaran">{{ $gurusekolah->nama_mata_pelajaran }}</label>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-sm-2 font-weight-bold">Pilih Kelas</label>
                <div class="input-group col-sm-3">
                    <select class="custom-select" id="students_class_name" name="students_class_name">
                        @foreach ($jadwalmengajarguru as $jadwalmengajargurus)
                        <option value="{{ $jadwalmengajargurus->nama_kelas }}">
                            {{ $jadwalmengajargurus->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button id="pilih_kelas" class="btn btn-primary" type="button">Pilih</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="form-row">
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
                <a class="nav-link" id="keterampilan-tab" data-toggle="tab" href="#penilaianKeterampilan" role="tab"
                    aria-controls="Penilaian Keterampilan" aria-selected="false">Penilaian
                    Keterampilan</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="penilaianMateri" role="tabpanel" aria-labelledby="materi-tab">
                <div class="mt-2">
                    <div class="card">
                        <div class="card-header font-weight-bold">Penilaian Materi</div>

                        <div class="card-body">
                            <label class="col-form-label" id="kategori_pengetahuan" hidden>Pengetahuan</label>
                            <table id="edit_nilai_materi" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- @foreach ($siswa as $siswas)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $siswas->id_user_siswa }}</td>
                                            <td>{{ $siswas->nama_siswa }}</td>
                                            <td>{{ $siswas->nama_kelas }}</td>
                                            <td><i class="fas fa-plus-square text-center" style="color: green"></i></td>
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
                        <div class="card-header font-weight-bold">Penilaian Sikap</div>

                        <div class="card-body">
                            <label class="col-form-label" id="kategori_sikap" hidden>Sikap</label>
                            <table id="edit_nilai_sikap" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ini isinya data -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="penilaianKeterampilan" role="tabpanel" aria-labelledby="keterampilan-tab">
                <div class="mt-2">
                    <div class="card">
                        <div class="card-header font-weight-bold">Penilaian Keterampilan</div>

                        <div class="card-body">
                            <label class="col-form-label" id="kategori_keterampilan">Keterampilan</label>
                            <table id="edit_nilai_keterampilan" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
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
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" class="form-control" id="id_siswa_modal" name="id_siswa_modal" value="" hidden>

                <div style="max-width:1000px">
                    <div class="form-row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-striped" id="modal_nilai">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tipe</th>
                                                <th scope="col">Nilai</th>
                                                <th scope="col">Keterangan</th>
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
                <button type="button" class="btn btn-danger" name="tombolDeleteNilai" id="tombolDeleteNilai">OK</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


            </div>

        </div>

    </div>
</div>

</div>
<script>
    $(document).ready(function () {

        $(document).on('click', '.tombolEditNilaiPengetahuan', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            $('#id_siswa_modal').val(id);
            $.ajax({
                url: "/getnilai",
                type: "get",
                data: {
                    'id_user_siswa': id,
                    'id_mata_pelajaran': $('#id_matapelajaran').html(),
                    'tahun_ajaran': $('#tahunAjaran').html(),
                    'semester': $('#semester').html(),
                    'id_kategori': $('#kategori_pengetahuan').html(),
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr> <td> ' + no_tabel +
                            ' </td> <td> ' + value.tipe_nilai +
                            '  <label class="" id="idnilai" hidden>' + value
                            .id +
                            '</label> </td><td> <input type="number" class="form-control" id="nilai" name="nilai" value="' +
                            value.nilai +
                            '"> </td><td> ' + value.keterangan +
                            ' </td><td><button type="button" class="btn btn-primary tombolUpdateNilai" id="' +
                            value.id_user + '" data-id="' + value
                            .id_user +
                            '" value="' + value.id_user +
                            '"> Update</button><button type="button" class="btn btn-danger tombolKonfirmasiDelete ml-2" id="' +
                            value.id + '" data-id="' + value
                            .id +
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
            $('#id_siswa_modal').val(id);
            $.ajax({
                url: "/getnilai",
                type: "get",
                data: {
                    'id_user_siswa': id,
                    'id_mata_pelajaran': $('#id_matapelajaran').html(),
                    'tahun_ajaran': $('#tahunAjaran').html(),
                    'semester': $('#semester').html(),
                    'id_kategori': $('#kategori_sikap').html(),
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr> <td> ' + no_tabel +
                            ' </td> <td>  ' + value.tipe_nilai +
                            '  <label class="" id="idnilai" hidden>' + value
                            .id +
                            '</label> </td><td> <input type="number" min="1" max="4" class="form-control" id="nilai" name="nilai" value="' +
                            value.nilai +
                            '"> </td><td>  </td><td><button type="button" class="btn btn-primary tombolUpdateNilaiSikap" id="' +
                            value.id_user + '" data-id="' + value
                            .id_user +
                            '" value="' + value.id_user +
                            '"> Update</button><button type="button" class="btn btn-danger tombolKonfirmasiDelete ml-2" id="' +
                            value.id + '" data-id="' + value
                            .id +
                            '" value="' + value.id +
                            '"> </i>Delete</button></td></tr>';
                    });
                    $('#modal_nilai tbody').html(markup);
                    $('#modalEditNilai').modal('show');
                }
            });
        });

        $(document).on('click', '.tombolEditNilaiKeterampilan', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            $('#id_siswa_modal').val(id);
            $.ajax({
                url: "/getnilai",
                type: "get",
                data: {
                    'id_user_siswa': id,
                    'id_mata_pelajaran': $('#id_matapelajaran').html(),
                    'tahun_ajaran': $('#tahunAjaran').html(),
                    'semester': $('#semester').html(),
                    'id_kategori': $('#kategori_keterampilan').html(),
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;

                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr> <td> ' + no_tabel +
                            ' </td> <td>  ' + value.tipe_nilai +
                            '  <label class="" id="idnilai" hidden>' + value
                            .id +
                            '</label> </td><td> <input type="number" min="1" max="5" class="form-control" id="nilai" name="nilai" value="' +
                            value.nilai +
                            '"> </td><td>  </td><td><button type="button" class="btn btn-primary tombolUpdateNilaiKeterampilan" id="' +
                            id + '" data-id="' +
                            id +
                            '" value="' + value.id_user +
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


        $('#pilih_kelas').on('click', function () {
            var nama_kelas = $('#students_class_name option:selected').val();
            if (nama_kelas) {
                $.ajax({
                    url: '/editnilai/' + nama_kelas,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var markup = '';
                        var markup2 = '';
                        var markup3 = '';
                        var no_tabel = 0;
                        $.each(data, function (key, value) {
                            no_tabel++;


                            markup += '<tr> <td> ' + no_tabel + ' </td> <td> ' +
                                value.id_user + ' </td><td> ' + value.nama_siswa +
                                ' </td><td> ' + value.nama_kelas +
                                ' </td><td><button type="button" class="btn btn-warning tombolEditNilaiPengetahuan" id="' +
                                value.id_user + '" data-id="' + value.id_user +
                                '" value="' + value.id_user +
                                '"> Edit</button></td></tr>';

                            markup2 += '<tr> <td> ' + no_tabel + ' </td> <td> ' +
                                value.id_user + ' </td><td> ' + value.nama_siswa +
                                ' </td><td> ' + value.nama_kelas +
                                ' </td><td><button type="button" class="btn btn-warning tombolEditNilaiSikap" id="' +
                                value.id_user + '" data-id="' + value.id_user +
                                '" value="' + value.id_user +
                                '"> Edit</button></td></tr>';

                            markup3 += '<tr> <td> ' + no_tabel + ' </td> <td> ' +
                                value.id_user + ' </td><td> ' + value.nama_siswa +
                                ' </td><td> ' + value.nama_kelas +
                                ' </td><td><button type="button" class="btn btn-warning tombolEditNilaiKeterampilan" id="' +
                                value.id_user + '" data-id="' + value.id_user +
                                '" value="' + value.id_user +
                                '"> Edit</button></td></tr>';
                        });
                        $('#edit_nilai_materi tbody').html(markup);
                        $('#edit_nilai_sikap tbody').html(markup2);
                        $('#edit_nilai_keterampilan tbody').html(markup3);
                    }
                });
            }
        });
        var nilai_id;
        $(document).on('click', '.tombolKonfirmasiDelete', function () {
            nilai_id = $(this).data('id');
            $('#tombolDeleteNilai').text('Delete');
            $('#konfirmasiDelete').modal('show');
        });

        $(document).on('click', '.tombolUpdateNilaiSikap', function () {
            // $('#modalEditNilai').modal('show');
            var nilai = $(this).closest('tr').find('input').val();
            if (nilai >= 1 && nilai <= 4) {
                $.ajax({
                    url: "/updatenilai",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id_siswa': $('#id_siswa_modal').val(),
                        'id_nilai': $(this).closest('tr').find('label').html(),
                        'nilai': $(this).closest('tr').find('input').val(),

                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#modalEditNilai').modal('hide');
                        // toastr.success('Data Presensi Berhasil Disimpan', 'Berhasil!');
                        alert('Data Presensi Berhasil Disimpan');

                    }
                });
            } else {
                alert('Silahkan masukkan angka 1 sampai 4');
            }

        });
        $(document).on('click', '.tombolUpdateNilai', function () {
            // $('#modalEditNilai').modal('show');
            var nilai = $(this).closest('tr').find('input').val();
            if (nilai >= 1 && nilai <= 100) {
                $.ajax({
                    url: "/updatenilai",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id_siswa': $('#id_siswa_modal').val(),
                        'id_nilai': $(this).closest('tr').find('label').html(),
                        'nilai': $(this).closest('tr').find('input').val(),

                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#modalEditNilai').modal('hide');
                        // toastr.success('Data Presensi Berhasil Disimpan', 'Berhasil!');
                        alert('Data Presensi Berhasil Diubah');

                    }
                });
            } else {
                alert('Silahkan isi angka 1 sampai 100!');
            }

        });

        $(document).on('click', '.tombolUpdateNilaiKeterampilan', function () {
            // $('#modalEditNilai').modal('show');
            var nilai = $(this).closest('tr').find('input').val();
            if (nilai >= 1 && nilai <= 5) {
                $.ajax({
                    url: "/updatenilai",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id_siswa': $('#id_siswa_modal').val(),
                        'id_nilai': $(this).closest('tr').find('label').html(),
                        'nilai': $(this).closest('tr').find('input').val(),

                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#modalEditNilai').modal('hide');
                        // toastr.success('Data Presensi Berhasil Disimpan', 'Berhasil!');
                        alert('Data Presensi Berhasil Diubah');

                    }
                });
            } else {
                alert('Silahkan isi angka 1 sampai 5!');
            }

        });

        $(document).on('click', '#tombolDeleteNilai', function () {
            // $('#modalEditNilai').modal('show');
            var $button = $(this);
            // var table = $('#modal_nilai').DataTable();
            $.ajax({
                url: "/deleteNilaiSekolah/" + nilai_id,
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    $('#tombolDeleteNilai').text('Deleting...');
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#modalEditNilai').modal('hide');
                        $('#konfirmasiDelete').modal('hide');
                        // table.row( $button.closest('tr').find('label') ).remove().draw();

                        alert('Data Nilai Berhasil didelete');
                    }, 2000);

                }
            });
        });
    })

</script>
@endsection
