@extends('layouts.app_sidebar')
@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
</script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

<head>
    <title>Kelola Akun</title>
    <link rel="shortcut icon" href="img/group-6.png">
</head>
<div>
    <h4 class="font-weight-bold"><i class="fa fa-edit mr-4"></i>Kelola Akun</h4>
    <hr>
    <div class="form-row mt-3">
        <div class="col">
            <ul class="nav nav-tabs" id="myTabPendaftaran" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="siswa-tab" data-toggle="tab" href="#siswa" role="tab"
                        aria-controls="Penilaian Materi" aria-selected="true">Siswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="orangtua-tab" data-toggle="tab" href="#orangTua" role="tab"
                        aria-controls="Penilaian Sikap" aria-selected="false">Orang Tua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="gurusekolah-tab" data-toggle="tab" href="#guruSekolah" role="tab"
                        aria-controls="Penilaian Keterampilan" aria-selected="false">Guru Sekolah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="guruasrama-tab" data-toggle="tab" href="#guruAsrama" role="tab"
                        aria-controls="Penilaian Keterampilan" aria-selected="false">Guru Asrama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab"
                        aria-controls="Penilaian Keterampilan" aria-selected="false">Admin</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="siswa" role="tabpanel" aria-labelledby="siswa-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Tambah Akun Siswa <button id="simpanDataSiswa"
                                    type="button" class="btn btn-primary simpanDataSiswa"
                                    style="float:right;">Simpan</button></div>

                            <div class="card-body">
                                <div class="alert alert-primary col-sm-12" role="alert">
                                    Silahkan isi data siswa! Pastikan data adalah benar!
                                    <br>Sebelum menambah data siswa, silahkan tambah data orang tua siswa terlebih
                                    dahulu!
                                </div>
                                <input type="text" class="form-control" id="role" name="role" value="Siswa" hidden>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">NIK Siswa</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="id_user" name="id_user" value=""
                                            placeholder="NIK Siswa">
                                    </div>


                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Password Akun</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Ulangi Password</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="ulangi_password"
                                            name="ulangi_password" value="" placeholder="Ulangi Password">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Nama Siswa</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                            value="" placeholder="Nama Siswa">
                                    </div>
                                    <label class="col-sm-2 col-form-label font-weight-bold">Nama Orang Tua</label>
                                    <select class="custom-select col-sm-3" id="nama_orangtua" name="nama_orangtua">

                                        <option selected disabled>Pilih Nama Orang Tua</option>
                                        @foreach ($orangtua as $index => $orangtuas)
                                        <option value="{{ $orangtuas->id_orangtua }}">{{ $orangtuas->nama }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Tanggal</label>
                                    <div class="input-group date col-sm-3" id="datetimepicker1"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker1" id="tanggal_lahir" name="tanggal_lahir"
                                            placeholder="Pilih Tanggal" />
                                        <div class="input-group-append" data-target="#datetimepicker1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>



                                    <label class="col-sm-2 col-form-label font-weight-bold">Gedung</label>

                                    <select class="custom-select col-sm-3" id="gedung" name="gedung">
                                        <option selected disabled>Pilih Gedung</option>
                                        @foreach ($gedung as $index => $gedungs)
                                        <option value="{{ $gedungs->kode_gedung }}">{{ $gedungs->nama_gedung }}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Kelas Sekolah</label>
                                    <div class="col-sm-3">
                                        <select class="custom-select" id="kelas_sekolah" name="kelas_sekolah">
                                            <option selected disabled>Pilih Kelas Sekolah</option>
                                            @foreach ($kelassekolah as $index => $kelassekolahs)
                                            <option value="{{ $kelassekolahs->kode_kelas }}">
                                                {{ $kelassekolahs->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label font-weight-bold">Kelas Asrama</label>
                                    <select class="custom-select col-sm-3" id="kelas_asrama" name="kelas_asrama">
                                        <option selected disabled>Pilih Kelas Asrama</option>
                                        @foreach ($kelasasrama as $index => $kelasasramas)
                                        <option value="{{ $kelasasramas->kode_kelas_asrama }}">
                                            {{ $kelasasramas->nama_sub_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Jenis Kelamin</label>
                                    <div class="col-sm-3">
                                        <label class="radio-inline mr-2 mt-2"><input class="mr-1" type="radio"
                                                name="jeniskelamin" value="Laki - laki">Laki - laki</label>
                                        <label class="radio-inline mr-2 mt-2"><input class="mr-1" type="radio"
                                                name="jeniskelamin" value="Perempuan">Perempuan</label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Alamat</label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control rounded-0" id="alamat" name="alamat"
                                            placeholder="Alamat Siswa" value="" rows="3"></textarea>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade" id="orangTua" role="tabpanel" aria-labelledby="orangtua-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Tambah Akun Orang Tua <button
                                    id="simpanDataOrangTua" type="button" class="btn btn-primary simpanDataOrangTua"
                                    style="float:right;">Simpan</button></div>

                            <div class="card-body">
                                <div class="alert alert-primary col-sm-12" role="alert">
                                    Silahkan isi data orang tua!
                                    <br>Silahkan isi Id orang tua dengan format berikut : p + dengan NIK siswa
                                </div>
                                <input type="text" class="form-control" id="role_orangtua" name="role_orangtua"
                                    value="Orang Tua" hidden>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Id Orang Tua</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="id_orangtua" name="id_orangtua"
                                            value="p" placeholder="Id Orang Tua">
                                    </div>

                                    <label class="col-sm-2 col-form-label font-weight-bold">Nama Orang Tua</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="nama_orang_tua"
                                            name="nama_orang_tua" value="" placeholder="Nama Orang Tua">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Password Akun</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="password_orangtua"
                                            name="password_orangtua" value="" placeholder="Password">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="guruSekolah" role="tabpanel" aria-labelledby="siswa-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Tambah Akun Guru Sekolah <button
                                    id="simpanDataGuruSekolah" type="button"
                                    class="btn btn-primary simpanDataGuruSekolah" style="float:right;">Simpan</button>
                            </div>

                            <div class="card-body">
                                <div class="alert alert-primary col-sm-12" role="alert">
                                    Silahkan isi data guru sekolah! Pastikan data adalah benar!
                                </div>
                                <input type="text" class="form-control" id="role_guru_sekolah" name="role_guru_sekolah"
                                    value="Guru Sekolah" hidden>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">NIK Guru Sekolah</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="id_guru_sekolah"
                                            name="id_guru_sekolah" value="" placeholder="NIK Guru Sekolah">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Password Akun</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="password_guru_sekolah"
                                            name="password_guru_sekolah" value="" placeholder="Password">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Nama Guru Sekolah</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="nama_guru_sekolah"
                                            name="nama_guru_sekolah" value="" placeholder="Nama Guru Sekolah">
                                    </div>
                                    <label class="col-sm-2 col-form-label font-weight-bold">Mata Pelajaran</label>
                                    <select class="custom-select col-sm-3" id="mata_pelajaran_guru_sekolah"
                                        name="mata_pelajaran_guru_sekolah">
                                        <option selected disabled>Pilih Mata Pelajaran</option>
                                        @foreach ($matapelajaran as $index => $matapelajarans)
                                        <option value="{{ $matapelajarans->kode_mapel }}">
                                            {{ $matapelajarans->nama_mata_pelajaran }}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label font-weight-bold">Tanggal</label>
                                    <div class="input-group date col-sm-3" id="datetimepicker2"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker1" id="tanggal_lahir_guru_sekolah"
                                            name="tanggal_lahir_guru_sekolah" placeholder="Pilih Tanggal" />
                                        <div class="input-group-append" data-target="#datetimepicker2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>


                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Jenis Kelamin</label>
                                    <div class="col-sm-3">
                                        <label class="radio-inline mr-2 mt-2"><input class="mr-1" type="radio"
                                                name="jeniskelamin_guru_sekolah" value="Laki - laki">Laki - laki</label>
                                        <label class="radio-inline mr-2 mt-2"><input class="mr-1" type="radio"
                                                name="jeniskelamin_guru_sekolah" value="Perempuan">Perempuan</label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Alamat</label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control rounded-0" id="alamat_guru_sekolah"
                                            name="alamat_guru_sekolah" placeholder="Alamat Siswa" value=""
                                            rows="3"></textarea>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="guruAsrama" role="tabpanel" aria-labelledby="siswa-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Tambah Akun Guru Asrama <button
                                    id="simpanDataGuruAsrama" type="button" class="btn btn-primary simpanDataGuruAsrama"
                                    style="float:right;">Simpan</button></div>

                            <div class="card-body">
                                <div class="alert alert-primary col-sm-12" role="alert">
                                    Silahkan isi data guru asrama! Pastikan data adalah benar!

                                </div>
                                <input type="text" class="form-control" id="role_guru_asrama" name="role_guru_asrama"
                                    value="Guru Asrama" hidden>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">NIK Guru Asrama</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="id_guru_asrama"
                                            name="id_guru_asrama" value="" placeholder="NIK Guru Asrama">
                                    </div>


                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Password Akun</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="password_guru_asrama"
                                            name="password_guru_asrama" value="" placeholder="Password">
                                    </div>


                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Ulangi Password</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="ulangi_password_guru_asrama"
                                            name="ulangi_password_guru_asrama" value="" placeholder="Ulangi Password">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Nama Guru Asrama</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="nama_guru_asrama"
                                            name="nama_guru_asrama" value="" placeholder="Nama Guru Sekolah">
                                    </div>
                                    <label class="col-sm-2 col-form-label font-weight-bold">Gedung</label>
                                    <select class="custom-select col-sm-3" id="gedung_guru_asrama"
                                        name="gedung_guru_asrama">
                                        <option selected disabled>Pilih Gedung</option>
                                        @foreach ($gedungguruasrama as $index => $gedungguruasramas)
                                        <option value="{{ $gedungguruasramas->kode_gedung }}">
                                            {{ $gedungguruasramas->nama_gedung }}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Tanggal</label>
                                    <div class="input-group date col-sm-3" id="datetimepicker3"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker1" id="tanggal_lahir_guru_asrama"
                                            name="tanggal_lahir_guru_asrama" placeholder="Pilih Tanggal" />
                                        <div class="input-group-append" data-target="#datetimepicker3"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Jenis Kelamin</label>
                                    <div class="col-sm-3">
                                        <label class="radio-inline mr-2 mt-2"><input class="mr-1" type="radio"
                                                name="jeniskelamin_guru_asrama" value="Laki - laki">Laki - laki</label>
                                        <label class="radio-inline mr-2 mt-2"><input class="mr-1" type="radio"
                                                name="jeniskelamin_guru_asrama" value="Perempuan">Perempuan</label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Alamat</label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control rounded-0" id="alamat_guru_asrama"
                                            name="alamat_guru_asrama" placeholder="Alamat Siswa" value=""
                                            rows="3"></textarea>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="orangtua-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Tambah Akun Admin <button id="simpanDataSiswa"
                                    type="button" class="btn btn-primary simpanDataAdmin"
                                    style="float:right;">Simpan</button></div>

                            <div class="card-body">
                                <div class="alert alert-primary col-sm-12" role="alert">
                                    Silahkan isi data admin!
                                    <br>Silahkan isi Id Admin dengan format berikut : admin + dengan 3 digit angka
                                </div>
                                <input type="text" class="form-control" id="role_admin" name="role_admin" value="Admin"
                                    hidden>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Id Admin</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="id_admin" name="id_admin"
                                            value="admin" placeholder="Id Admin">
                                    </div>

                                    <label class="col-sm-2 col-form-label font-weight-bold">Nama Admin</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="nama_admin" name="nama_admin"
                                            value="" placeholder="Nama Admin">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Password Akun</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="password_admin"
                                            name="password_admin" value="" placeholder="Password">
                                    </div>


                                </div>
                            </div>
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
        $('#datetimepicker2').datetimepicker({
            format: 'L',
            format: 'YYYY-MM-DD'
        });
    });

    $(function () {
        $('#datetimepicker3').datetimepicker({
            format: 'L',
            format: 'YYYY-MM-DD'
        });
    });

</script>
<script>
    $(document).on('click', '.simpanDataSiswa', function () {
        var ulangipassword = $('#ulangi_password').val();
        var password = $('#password').val();

        if (ulangipassword != password) {
            alert('Silahkan cek kembali password anda!');
        } else {
            $.ajax({
                url: "/storeAkunSiswa",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                data: {
                    'id_user': $('#id_user').val(),
                    'id_orangtua': $('#nama_orangtua option:selected').val(),
                    'nama_siswa': $('#nama_siswa').val(),
                    'tanggal_lahir': $('#tanggal_lahir').val(),
                    'alamat': $.trim($("#alamat").val()),
                    'jenis_kelamin': $("input[name='jeniskelamin']:checked").val(),
                    'password': $('#password').val(),
                    'role': $('#role').val(),
                    'kode_gedung': $('#gedung option:selected').val(),
                    'kode_kelas': $('#kelas_sekolah option:selected').val(),
                    'kode_kelas_asrama': $('#kelas_asrama option:selected').val()
                },

                success: function (data) {
                    var hasil = data;
                    console.log(hasil);
                    if (hasil == 'true') {
                        alert('Anda berhasil menambahkan akun siswa');
                        window.location.href = "/kelola_akun";
                    }
                },

                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Silahkan lengkap data terlebih dahulu! Pastikan semua data terisi!');
                },
            });
        }


    });

    $(document).on('click', '.simpanDataAdmin', function () {
        $.ajax({
            url: "/storeAkunAdmin",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'id_admin': $('#id_admin').val(),
                'nama_admin': $('#nama_admin').val(),
                'password_admin': $('#password_admin').val(),
                'role_admin': $('#role_admin').val(),
            },

            success: function (data) {
                var hasil = data;
                console.log(hasil);
                if (hasil == 'true') {
                    alert('Anda berhasil menambahkan akun admin');
                    window.location.href = "/kelola_akun";
                    // $('#modalPenilaianUTS').modal('toggle');
                }
                // window.location.href = "/penilaian_asrama";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Silahkan lengkap data terlebih dahulu! Pastikan semua data terisi!');
            },
        });

    });

    $(document).on('click', '.simpanDataOrangTua', function () {
        $.ajax({
            url: "/storeAkunOrangTua",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'id_orangtua': $('#id_orangtua').val(),
                'nama_orangtua': $('#nama_orang_tua').val(),
                'password_orangtua': $('#password_orangtua').val(),
                'role_orangtua': $('#role_orangtua').val(),
            },

            success: function (data) {
                var hasil = data;
                console.log(hasil);
                if (hasil == 'true') {
                    alert('Anda berhasil menambahkan akun admin');
                    window.location.href = "/kelola_akun";
                    // $('#modalPenilaianUTS').modal('toggle');
                }
                // window.location.href = "/penilaian_asrama";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Silahkan lengkap data terlebih dahulu! Pastikan semua data terisi!');
            },
        });

    });

    $(document).on('click', '.simpanDataGuruSekolah', function () {
        $.ajax({
            url: "/storeAkunGuruSekolah",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'id_gurusekolah': $('#id_guru_sekolah').val(),
                'id_mata_pelajaran': $('#mata_pelajaran_guru_sekolah option:selected').val(),
                'nama_gurusekolah': $('#nama_guru_sekolah').val(),
                'tanggal_lahir_gurusekolah': $('#tanggal_lahir_guru_sekolah').val(),
                'alamat_gurusekolah': $.trim($("#alamat_guru_sekolah").val()),
                'jenis_kelamin_gurusekolah': $("input[name='jeniskelamin_guru_sekolah']:checked").val(),
                'password_gurusekolah': $('#password_guru_sekolah').val(),
                'role_gurusekolah': $('#role_guru_sekolah').val(),
            },

            success: function (data) {
                var hasil = data;
                console.log(hasil);
                if (hasil == 'true') {
                    alert('Anda berhasil menambahkan akun siswa');
                    window.location.href = "/kelola_akun";
                    // $('#modalPenilaianUTS').modal('toggle');
                }
                // window.location.href = "/penilaian_asrama";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Silahkan lengkap data terlebih dahulu! Pastikan semua data terisi!');
            },
        });

    });

    $(document).on('click', '.simpanDataGuruAsrama', function () {
        var ulangipassword = $('#ulangi_password_guru_asrama').val();
        var password = $('#password_guru_asrama').val();

        if (ulangipassword != password) {
            alert('Silahkan cek kembali password anda!');
            console.log(ulangipassword);
            console.log(password);
        } else {
            $.ajax({
                url: "/storeAkunGuruAsrama",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                data: {
                    'id_guruasrama': $('#id_guru_asrama').val(),
                    'kode_gedung_guruasrama': $('#gedung_guru_asrama option:selected').val(),
                    'nama_guruasrama': $('#nama_guru_asrama').val(),
                    'tanggal_lahir_guruasrama': $('#tanggal_lahir_guru_asrama').val(),
                    'alamat_guruasrama': $.trim($("#alamat_guru_asrama").val()),
                    'jenis_kelamin_guruasrama': $("input[name='jeniskelamin_guru_asrama']:checked")
                        .val(),
                    'password_guruasrama': $('#password_guru_asrama').val(),
                    'role_guruasrama': $('#role_guru_asrama').val(),
                },

                success: function (data) {
                    var hasil = data;
                    console.log(hasil);
                    if (hasil == 'true') {
                        alert('Anda berhasil menambahkan akun siswa');
                        window.location.href = "/kelola_akun";
                        // $('#modalPenilaianUTS').modal('toggle');
                    }
                    // window.location.href = "/penilaian_asrama";
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Silahkan lengkap data terlebih dahulu! Pastikan semua data terisi!');
                },
            });
        }


    });

</script>

@endsection
