@extends('layouts.app_sidebar')

@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
</script>

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

<head>
    <title>Presensi Asrama</title>
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
    <h4 class="font-weight-bold"><i class="fa fa-chart-pie mr-4"></i>Presensi Asrama</h4>
    <hr>
    <div class="row">
        <div class="col-sm">
            <div class="form-group row">
                <label class="font-weight-bold col-sm-2">Tahun Ajaran</label>
                <div class="col-sm-10">
                    @foreach ($tahunajaran as $tahunajarans)
                    <label class="col-form-label">{{ $tahunajarans->tahun_ajaran }}</label>
                    @endforeach
                </div>
                <label class="col-sm-2 font-weight-bold">Semester</label>
                <div class="col-sm-10">
                    @foreach ($tahunajaran as $tahunajaran)
                    <label class="col-form-label">{{ $tahunajarans->semester }}</label>
                    @endforeach
                </div>

                <label class="col-sm-2 font-weight-bold">Tanggal</label>
                <div class="col-sm-10">
                    <label class="col-form-label"><?php $tgl=date('l, d-m-Y'); echo $tgl;?></label>
                </div>
            </div>
        </div>

    </div>
    <div class="form-group row">
        <label class="col-sm-2 font-weight-bold">Pilih Tanggal</label>
        <div class="input-group date col-sm-3" id="datetimepicker1" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"
                id="pilih_tanggal_kegiatan" placeholder="Pilih Tanggal" data-toggle="datetimepicker" />
            <div class="input-group-append">
                <button id="pilih_tanggal" class="btn btn-primary" type="button">Pilih</button>
            </div>
        </div>
    </div>


    <div class="mt-2">
        <div class="card">
            <div class="card-header font-weight-bold">Tambah Presensi Siswa</div>

            <div class="card-body">
                <div class="alert alert-primary" role="alert">
                    Jika tidak memilih tanggal maka kegiatan yang ditampilkan adalah kegiatan hari ini!
                    <br>
                    Sebelum mengisi presensi siswa, silahkan pilih tanggal terlebih dahulu!
                </div>
                <table id="presensi_tabel" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Nama Kegiatan</th>
                            <th scope="col">Nama Tempat</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Tambah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan as $index => $kegiatans)
                        <tr>
                            <td scope="row">{{$index+1}}</td>
                            <td>{{ $kegiatans->tanggal }}</td>
                            <td>{{ $kegiatans->jam }}</td>
                            <td>{{ $kegiatans->nama_kegiatan }}</td>
                            <td>{{ $kegiatans->nama_tempat }}</td>
                            <td><label class="" id="nama_kelas">{{ $kegiatans->nama_kelas_asrama }}</label></td><label
                                class="" id="nama_kelas"></label>
                            <td><button id="{{ $kegiatans->id }}" data-id="{{ $kegiatans->id }}"
                                    data-kegiatan="{{ $kegiatans->nama_kegiatan }}"
                                    data-tanggal="{{ $kegiatans->tanggal }}" name="{{ $kegiatans->id }}" type="button"
                                    class="btn btn-primary tambahPresensi"><i
                                        class="fas fa-plus-square text-center mr-1"
                                        style="color: white"></i>Tambah</button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div class="card">
            <div class="card-header font-weight-bold">Edit Presensi Siswa</div>

            <div class="card-body">
                <div class="alert alert-primary" role="alert">
                    Data yang ditampilkan adalah data presensi yang sudah dimasukkan.
                    <br>
                    Jika tidak memilih tanggal maka kegiatan yang ditampilkan adalah kegiatan hari ini!
                    <br>
                    Sebelum mengisi presensi siswa, silahkan pilih tanggal terlebih dahulu!
                </div>
                <table id="edit_presensi_tabel" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Nama Kegiatan</th>
                            <th scope="col">Nama Tempat</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Tambah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($editkegiatan as $index => $editkegiatans)
                        <tr>
                            <td scope="row">{{$index+1}}</td>
                            <td>{{ $editkegiatans->tanggal }}</td>
                            <td>{{ $editkegiatans->jam }}</td>
                            <td>{{ $editkegiatans->nama_kegiatan }}</td>
                            <td>{{ $editkegiatans->nama_tempat }}</td>
                            <td><label class="" id="nama_kelas">{{ $editkegiatans->nama_kelas_asrama }}</label></td>
                            <label class="" id="nama_kelas"></label>
                            <td><button id="{{ $editkegiatans->id }}" data-id="{{ $editkegiatans->id }}"
                                    data-kegiatan="{{ $editkegiatans->nama_kegiatan }}"
                                    data-tanggal="{{ $editkegiatans->tanggal }}" name="{{ $editkegiatans->id }}"
                                    type="button" class="btn btn-warning editPresensi"> <i
                                        class="fas fa-edit text-center mr-1" style="color: black"></i>Edit</button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalTambahPresensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Presensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input hidden name="id_kegiatan" id="id_kegiatan">
                    <label class="col-form-label font-weight-bold">Anda akan menambahkan presensi pada :</label>
                    <div class="row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Tanggal</label>
                        <label class="col-sm-2 col-form-label" id="tanggal_modal"></label>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Nama Kegiatan</label>
                        <label class="col-sm-2 col-form-label" id="nama_kegiatan_modal"></label>
                    </div>

                    <div class="alert alert-warning" role="alert">
                        Pastikan data presensi yang anda isi benar!
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" name="id_kegiatan" id="id_kegiatan">
                                    <input type="hidden" name="kelas_asrama" id="kelas_asrama">
                                    <table class="table table-striped" id="modal_presensi">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="simpanPresensi" name="simpanPresensi" type="button"
                        class="btn btn-primary right simpanPresensi" style="float:right">Simpan</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditPresensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Presensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input hidden name="id_kegiatan" id="id_kegiatan">
                    <label class="col-form-label font-weight-bold">Anda akan mengubah data presensi siswa pada :</label>
                    <div class="row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Tanggal</label>
                        <label class="col-sm-2 col-form-label" id="tanggal_modal_edit"></label>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Nama Kegiatan</label>
                        <label class="col-sm-2 col-form-label" id="nama_kegiatan_modal_edit"></label>
                    </div>

                    <div class="alert alert-warning" role="alert">
                        Pastikan data presensi yang anda isi benar!
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" name="id_kegiatan" id="id_kegiatan">
                                    <input type="hidden" name="kelas_asrama" id="kelas_asrama">
                                    <table class="table table-striped" id="modal_presensi_edit">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="simpanPresensi" name="simpanPresensi" type="button"
                        class="btn btn-primary right simpanPresensi" style="float:right">Simpan</button>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'L',
            format: 'YYYY-MM-DD'
        });
    });

    $(function () {
        $('#datetimepicker3').datetimepicker({
            format: 'LT',
            use24hours: true,
            format: 'HH:mm'
        });
    });

