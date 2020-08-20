@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Presensi Sekolah</title>
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
    <h4 class="font-weight-bold"><i class="fa fa-chart-pie mr-4"></i>Presensi Sekolah</h4>
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
                <label class="col-sm-2 col-form-label font-weight-bold">Tanggal</label>
                <div class="col-sm-10">

                    <label class="col-form-label" id='tanggal'><?php $tgl=date('l, d-m-Y'); echo $tgl;?></label>

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
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
        <div class="mt-2">
            <div class="card text-black">
                <div class="card-header font-weight-bold ">Tambah Presensi Siswa </div>
                <div class="card-body">
                    <table id="presensi_sekolah" class="table table-striped">
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
                            <!-- ini isinya data -->
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                    <button id="simpanPresensi" name="simpanPresensi" type="button" class="btn btn-primary right "
                        style="float:right; display:none">Simpan</button>
                </div>

            </div>

        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
        <div class="mt-2">
            <div class="card">
                <div class="card-header font-weight-bold">Daftar Sakit Hari Ini</div>
                <div class="card-body">
                    <table class="table table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Penanggung Jawab</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarsakit as $index => $daftarsakits)
                            <tr>
                                <th data-header="No" scope="row">{{$index+1}}</th>
                                <td data-header="Nama Siswa">{{ $daftarsakits->nama_siswa }}</td>
                                <td data-header="Keterangan">{{ $daftarsakits->keterangan }}</td>
                                <td data-header="Penanggung Jawab">{{ $daftarsakits->nama_guru_asrama }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="editPenilaianMateri" role="tabpanel" aria-labelledby="materi-tab">
        <div class="mt-2">
            <div class="card">
                <div class="card-header font-weight-bold">Edit Presensi Siswa </div>

                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        Pastikan data presensi siswa untuk hari ini benar! Data presensi siswa tidak dapat diubah
                        jika sudah melewati hari ini!
                    </div>
                    <table id="edit_presensi_sekolah" class="table table-striped">
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
                            @foreach ($daftarpresensi as $index => $daftarpresensis)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td><label class="id_user" id="id_user">{{ $daftarpresensis->id_siswa }}</label>
                                </td>
                                <td>{{ $daftarpresensis->nama_siswa }}</td>
                                <td>{{ $daftarpresensis->kelas }}</td>
                                <td><select class="custom-select keteranganEdit" id="keteranganEdit" name="">
                                        <option selected disabled>{{ $daftarpresensis->keterangan }}</option>
                                        <option value="Hadir">Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Alpha">Alpha</option>
                                    </select></td>
                                <td> <button id="{{ $daftarpresensis->id_siswa }}"
                                        name="{{ $daftarpresensis->id_siswa }}" type="button"
                                        class="btn btn-primary right tombolUpdatePresensi">Update</button></td>

                            </tr>
                            @endforeach
                            <!-- ini isinya data -->
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>
</div>


<script>
    $(document).ready(function () {

        $('#pilih_kelas').on('click', function () {
            var nama_kelas = $('#students_class_name option:selected').val();
            var hari = $('#tanggal').html();
            if (hari.includes("Saturday") || hari.includes("Sunday") || hari.includes("Sabtu") || hari
                .includes("Saturday")) {
                alert('Hari ini hari libur, tidak dapat menambahkan data presensi!');
            } else {
                $.ajax({
                    url: '/get_data_presensi_sekolah/' + nama_kelas,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data > 0) {
                            alert(
                                'Data presensi untuk kelas ini sudah diisi. Untuk mengubah presensi silahkan ubah pada tabel Edit Presensi Siswa!'
                            );
                        } else {
                            $.ajax({
                                url: '/presensi/' + nama_kelas,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    var markup = '';
                                    var markup2 = '';
                                    var idoption = '';
                                    var no_tabel = 0;
                                    $.each(data, function (key, value) {

                                        no_tabel++;
                                        idoption = "keterangan" +
                                            no_tabel;
                                        markup += '<tr> <td> ' +
                                            no_tabel +
                                            ' </td> <td> <label class="id_user_siswa" id="id_user_siswa" >' +
                                            value.id_user +
                                            '</label> </td><td> ' +
                                            value
                                            .nama_siswa +
                                            ' </td><td> <label class="nama_kelas" id="nama_kelas" >' +
                                            value.nama_kelas +
                                            '</label> </td><td><select class="custom-select keterangan" id="keterangan" name=""><option selected disabled value="Pilih Keterangan">Pilih Keterangan</option><option value="Hadir">Hadir</option><option value="Sakit">Sakit</option><option value="Izin">Izin</option><option value="Alpha">Alpha</option></select></td></tr>';

                                    });

                                    $("#simpanPresensi").css("display", "show");
                                    $("#simpanPresensi").show();
                                    $('#presensi_sekolah tbody').html(markup);
                                }

                            });
                        }
                    }

                });
            }

        });
        $('#simpanPresensi').on('click', function () {
            var nama_kelas = $('#students_class_name option:selected').val();
            var id = $(this).data('id');
            var idsiswa = new Array();
            var namakelas = new Array();
            var keteranganpresensis = new Array();

            $('.id_user_siswa').each(function () {
                idsiswa.push($(this).html());
            });
            $('.nama_kelas').each(function () {
                namakelas.push($(this).html());
            });
            $('.keterangan').each(function () {
                if ($(this).val() != null) {
                    keteranganpresensis.push($(this).val());
                }
            });
            // console.dir(idsiswa);
            $.ajax({
                url: '/simpan_presensi/' + nama_kelas,
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id_user_siswa': idsiswa,
                    'nama_kelas': namakelas,
                    'keterangan': keteranganpresensis,
                },
                success: function (data) {
                    console.log(data);
                    if (data == 'true') {
                        alert('Data presensi berhasil disimpan!');
                        window.location.replace("/presensi_sekolah");
                    } else {
                        alert('Silahkan isi semua data');
                    }
                }
            });
        });

        $(document).on('click', '.tombolUpdatePresensi', function () {
            // $('#modalEditNilai').modal('show');
            var id = $(this).data('id');
            var idsiswa = $(this).closest('tr').find('label').html()
            $.ajax({
                url: "/updatePresensiSekolah",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id_user_siswa': idsiswa,
                    'keterangan': $(this).closest('tr').find('input,select').val(),
                },
                dataType: 'json',
                success: function (data) {
                    alert('Data Presensi Berhasil diubah');

                }
            });
        });
    })

</script>

@endsection
