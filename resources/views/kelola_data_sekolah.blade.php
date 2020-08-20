@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Kelola Data Sekolah</title>
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
    <h4 class="font-weight-bold"><i class="fa fa-edit mr-4"></i>Kelola Data Sekolah</h4>
    <hr>
    <div class="row  mt-2">
        <div class="col">
            <ul class="nav nav-tabs" id="myTabPendaftaran" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="matapelajaran-tab" data-toggle="tab" href="#dataMataPelajaran"
                        role="tab" aria-controls="Penilaian Materi" aria-selected="true">Data Mata Pelajaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="kelas-tab" data-toggle="tab" href="#dataKelasSiswa" role="tab"
                        aria-controls="Penilaian Sikap" aria-selected="false">Data Kelas Siswa</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane show active fade" id="dataMataPelajaran" role="tabpanel"
                    aria-labelledby="matapelajaran-tab">
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header font-weight-bold">Tambah Jadwal Mata Pelajaran<button
                                            id="simpanJadwalMataPelajaran" type="button"
                                            class="btn btn-primary simpanJadwalMataPelajaran"
                                            style="float:right;">Simpan</button>
                                    </div>

                                    <div class="card-body">
                                        <div class="alert alert-primary col-sm-12" role="alert">
                                            Silahkan isi data jadwal mata pelajaran!
                                            <br>Jadwal akan ditambahkan pada tahun ajaran yang aktif. Jika ingin
                                            mengubah tahun ajaran silahkan pilih menu Kelola Tahun Ajaran!
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Kelas</label>
                                            <div class="col-sm-8">

                                                <select class="custom-select" id="kode_kelas" name="kode_kelas">
                                                    <option selected disabled>Pilih Kelas</option>
                                                    @foreach ($kelas as $index => $kelass)
                                                    <option value="{{ $kelass->kode_kelas }}">{{ $kelass->nama_kelas }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Nama Guru</label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" id="nama_guru" name="nama_guru">
                                                    <option selected disabled>Pilih Guru</option>
                                                    @foreach ($gurusekolah as $index => $gurusekolahs)
                                                    <option value="{{ $gurusekolahs->id_user }}"
                                                        data-idmapel="{{ $gurusekolahs->id_mata_pelajaran }}">
                                                        {{ $gurusekolahs->nama_guru_sekolah }} - Mata Pelajaran :
                                                        {{ $gurusekolahs->nama_mata_pelajaran }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Hari</label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" id="hari" name="hari">
                                                    <option selected disabled>Pilih Hari</option>
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Jam</label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" id="jam" name="jam">
                                                    <option selected disabled>Pilih Jam</option>
                                                    <option value="08.00 - 09.30">08.00 - 09.30</option>
                                                    <option value="09.30 - 10.00">09.30 - 10.00</option>
                                                    <option value="10.00 - 11.30">10.00 - 11.30</option>
                                                    <option value="11.30 - 12.30">11.30 - 12.30</option>
                                                </select>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header font-weight-bold">Tambah Mata Pelajaran<button
                                            id="simpanMataPelajaran" type="button"
                                            class="btn btn-primary simpanMataPelajaran"
                                            style="float:right;">Simpan</button>
                                    </div>

                                    <div class="card-body">
                                        <div class="alert alert-primary col-sm-12" role="alert">
                                            Silahkan isi data mata pelajaran!
                                            <br>Silahkan isi kode mata pelajaran dengan format berikut : SIA - tiga
                                            digit
                                            kode mapel
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label font-weight-bold">Kode Mapel</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="kode_mapel"
                                                    name="kode_mapel" value="SIA - " placeholder="Kode Mata Pelajaran">
                                            </div>

                                            <label class="col-sm-3 col-form-label font-weight-bold">Nama Mapel</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="tambah_nama_mapel"
                                                    name="tambah_nama_mapel" placeholder="Nama Mata Pelajaran">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row mt-2">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header font-weight-bold">Hapus Jadwal Mata Pelajaran</div>
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 font-weight-bold">Pilih Kelas</label>
                                            <div class="input-group col-sm-3">
                                                <select class="custom-select" id="hapus_kode_kelas"
                                                    name="hapus_kode_kelas">
                                                    <option selected disabled>Pilih Kelas</option>
                                                    @foreach ($kelas as $index => $kelass)
                                                    <option value="{{ $kelass->kode_kelas }}">{{ $kelass->nama_kelas }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                <div class="input-group-append">
                                                    <button id="pilih_kelas_hapus"
                                                        class="btn btn-primary pilih_kelas_hapus"
                                                        type="button">Pilih</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-primary col-sm-12" role="alert">
                                            Silahkan pilih kelas terlebih dahulu!
                                        </div>
                                        <table class="table table-striped" id="hapus_mata_pelajaran_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kelas</th>
                                                    <th scope="col">Nama Guru</th>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col">Hari</th>
                                                    <th scope="col">Jam</th>
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

                <div class="tab-pane fade" id="dataKelasSiswa" role="tabpanel" aria-labelledby="kelas-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Tambah Kelas<button id="simpanKelas" type="button"
                                    class="btn btn-primary simpanKelas" style="float:right;">Simpan</button>
                            </div>

                            <div class="card-body">
                                <div class="alert alert-primary col-sm-12" role="alert">
                                    Silahkan isi nama kelas!
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">Nama Kelas</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="tambah_nama_kelas"
                                            name="tambah_nama_kelas" placeholder="Nama Kelas">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-row mt-2">
                            <div class="col mt-2">
                                <div class="card">
                                    <div class="card-header font-weight-bold">Tambah Kelas Siswa<button
                                            id="simpanTambahKelas" type="button"
                                            class="btn btn-primary simpanTambahKelas"
                                            style="float:right;">Simpan</button></div>
                                    <div class="card-body">
                                        <!-- <div class="form-group row">
                                            <label class="col-form-label col-sm-2 font-weight-bold">Pilih Kelas</label>
                                            <div class="input-group col-sm-3">
                                                <select class="custom-select" id="students_class_name"
                                                    name="students_class_name">
                                                    @foreach ($kelas as $kelass)
                                                    <option value="{{ $kelass->kode_kelas }}">
                                                        {{ $kelass->nama_kelas }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button id="pilih_kelas" class="btn btn-primary"
                                                        type="button">Pilih</button>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="alert alert-primary col-sm-12" role="alert">
                                            Silahkan tambah siswa yang belum mendapatkan kelas!
                                        </div>
                                        <table class="table table-striped" id="ubah_kelas_siswa">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Id Siswa</th>
                                                    <th scope="col">Nama Siswa</th>
                                                    <th scope="col">Pilih Kelas</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tambahsiswa as $index => $tambahsiswas)
                                                <tr>
                                                    <th scope="row">{{$index+1}}</th>
                                                    <td><label class="id_siswa_tambah"
                                                            id="id_siswa_tambah">{{ $tambahsiswas->id_siswa }}</label>
                                                    </td>
                                                    <td>{{ $tambahsiswas->nama_siswa }}</td>
                                                    <td><select class="custom-select kode_tambah_kelas"
                                                            id="kode_tambah_kelas" name="">
                                                            <option disabled selected value="Pilih Kelas">
                                                                Pilih Kelas
                                                            </option>
                                                            @foreach ($kelas as $index => $kelass)
                                                            <option value="{{ $kelass->kode_kelas }}">
                                                                {{ $kelass->nama_kelas }}
                                                            </option>
                                                            @endforeach
                                                        </select></td>
                                                    <!-- <td> <button id="{{ $tambahsiswas->id_siswa }}"
                                                            name="{{ $tambahsiswas->id_siswa }}"
                                                            data-id="{{ $tambahsiswas->id_siswa }}" type="button"
                                                            class="btn btn-primary right tombolUpdateKelas">Update</button>
                                                    </td> -->

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row mt-2">
                            <div class="col mt-2">
                                <div class="card">
                                    <div class="card-header font-weight-bold">Ubah Kelas Siswa</div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 font-weight-bold">Pilih Kelas</label>
                                            <div class="input-group col-sm-3">
                                                <select class="custom-select" id="students_class_name"
                                                    name="students_class_name">
                                                    @foreach ($kelas as $kelass)
                                                    <option value="{{ $kelass->kode_kelas }}">
                                                        {{ $kelass->nama_kelas }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button id="pilih_kelas" class="btn btn-primary"
                                                        type="button">Pilih</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-primary col-sm-12" role="alert">
                                            Untuk memudahkan pencarian silahkan pilih kelas terlebih dahulu!
                                            <br>Silahkan refresh halaman jika sudah selesai mengubah kelas siswa!
                                        </div>
                                        <table class="table table-striped" id="ubah_kelas_siswa">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Id Siswa</th>
                                                    <th scope="col">Nama Siswa</th>
                                                    <th scope="col">Kelas</th>
                                                    <th scope="col">Ganti Kelas</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($siswa as $index => $siswas)
                                                <tr>
                                                    <th scope="row">{{$index+1}}</th>
                                                    <td><label class="id_user"
                                                            id="id_user">{{ $siswas->id_siswa }}</label>
                                                    </td>
                                                    <td>{{ $siswas->nama_siswa }}</td>
                                                    <td>{{ $siswas->nama_kelas }}</td>
                                                    <td><select class="custom-select nama_kelas_edit"
                                                            id="nama_kelas_edit" name="">
                                                            @foreach ($kelas as $index => $kelass)
                                                            <option value="{{ $kelass->kode_kelas }}">
                                                                {{ $kelass->nama_kelas }}
                                                            </option>
                                                            @endforeach
                                                        </select></td>
                                                    <td> <button id="{{ $siswas->id_siswa }}"
                                                            name="{{ $siswas->id_siswa }}"
                                                            data-id="{{ $siswas->id_siswa }}" type="button"
                                                            class="btn btn-primary right tombolUpdateKelas">Update</button>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="konfirmasiDelete" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>
</div>
<script>
    $('#pilih_kelas_hapus').on('click', function () {
        var nama_kelas = $('#hapus_kode_kelas option:selected').val();
        if (nama_kelas) {
            $.ajax({
                url: '/get_mata_pelajaran/' + nama_kelas,
                type: "GET",
                dataType: "json",
                success: function (data) {

                    var markup = '';
                    var no_tabel = 0;
                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr> <td> ' + no_tabel + ' </td> <td> ' +
                            value.nama_kelas + ' </td><td> ' + value.nama_guru_sekolah +
                            ' </td><td> ' + value.nama_mata_pelajaran +
                            ' </td><td> ' + value.hari +
                            ' </td><td> ' + value.jam +
                            ' </td><td><button type="button" class="btn btn-danger tombolDeleteJadwal" id="' +
                            value.id + '" data-id="' + value.id +
                            '" value="' + value.id +
                            '">Delete</button></td></tr>';


                    });
                    $('#hapus_mata_pelajaran_table tbody').html(markup);

                }
            });
        }
    });

    var jadwal_id;
    $(document).on('click', '.tombolDeleteJadwal', function () {
        jadwal_id = $(this).data('id');
        $('#konfirmasiDelete').modal('show');
    });

    $(document).on('click', '#tombolDeleteNilai', function () {
        // $('#modalEditNilai').modal('show');
        var $button = $(this);
        $.ajax({
            url: "/delete_jadwal/" + jadwal_id,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('#tombolDeleteNilai').text('Deleting...');
            },
            success: function (data) {
                setTimeout(function () {
                    alert('Data Jadwal Berhasil Didelete');
                    window.location.href = "/kelola_data_sekolah";
                }, 2000);

            }
        });
    });

    $(document).on('click', '.simpanMataPelajaran', function () {
        var kodemapel = $('#kode_mapel').val();
        var namamapel = $('#tambah_nama_mapel').val();
        console.log(namamapel);
        $.ajax({
            url: "/store_mata_pelajaran",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'kode_mapel': $('#kode_mapel').val(),
                'nama_mata_pelajaran': $('#tambah_nama_mapel').val(),
            },

            success: function (data) {
                var hasil = data;
                console.log(hasil);
                if (hasil == 'true') {
                    alert('Anda berhasil menambahkan tahun ajaran');
                    window.location.href = "/kelola_data_sekolah";
                    // $('#modalPenilaianUTS').modal('toggle');
                } else {
                    alert('Data tahun ajaran sudah ada pada database!');
                }
                // window.location.href = "/penilaian_asrama";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Silahkan lengkapi data terlebih dahulu!');
            },
        });
    });

    $(document).on('click', '.simpanKelas', function () {
        var namakelas = $('#tambah_nama_kelas').val();
        console.log(namakelas);
        $.ajax({
            url: "/store_tambah_kelas",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'nama_kelas': $('#tambah_nama_kelas').val(),

            },

            success: function (data) {
                var hasil = data;
                console.log(hasil);
                if (hasil == 'true') {
                    alert('Anda berhasil menambahkan kelas');
                    window.location.href = "/kelola_data_sekolah";
                    // $('#modalPenilaianUTS').modal('toggle');
                } else {
                    alert('Data kelas sudah ada pada database!');
                }
                // window.location.href = "/penilaian_asrama";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Silahkan lengkapi data terlebih dahulu!');
            },
        });
    });


    $(document).on('click', '.simpanJadwalMataPelajaran', function () {
        var id_guru = $('#nama_guru option:selected').val();
        var kodemapeldropdown;
        var namamapel = $('#tambah_nama_mapel').val();
        // var kodemapel = $(this).data('idmapel');
        $.ajax({
            url: "/get_kode_mapel",
            type: "get",

            data: {
                'id_gurusekolah': id_guru,
            },

            success: function (data) {
                $.each(data, function (key, value) {
                    kodemapeldropdown = value.id_mata_pelajaran;
                    console.log(value.id_mata_pelajaran);
                });
                $.ajax({
                    url: "/store_jadwal_mata_pelajaran",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: {
                        'kode_kelas': $('#kode_kelas option:selected').val(),
                        'id_gurusekolah': $('#nama_guru option:selected').val(),
                        'kode_mapel_jadwal': kodemapeldropdown,
                        'hari': $('#hari option:selected').val(),
                        'jam': $('#jam option:selected').val(),
                    },

                    success: function (data) {
                        var hasil = data;
                        console.log(hasil);
                        if (hasil == 'true') {
                            alert(
                                'Anda berhasil menambahkan data jadwal mata pelajaran'
                            );
                            window.location.href = "/kelola_data_sekolah";
                            // $('#modalPenilaianUTS').modal('toggle');
                        } else {
                            alert(
                                'Data jadwal mata pelajaran sudah ada pada database!'
                            );
                        }
                        // window.location.href = "/penilaian_asrama";
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert('Silahkan lengkapi data terlebih dahulu!');
                    },
                });
            },
        });


    });

    $(document).on('click', '.tombolUpdateKelas', function () {
        var idsiswa = $(this).data('id');
        $.ajax({
            url: "/update_kelas_siswa",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'id_user_siswa': idsiswa,
                'kode_kelas': $(this).closest('tr').find('input,select').val(),
            },

            success: function (data) {
                var hasil = data;
                console.log(hasil);
                if (hasil == 'true') {
                    alert('Anda berhasil mengubah kelas siswa');
                    // window.location.href = "/kelola_data_sekolah";
                    // $('#modalPenilaianUTS').modal('toggle');
                }
                // window.location.href = "/penilaian_asrama";
            },

        });
    });

    $('#pilih_kelas').on('click', function () {
        var nama_kelas = $('#students_class_name option:selected').val();
        if (nama_kelas) {
            $.ajax({
                url: '/get_data_kelas_siswa',
                type: "GET",
                dataType: "json",
                data: {
                    'kode_kelas': nama_kelas,

                },
                success: function (data) {

                    var markup = '';

                    var no_tabel = 0;
                    $.each(data, function (key, value) {
                        no_tabel++;
                        markup += '<tr> <td> ' + no_tabel +
                            ' </td> <td> <label class="id_user" id="id_user">' + value
                            .id_siswa + '</label> </td><td> ' + value.nama_siswa +
                            ' </td><td> ' + value.nama_kelas +
                            ' </td><td><select class="custom-select nama_kelas_edit" id="nama_kelas_edit" name=""> @foreach ($kelas as $index => $kelass) <option value="{{ $kelass->kode_kelas }}"> {{ $kelass->nama_kelas }} </option> @endforeach </select></td><td><button id="' +
                            value.id_siswa + '" name="' + value.id_siswa + '" data-id="' +
                            value.id_siswa +
                            '" type="button" class="btn btn-primary right tombolUpdateKelas">Update</button></td></tr>';

                    });
                    $('#ubah_kelas_siswa tbody').html(markup);

                }
            });
        }
    });

    $('#simpanTambahKelas').on('click', function () {
        var idsiswa = new Array();
        var kodekelas = new Array();


        $('.kode_tambah_kelas').each(function () {
            if ($(this).val() != null) {
                kodekelas.push($(this).val());
                $('.id_siswa_tambah').each(function () {
                    if ($(this).val() != null) {
                        idsiswa.push($(this).html());
                    }
                });
            }
        });
        // console.dir(idsiswa);
        $.ajax({
            url: '/store_tambah_kelas_siswa',
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id_siswa': idsiswa,
                'kode_kelas': kodekelas,
            },
            success: function (data) {
                console.log(data);
                if (data == 'true') {
                    alert('Data kelas berhasil disimpan!');
                    window.location.replace("/kelola_data_sekolah");
                    idsiswa = [];
                } else {
                    alert('Silahkan isi semua data');
                }
            }
        });
    });

</script>

@endsection