</script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.tambahPresensi', function () {
            var id = $(this).data('id');
            var kegiatan = $(this).data('kegiatan');
            var tanggal = $(this).data('tanggal');
            var kelas = $(this).closest('tr').find('label').html();
            $('#tanggal_modal').html(tanggal);
            $('#nama_kegiatan_modal').html(kegiatan);
            $('#kelas_asrama').html(kelas);
            $('#id_kegiatan').val(id);
            console.log(id);
            $.ajax({
                url: "/get_data_presensi_count",
                type: "get",
                data: {
                    'id_kegiatan': id,
                },
                dataType: 'json',
                success: function (data) {
                    if (data > 0) {
                        alert(
                            'Data presensi sudah dimasukkan sebelumnya! Pilih tabel Edit Presensi untuk mengubah presensi siswa!'
                        );
                    } else {
                        $.ajax({
                            url: "/getDataSiswa",
                            type: "get",
                            data: {
                                'nama_kelas': kelas,
                            },
                            dataType: 'json',
                            success: function (data) {

                                var markup = '';
                                var no_tabel = 0;
                                var idkegiatan = id;
                                $.each(data, function (key, value) {
                                    no_tabel++;
                                    markup += '<tr> <td> ' + no_tabel +
                                        '<input hidden class="id_kegiatan" name="id_kegiatan" id="id_kegiatan" value="' +
                                        idkegiatan +
                                        '"> </td> <td><label class="id_siswa">' +
                                        value.id_user +
                                        '</label></td><td>' + value
                                        .nama_siswa +
                                        '</td><td><label class="nama_kelas" id="nama_kelas">' +
                                        value.nama_kelas_asrama +
                                        '</label></td> <td><select class="custom-select keteranganPresensi" id="keteranganPresensi" name=""> <option selected disabled>Pilih Keterangan</option> <option value="Hadir">Hadir</option> <option value="Sakit">Sakit</option><option value="Izin">Izin</option><option value="Alpha">Alpha</option> </select></td></tr>';
                                });

                                $('#modal_presensi tbody').html(markup);
                                $('#modalTambahPresensi').modal('show');
                            }
                        });
                    }
                }
            });
        });

        $(document).on('click', '.editPresensi', function () {
            var id = $(this).data('id');
            var kegiatan = $(this).data('kegiatan');
            var tanggal = $(this).data('tanggal');
            var kelas = $(this).closest('tr').find('label').html();
            $('#tanggal_modal_edit').html(tanggal);
            $('#nama_kegiatan_modal_edit').html(kegiatan);
            $('#kelas_asrama').html(kelas);
            $('#id_kegiatan').val(id);
            console.log(id);
            $.ajax({
                url: "/get_data_presensi",
                type: "get",
                data: {
                    'id_kegiatan': id,
                },
                dataType: 'json',
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;
                    var idkegiatan = id;
                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr> <td> ' + no_tabel +
                            '<label class="id_kegiatan" hidden id="id_kegiatan" >' +
                            value.id +
                            '</label></td> <td>' +
                            value.id_user_siswa +
                            '</td><td>' + value
                            .nama_siswa +
                            '</td><td>' +
                            value.nama_kelas_asrama +
                            '</td> <td><select class="custom-select keteranganEdit" id="keteranganEdit" name=""> <option selected disabled>' +
                            value.keterangan +
                            '</option><option value="Hadir">Hadir</option><option value="Sakit">Sakit</option><option value="Izin">Izin</option><option value="Alpha">Alpha</option></select></td><td><button id="" data-idkegiatan="' +
                            idkegiatan + '" data-iduser="' + value.id_user +
                            '" name="" type="button" class="btn btn-primary updatePresensi">Update</button></td></tr>';
                    });

                    $('#modal_presensi_edit tbody').html(markup);
                    $('#modalEditPresensi').modal('show');
                }
            });
        });

        $(document).on('click', '.updatePresensi', function () {
            // $('#modalEditNilai').modal('show');
            var idkegiatan = $(this).closest('tr').find('label').html()
            console.log($(this).closest('tr').find('input,select').val());
            $.ajax({
                url: "/updatePresensiAsrama",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': idkegiatan,
                    'keterangan': $(this).closest('tr').find('input,select').val(),
                },
                dataType: 'json',
                success: function (data) {
                    alert('Data Presensi Berhasil diubah');

                }
            });
        });

        $('#simpanPresensi').on('click', function () {
            var idsiswa = new Array();
            var idkegiatan = new Array();
            var keteranganpresensis = new Array();
            var namakelas = $('#kelas_asrama').html();
            $('.id_siswa').each(function () {
                if ($(this).val() != null) {
                    idsiswa.push($(this).html());
                }
            });
            $('.id_kegiatan').each(function () {
                idkegiatan.push($(this).val());
            });
            $('.keteranganPresensi').each(function () {
                if ($(this).val() != null) {
                    keteranganpresensis.push($(this).val());
                }
            });
            // console.dir(idsiswa);
            $.ajax({
                url: '/storePresensiAsrama',
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id_user_siswa': idsiswa,
                    'id_kegiatan': idkegiatan,
                    'nama_kelas': namakelas,
                    'keterangan': keteranganpresensis,
                },
                success: function (data) {
                    console.log(data);
                    if (data == 'true') {
                        alert('Data presensi berhasil disimpan!');
                        window.location.replace("/presensi_asrama");
                        idsiswa = [];
                    } else {
                        alert('Silahkan isi semua data');
                    }
                }
            });
        });

        $('#pilih_tanggal').on('click', function () {
            var tanggal = $('#pilih_tanggal_kegiatan').val();
            console.log(tanggal);
            if (tanggal != null) {
                $.ajax({
                    url: '/get_kegiatan',
                    type: "GET",
                    dataType: "json",
                    data: {
                    'tanggal': tanggal,
                    
                    },
                    success: function (data) {

                        var markup = '';
                        var no_tabel = 0;
                        $.each(data, function (key, value) {
                            no_tabel++;
                            markup += '<tr> <td> ' + no_tabel + ' </td> <td> ' +
                                value.tanggal + ' </td><td> ' + value.jam +
                                ' </td><td> ' + value.nama_kegiatan +
                                ' </td><td> ' + value.nama_tempat +
                                ' </td><td><label class="" id="nama_kelas">' + value.nama_kelas_asrama +
                                '</label><td><button id="' + value.id +
                                '" data-id="' + value.id +
                                '" data-kegiatan="' + value.nama_kegiatan +
                                '" data-tanggal="' + value.tanggal +
                                '" name="' + value.id +
                                '" type="button" class="btn btn-primary tambahPresensi"><i class="fas fa-plus-square text-center mr-1" style="color: white"></i>Tambah</button></td></tr>';
                            
                        });
                        $('#presensi_tabel tbody').html(markup);
                        
                    }
                });

                $.ajax({
                    url: '/get_kegiatan_edit',
                    type: "GET",
                    dataType: "json",
                    data: {
                    'tanggal': tanggal,
                    
                    },
                    success: function (data) {

                        var markup = '';
                        var no_tabel = 0;
                        $.each(data, function (key, value) {
                            no_tabel++;
                            markup += '<tr> <td> ' + no_tabel + ' </td> <td> ' +
                                value.tanggal + ' </td><td> ' + value.jam +
                                ' </td><td> ' + value.nama_kegiatan +
                                ' </td><td> ' + value.nama_tempat +
                                ' </td><td><label class="" id="nama_kelas">' + value.nama_kelas_asrama +
                                '</label><td><button id="' + value.id +
                                '" data-id="' + value.id +
                                '" data-kegiatan="' + value.nama_kegiatan +
                                '" data-tanggal="' + value.tanggal +
                                '" name="' + value.id +
                                '" type="button" class="btn btn-warning editPresensi"><i class="fas fa-edit text-center mr-1" style="color: black"></i>Edit</button></td></tr>';
                                
                        });
                        $('#edit_presensi_tabel tbody').html(markup);
                        
                    }
                });
            }
        });
    })

</script>
@endsection
