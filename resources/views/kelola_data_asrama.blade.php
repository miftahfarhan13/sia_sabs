@extends('layouts.app_sidebar')

@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
</script>

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

<head>
    <title>Kelola Data Asrama</title>
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
    <h4 class="font-weight-bold"><i class="fa fa-edit mr-4"></i>Kelola Data Asrama</h4>
    <hr>
    <div class="row  mt-2">
        <div class="col">
            <ul class="nav nav-tabs" id="myTabPendaftaran" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="kegiatanasrama-tab" data-toggle="tab" href="#dataKegiatanAsrama"
                        role="tab" aria-controls="Penilaian Materi" aria-selected="true">Data Kegiatan Asrama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="datagedung-tab" data-toggle="tab" href="#dataGedungSiswa" role="tab"
                        aria-controls="Penilaian Sikap" aria-selected="false">Data Gedung Siswa</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane show active fade" id="dataKegiatanAsrama" role="tabpanel"
                    aria-labelledby="matapelajaran-tab">
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <div class="card">
                                    <div class="card-header font-weight-bold">Tambah Kegiatan Asrama<button
                                            id="simpanJadwalMataPelajaran" type="button"
                                            class="btn btn-primary simpanKegiatanAsrama"
                                            style="float:right;">Simpan</button>
                                    </div>

                                    <div class="card-body">
                                        <div class="alert alert-primary col-sm-12" role="alert">
                                            Silahkan isi data kegiatan asrama!

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Pengajar</label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" id="nama_guru_asrama"
                                                    name="nama_guru_asrama">
                                                    <option selected disabled>Pilih Guru</option>
                                                    @foreach ($guruasrama as $index => $guruasramas)
                                                    <option value="{{ $guruasramas->nik_guruasrama }}">
                                                        {{ $guruasramas->nama_guru_asrama }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Pilih Kelas</label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" id="kode_kelas_asrama"
                                                    name="kode_kelas_asrama">
                                                    <option selected disabled>Pilih Kelas</option>
                                                    @foreach ($kelas as $index => $kelass)
                                                    <option value="{{ $kelass->kode_kelas_asrama }}">
                                                        {{ $kelass->nama_sub_kelas }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Nama
                                                Kegiatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama_kegiatan"
                                                    name="nama_kegiatan" placeholder="Isi nama kegiatan">

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Tempat
                                                Kegiatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama_tempat_kegiatan"
                                                    name="nama_tempat_kegiatan" placeholder="Isi nama tempat">

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Tanggal</label>
                                            <div class="input-group date col-sm-8" id="datetimepicker1"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker1" id="pilih_tanggal_kegiatan"
                                                    placeholder="Pilih Tanggal" />
                                                <div class="input-group-append" data-target="#datetimepicker1"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Jam</label>
                                            <div class="input-group date col-sm-8" id="datetimepicker3"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker3" id="pilih_jam_kegiatan"
                                                    placeholder="Pilih Jam" />
                                                <div class="input-group-append" data-target="#datetimepicker3"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="card">
                                    <div class="card-header font-weight-bold">Tambah Materi Asrama<button
                                            id="simpanMataPelajaran" type="button"
                                            class="btn btn-primary simpanMateriAsrama"
                                            style="float:right;">Simpan</button>
                                    </div>

                                    <div class="card-body">
                                        <div class="alert alert-primary col-sm-12" role="alert">
                                            Silahkan isi data materi asrama!
                                            <br>Silahkan isi kode materi dengan format berikut : ASA - tiga
                                            digit
                                            kode mapel
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Kode Materi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="kode_materi_asrama"
                                                    name="kode_materi_asrama" value="ASA - "
                                                    placeholder="Kode Materi Asrama">
                                            </div>
                                        </div>

                                        <div class="form-group row">


                                            <label class="col-sm-3 col-form-label font-weight-bold">Nama Materi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama_materi_asrama"
                                                    name="nama_materi_asrama" placeholder="Nama Materi Asrama">
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Pilih Kelas</label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" id="kode_kelas_asrama_materi"
                                                    name="kode_kelas_asrama_materi">
                                                    <option selected disabled>Pilih Kelas</option>
                                                    @foreach ($kelas as $index => $kelass)
                                                    <option value="{{ $kelass->kode_kelas_asrama }}">
                                                        {{ $kelass->nama_sub_kelas }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label font-weight-bold">Pilih
                                                Kategori</label>
                                            <div class="col-sm-8">
                                                <select class="custom-select" id="kategori_materi"
                                                    name="kategori_materi">
                                                    <option selected disabled>Pilih kategori</option>
                                                    <option value="Materi Pokok">Materi Pokok</option>
                                                    <option value="Pemahaman Konsep dan Praktikum">Pemahaman Konsep dan
                                                        Praktikum</option>
                                                    <option value="Sikap dan Perilaku">Sikap dan Perilaku</option>
                                                    <option value="Kegiatan Ekstrakulikuler/Pengembangan Diri">Kegiatan
                                                        Ekstrakulikuler/Pengembangan Diri</option>

                                                </select>
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
                                    <div class="card-header font-weight-bold">Hapus Kegiatan Asrama</div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 font-weight-bold">Pilih Tanggal</label>
                                            <div class="input-group date col-sm-3" id="datetimepicker4"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker4" id="pilih_tanggal_kegiatan_hapus"
                                                    placeholder="Pilih Tanggal" data-toggle="datetimepicker" />
                                                <div class="input-group-append">
                                                    <button id="pilih_tanggal" class="btn btn-primary"
                                                        type="button">Pilih</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-primary col-sm-12" role="alert">
                                            Anda dapat memilih tanggal untuk memudahkan pencarian!
                                        </div>
                                        <table class="table table-striped" id="hapus_mata_pelajaran_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Jam</th>
                                                    <th scope="col">Nama Guru</th>
                                                    <th scope="col">Kelas</th>
                                                    <th scope="col">Nama Kegiatan</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kegiatanasrama as $index => $kegiatanasramas)
                                                <tr>
                                                    <th scope="row">{{$index+1}}</th>
                                                    <td>{{ $kegiatanasramas->tanggal }}</td>
                                                    <td>{{ $kegiatanasramas->jam }}</td>
                                                    <td>{{ $kegiatanasramas->nama_guru_asrama }}</td>
                                                    <td>{{ $kegiatanasramas->nama_sub_kelas }}</td>
                                                    <td>{{ $kegiatanasramas->nama_kegiatan }}</td>
                                                    <td> <button id="{{ $kegiatanasramas->id }}"
                                                            name="{{ $kegiatanasramas->id }}"
                                                            data-id="{{ $kegiatanasramas->id }}" type="button"
                                                            class="btn btn-danger right tombolDeleteKegiatanAsrama">Delete</button>
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

                <div class="tab-pane fade" id="dataGedungSiswa" role="tabpanel" aria-labelledby="kelas-tab">
                    <div class="mt-2">
                        <div class="form-row mt-2">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header font-weight-bold">Ubah Gedung Siswa</div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label font-weight-bold">Gedung</label>
                                            <div class="input-group col-sm-3">
                                                <select class="custom-select" id="pilih_gedung_edit" name="gedung">
                                                    <option selected disabled>Pilih Gedung</option>
                                                    @foreach ($gedung as $index => $gedungs)
                                                    <option value="{{ $gedungs->kode_gedung }}">
                                                        {{ $gedungs->nama_gedung }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button id="tombol_pilih_gedung_edit"
                                                        class="btn btn-primary pilih_gedung_edit"
                                                        type="button">Pilih</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="alert alert-primary col-sm-12" role="alert">
                                            Anda dapat mencari nama siswa pada kolom Search berikut!
                                            <br>Silahkan refresh halaman jika sudah selesai mengubah gedung siswa!
                                        </div>
                                        <table class="table table-striped" id="edit_gedung_siswa">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Id Siswa</th>
                                                    <th scope="col">Nama Siswa</th>
                                                    <th scope="col">Gedung</th>
                                                    <th scope="col">Ganti Gedung</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($siswa as $index => $siswas)
                                                <tr>
                                                    <th scope="row">{{$index+1}}</th>
                                                    <td scope="row"><label class="id_user"
                                                            id="id_user">{{ $siswas->id_siswa }}</label>
                                                    </td>
                                                    <td scope="row">{{ $siswas->nama_siswa }}</td>
                                                    <td scope="row">{{ $siswas->nama_gedung }}</td>
                                                    <td scope="row"><select class="custom-select nama_gedung_edit"
                                                            id="nama_gedung_edit" name="">
                                                            @foreach ($gedung as $index => $gedungs)
                                                            <option value="{{ $gedungs->kode_gedung }}">
                                                                {{ $gedungs->nama_gedung }}
                                                            </option>
                                                            @endforeach
                                                        </select></td>
                                                    <td scope="row"> <button id="{{ $siswas->id_siswa }}"
                                                            name="{{ $siswas->id_siswa }}"
                                                            data-id="{{ $siswas->id_siswa }}" type="button"
                                                            class="btn btn-primary right tombolUpdateGedung">Update</button>
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
    $(function () {
        $('#datetimepicker4').datetimepicker({
            format: 'L',
            format: 'YYYY-MM-DD'
        });
    });

</script>
<script>
    var jadwal_id;
    $(document).on('click', '.tombolDeleteKegiatanAsrama', function () {
        jadwal_id = $(this).data('id');
        $('#konfirmasiDelete').modal('show');
    });

    $(document).on('click', '#tombolDeleteNilai', function () {
        // $('#modalEditNilai').modal('show');
        var $button = $(this);
        $.ajax({
            url: "/delete_kegiatan_asrama/" + jadwal_id,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('#tombolDeleteNilai').text('Deleting...');
            },
            success: function (data) {
                setTimeout(function () {
                    alert('Data Kegiatan Asrama Berhasil Didelete');
                    window.location.href = "/kelola_data_asrama";
                }, 2000);

            }
        });
    });

    $(document).on('click', '.simpanMateriAsrama', function () {
        var kodemapel = $('#kode_mapel').val();
        var namamapel = $('#tambah_nama_mapel').val();
        console.log(namamapel);
        $.ajax({
            url: "/store_materi_asrama",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'kode_materi': $('#kode_materi_asrama').val(),
                'kode_kelas_asrama': $('#kode_kelas_asrama_materi option:selected').val(),
                'kategori_materi': $('#kategori_materi option:selected').val(),
                'nama_materi': $('#nama_materi_asrama').val(),
            },

            success: function (data) {
                var hasil = data;
                console.log(hasil);
                if (hasil == 'true') {
                    alert('Anda berhasil menambahkan materi asrama');
                    window.location.href = "/kelola_data_asrama";
                    // $('#modalPenilaianUTS').modal('toggle');
                } else {
                    alert('Data materi asrama sudah ada pada database!');
                }
                // window.location.href = "/penilaian_asrama";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Silahkan lengkapi data terlebih dahulu!');
            },
        });
    });


    $(document).on('click', '.simpanKegiatanAsrama', function () {
        $.ajax({
            url: "/store_kegiatan_asrama",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'id_user_guruasrama': $('#nama_guru_asrama option:selected').val(),
                'kode_kelas_asrama': $('#kode_kelas_asrama option:selected').val(),
                'nama_kegiatan': $('#nama_kegiatan').val(),
                'tanggal': $('#pilih_tanggal_kegiatan').val(),
                'nama_tempat': $('#nama_tempat_kegiatan').val(),
                'jam': $('#pilih_jam_kegiatan').val(),
            },

            success: function (data) {
                var hasil = data;
                console.log(hasil);
                if (hasil == 'true') {
                    alert(
                        'Anda berhasil menambahkan data kegiatan asrama'
                    );
                    window.location.href = "/kelola_data_asrama";
                    // $('#modalPenilaianUTS').modal('toggle');
                } else {
                    alert(
                        'Data kegiatan asrama sudah ada pada database!'
                    );
                }
                // window.location.href = "/penilaian_asrama";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Silahkan lengkapi data terlebih dahulu!');
            },
        });


    });

    $(document).on('click', '.tombolUpdateGedung', function () {
        var idsiswa = $(this).data('id');
        $.ajax({
            url: "/update_gedung_siswa",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'id_user_siswa': idsiswa,
                'kode_gedung': $(this).closest('tr').find('input,select').val(),
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

    $('#pilih_tanggal').on('click', function () {
        var tanggal = $('#pilih_tanggal_kegiatan_hapus').val();
        console.log(tanggal);
        if (tanggal != null) {
            $.ajax({
                url: '/get_kegiatan_asrama',
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
                            ' </td><td> ' + value.nama_guru_asrama +
                            ' </td><td> ' + value.nama_sub_kelas +
                            ' </td><td>' + value.nama_kegiatan + '<td><button id="' + value
                            .id +
                            '" data-id="' + value.id +
                            '" name="' + value.id +
                            '" type="button" class="btn btn-danger tombolDeleteKegiatanAsrama">Delete</button></td></tr>';

                    });
                    $('#hapus_mata_pelajaran_table tbody').html(markup);

                }
            });
        }
    });

    $('#tombol_pilih_gedung_edit').on('click', function () {
        var gedung = $('#pilih_gedung_edit option:selected').val();
        console.log(gedung);
        if (gedung != null) {
            $.ajax({
                url: '/get_gedung_siswa',
                type: "GET",
                dataType: "json",
                data: {
                    'gedung': gedung,

                },
                success: function (data) {
                    var markup = '';
                    var no_tabel = 0;
                    $.each(data, function (key, value) {
                        no_tabel++;


                        markup += '<tr> <td> ' + no_tabel +
                            ' </td> <td> <label class="id_user" id="id_user">' + value
                            .id_siswa + '</label> </td><td> ' + value.nama_siswa +
                            ' </td><td> ' + value.nama_gedung +
                            ' </td><td> <select class="custom-select nama_gedung_edit" id="nama_gedung_edit" name=""> @foreach ($gedung as $index => $gedungs) <option value="{{ $gedungs->kode_gedung }}"> {{ $gedungs->nama_gedung }}</option> @endforeach </select> </td><td><button id="' + value
                            .id_siswa +
                            '" data-id="' + value.id_siswa +
                            '" name="' + value.id_siswa +
                            '" type="button" class="btn btn-primary tombolUpdateGedung">Update</button></td></tr>';
                        
                    });
                    $('#edit_gedung_siswa tbody').html(markup);

                }
            });
        }
    });

</script>

@endsection
