@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Tambah Nilai Asrama</title>
    <link rel="shortcut icon" href="img/group-6.png">
    <style>
        #form_praktikum .error {
            color: red;
        }

        #form_sikap .error {
            color: red;
        }

        #form_ekstrakulikuler .error {
            color: red;
        }

        @media screen and (max-width: 520px), (max-width: 768px) {
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
    <h4 class="font-weight-bold"><i class="fa fa-book mr-4"></i>Penilaian Asrama</h4>
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
                <div class="col-sm">
                    <div class="form-group row">
                        <label class="col-form-label font-weight-bold col-sm-2">Tahun Ajaran</label>
                        <div class="col-sm-10">
                            @foreach ($tahunajaran as $tahunajarans)
                            <label class="col-form-label">{{ $tahunajarans->tahun_ajaran }}</label>
                            @endforeach
                        </div>
                        <label class="col-sm-2 col-form-label font-weight-bold">Semester</label>
                        <div class="col-sm-10">
                            @foreach ($tahunajaran as $tahunajaran)
                            <label class="col-form-label">{{ $tahunajarans->semester }}</label>
                            @endforeach
                        </div>
                        <label class="col-form-label font-weight-bold col-sm-2">Guru</label>
                        <div class="col-sm-10">
                            @foreach ($guruasrama as $guruasramas)
                            <label class="col-form-label">{{ $guruasramas->nama_guru_asrama }}</label>
                            @endforeach
                        </div>
                        <label class="col-sm-2 col-form-label font-weight-bold">Graha</label>
                        <div class="col-sm-10">
                            @foreach ($guruasrama as $guruasramas)
                            <label class="col-sm- col-form-label" style="display: none;"
                                id="id_matapelajaran">{{ $guruasramas->kode_gedung }}</label>
                            <label class="col-sm- col-form-label"
                                id="id_matapelajaran">{{ $guruasramas->nama_gedung }}</label>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-8">
            @csrf
            <div class="card">
                <div class="card-header">Ubah kelas asrama siswa</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="alert alert-warning" role="alert">
                                Ubah kelas asrama siswa jika siswa telah dinyatakan Lulus!
                                </br> Cek kelengkapan nilai siswa sebelum menyatakan siswa lulus dari kelas tersebut!
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bold">Nama Siswa</label>
                                <div class="col-sm-9">
                                    <select class="custom-select" id="id_siswa" name="id_siswa">
                                        <option selected disabled>Pilih Siswa</option>
                                        @foreach ($siswaasrama as $siswaasramas)
                                        <option value="{{ $siswaasramas->id_siswa }}">
                                            {{ $siswaasramas->nama_siswa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bold">Pilih Kelas</label>
                                <div class="col-sm-9">
                                    <select class="custom-select" id="pilih_kelas" name="pilih_kelas">
                                        <option selected disabled>Pilih Kelas</option>
                                        @foreach ($kelasasrama as $kelasasramas)
                                        <option value="{{ $kelasasramas->kode_kelas_asrama }}">
                                            {{ $kelasasramas->nama_sub_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary updateKelasAsrama"
                                style="float:right;">Update</button>
                        </div>
                    </div>
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
                                            <td><button type="button" class="btn btn-primary tombolTambahNilaiMateri"
                                                    id="{{ $siswaasramas->id_siswa }}"
                                                    data-id="{{ $siswaasramas->id_siswa }}"
                                                    value="{{ $siswaasramas->id_siswa }}"> <i
                                                        class="fas fa-plus-square text-center mr-1"
                                                        style="color: white"></i>Tambah Nilai</button></i></td>

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
                                            <td><button type="button" class="btn btn-primary tombolTambahNilaiPraktikum"
                                                    id="{{ $siswaasramas->id_siswa }}"
                                                    data-id="{{ $siswaasramas->id_siswa }}"
                                                    value="{{ $siswaasramas->id_siswa }}"> <i
                                                        class="fas fa-plus-square text-center mr-1"
                                                        style="color: white"></i>Tambah Nilai</button></i></td>

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
                                            <td><button type="button" class="btn btn-primary tombolTambahNilaiSikap"
                                                    id="{{ $siswaasramas->id_siswa }}"
                                                    data-id="{{ $siswaasramas->id_siswa }}"
                                                    value="{{ $siswaasramas->id_siswa }}"> <i
                                                        class="fas fa-plus-square text-center mr-1"
                                                        style="color: white"></i>Tambah Nilai</button></i></td>

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
                                                    class="btn btn-primary tombolTambahNilaiEkstrakulikuler"
                                                    id="{{ $siswaasramas->id_siswa }}"
                                                    data-id="{{ $siswaasramas->id_siswa }}"
                                                    value="{{ $siswaasramas->id_siswa }}"> <i
                                                        class="fas fa-plus-square text-center mr-1"
                                                        style="color: white"></i>Tambah Nilai</button></i></td>

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
                                            <td><button type="button" class="btn btn-primary tombolTambahNilaiSaran"
                                                    id="{{ $siswaasramas->id_siswa }}"
                                                    data-id="{{ $siswaasramas->id_siswa }}"
                                                    value="{{ $siswaasramas->id_siswa }}"> <i
                                                        class="fas fa-plus-square text-center mr-1"
                                                        style="color: white"></i>Tambah Nilai</button></i></td>

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

    <div class="modal fade" id="modalPenilaianMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Penilaian Materi Pokok <label class="col-form-label"
                            id="kelasLabel" name="kelasLabel"></label></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm">
                        <div class="alert alert-primary" role="alert">
                            Silahkan pilih materi terlebih dahulu, kemudian berikan keterangan dari materi tersebut! Isi
                            "khatam" jika siswa sudah melengkapi materi!
                        </div>
                        <input hidden name="id_siswa" id="id_siswa_modal">
                        <input hidden name="kategori_materi_modal" id="kategori_materi_modal" value="">
                        <input hidden name="kelas" id="kelas" value="">
                        <form action="" name="form_materi_pokok" id="form_materi_pokok">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold" name="tipe_nilaiLabel">Pilih
                                    Materi</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" id="tipe_nilai" name="tipe_nilai">
                                        <option selected value="Pilih Materi" disabled>Pilih Materi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold"
                                    name="keteranganLabel">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="keterangan_materi"
                                        name="keterangan_materi" placeholder="Keterangan">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary tombolSaveMateri">Save changes</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPenilaianPraktikum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Penilaian Pemahaman Konsep dan Praktikum <label
                            class="col-form-label" id="kelasLabelPraktikum" name="kelasLabelPraktikum"></label></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm">
                        <form action="" name="form_praktikum" id="form_praktikum">
                            <div class="alert alert-primary" role="alert">
                                Silahkan pilih materi terlebih dahulu, kemudian beri nilai dari materi tersebut!
                                <br>91-100 : Istimewa
                                <br>81-90 : Baik Sekali
                                <br>71-80 : Baik
                                <br>61-70 : Lebih dari Cukup
                                <br>51-60 : Istimewa
                                <br>41-50 : Hampir Cukup
                                <br>31-40 : Kurang
                                <br>21-30 : Kurang Sekali
                                <br>11-20 : Buruk
                                <br> 0-10 : Buruk Sekali
                            </div>
                            <input hidden name="id_siswa" id="id_siswa_modal_praktikum">
                            <input hidden name="kategori_materi_modal_praktikum" id="kategori_materi_modal_praktikum"
                                value="">
                            <input hidden name="kelas_praktikum" id="kelas_praktikum" value="">

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label font-weight-bold" name="tipe_nilaiLabel">Pilih
                                    Materi</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" id="tipe_nilai_praktikum" name="tipe_nilai_praktikum">
                                        <option selected value="Pilih Juz" disabled>Pilih Materi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold"
                                    name="keteranganLabel">Nilai</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="keterangan_praktikum"
                                        name="keterangan_praktikum" placeholder="Nilai Materi" min="1" max="100">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary tombolSavePraktikum">Save changes</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPenilaianSikap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Penilaian Sikap dan Perilaku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm">
                        <div class="alert alert-primary" role="alert">
                            Silahkan pilih materi terlebih dahulu, kemudian beri nilai dari materi tersebut!
                            <br>91-100 : Istimewa
                            <br>81-90 : Baik Sekali
                            <br>71-80 : Baik
                            <br>61-70 : Lebih dari Cukup
                            <br>51-60 : Istimewa
                            <br>41-50 : Hampir Cukup
                            <br>31-40 : Kurang
                            <br>21-30 : Kurang Sekali
                            <br>11-20 : Buruk
                            <br> 0-10 : Buruk Sekali
                        </div>
                        <input hidden name="id_siswa" id="id_siswa_modal_sikap">
                        <input hidden name="kategori_materi_modal_sikap" id="kategori_materi_modal_sikap" value="">
                        <input hidden name="kelas_sikap" id="kelas_sikap" value="">
                        <form action="" name="form_sikap" id="form_sikap">
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label font-weight-bold" name="tipe_nilaiLabel">Pilih
                                    Materi</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" id="tipe_nilai_sikap" name="tipe_nilai_sikap">
                                        <option disabled selected value="Pilih Juz" disabled>Pilih Materi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold"
                                    name="keteranganLabel">Nilai</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="keterangan_sikap"
                                        name="keterangan_sikap" min="1" max="100" placeholder="Nilai Materi">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary tombolSaveSikap">Save changes</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPenilaianEkstrakulikuler" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Penilaian Kegiatan Ekstrakulikuler/Pengembangan Diri
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm">
                        <div class="alert alert-primary" role="alert">
                            Silahkan pilih materi terlebih dahulu, kemudian beri nilai dari materi tersebut!
                            <br>91-100 : Istimewa
                            <br>81-90 : Baik Sekali
                            <br>71-80 : Baik
                            <br>61-70 : Lebih dari Cukup
                            <br>51-60 : Istimewa
                            <br>41-50 : Hampir Cukup
                            <br>31-40 : Kurang
                            <br>21-30 : Kurang Sekali
                            <br>11-20 : Buruk
                            <br> 0-10 : Buruk Sekali
                        </div>
                        <input hidden name="id_siswa" id="id_siswa_modal_ekstrakulikuler">
                        <input hidden name="kategori_materi_modal_ekstrakulikuler"
                            id="kategori_materi_modal_ekstrakulikuler" value="">
                        <input hidden name="kelas_ekstrakulikuler" id="kelas_ekstrakulikuler" value="">
                        <form action="" name="form_ekstrakulikuler" id="form_ekstrakulikuler">
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label font-weight-bold" name="tipe_nilaiLabel">Pilih
                                    Materi</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" id="tipe_nilai_ekstrakulikuler"
                                        name="tipe_nilai_ekstrakulikuler">
                                        <option disabled selected value="Pilih Juz" disabled>Pilih Materi</option>
                                        <!-- <option value="Pencak Silat">Pencak Silat</option>
                                    <option value="Sepakbola/Futsal">Sepakbola/Futsal</option>
                                    <option value="Senam">Senam</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold"
                                    name="keteranganLabel">Nilai</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="keterangan_ekstrakulikuler"
                                        name="keterangan_ekstrakulikuler" min="1" max="100" placeholder="Nilai Materi">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary tombolSaveEkstrakulikuler">Save changes</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCatatandanSaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Catatan dan Saran Wali Kelas
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm">
                        <div class="alert alert-primary" role="alert">
                            Silahkan masukkan nama siswa dan berikan catatan dan saran kepada siswa!
                        </div>
                        <input hidden name="id_siswa" id="id_siswa_modal_saran">
                        <input hidden name="kategori_materi_modal_saran" id="kategori_materi_modal_saran" value="">
                        <input hidden name="kelas_saran" id="kelas_saran" value="">
                        <input hidden name="tipe_nilai_saran" id="tipe_nilai_saran"
                            value="Catatan dan Saran Wali Kelas">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Catatan dan Saran</label>
                            <div class="col-sm-9">
                                <textarea class="form-control rounded-0" id="keterangan_saran" name="keterangan_saran"
                                    placeholder="Catatan dan Saran kepada siswa" value="" rows="3"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary tombolSaveSaran">Save changes</button>
                </div>

            </div>
        </div>
    </div>


</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.tombolTambahNilaiMateri', function () {
            var id = $(this).data('id');
            $('#id_siswa_modal').val(id);
            var kategori = $(kategori_materi).val();
            var kelas = $(this).closest('tr').find('input').val()
            var nama_sub_kelas = $(this).closest('tr').find('label').html()
            $.ajax({
                url: "/getMateriAsrama/",
                type: "get",
                data: {
                    'kategori': kategori,
                    'kelas': kelas,
                },
                dataType: 'json',
                success: function (data) {
                    $("#tipe_nilai").empty();
                    $.each(data, function (key, value) {
                        //dibawah sini ajaxnya
                        $("#tipe_nilai").append("<option value='" + value
                            .kode_materi + "'>" + value.nama_materi +
                            "</option>");
                    });
                    $('#kelas').val(nama_sub_kelas);
                    $('#kelasLabel').html(nama_sub_kelas);
                    $('#kategori_materi_modal').val(kategori);
                    $('#modalPenilaianMateri').modal('show');
                }
            });


            console.log(id);
        });

        $(document).on('click', '.tombolTambahNilaiPraktikum', function () {
            var id = $(this).data('id');
            var kategori = $(kategori_praktikum).val();
            $('#id_siswa_modal_praktikum').val(id);
            var kelas = $(this).closest('tr').find('input').val()
            var nama_sub_kelas = $(this).closest('tr').find('label').html()
            $.ajax({
                url: "/getMateriAsrama/",
                type: "get",
                data: {
                    'kategori': kategori,
                    'kelas': kelas,
                },
                dataType: 'json',
                success: function (data) {
                    $("#tipe_nilai_praktikum").empty();
                    $.each(data, function (key, value) {
                        //dibawah sini ajaxnya
                        $("#tipe_nilai_praktikum").append("<option value='" + value
                            .kode_materi + "'>" + value.nama_materi +
                            "</option>");
                    });
                    $('#kelas_praktikum').val(nama_sub_kelas);
                    $('#kelasLabelPraktikum').html(nama_sub_kelas);
                    $('#kategori_materi_modal_praktikum').val(kategori);
                    $('#modalPenilaianPraktikum').modal('show');
                }
            });

            console.log(id);
        });

        $(document).on('click', '.tombolTambahNilaiSikap', function () {
            var id = $(this).data('id');
            var kategori = $(kode_materi_table_sikap).val();
            var kelas = 7;
            var nama_sub_kelas = $(this).closest('tr').find('label').html()
            $('#id_siswa_modal_sikap').val(id);
            $.ajax({
                url: "/getMateriAsrama/",
                type: "get",
                data: {
                    'kategori': kategori,
                    'kelas': kelas,
                },
                dataType: 'json',
                success: function (data) {
                    $("#tipe_nilai_sikap").empty();
                    $.each(data, function (key, value) {
                        //dibawah sini ajaxnya
                        $("#tipe_nilai_sikap").append("<option value='" + value
                            .kode_materi + "'>" + value.nama_materi +
                            "</option>");
                    });
                    $('#kelas_sikap').val(nama_sub_kelas);
                    $('#kelasLabelSikap').html(nama_sub_kelas);
                    $('#kategori_materi_modal_sikap').val(kategori);
                    $('#modalPenilaianSikap').modal('show');
                }
            });
            console.log(id);
        });

        $(document).on('click', '.tombolTambahNilaiEkstrakulikuler', function () {
            var id = $(this).data('id');
            var kategori = $(kode_materi_table_ekstrakulikuler).val();
            var kelas = 7;
            var nama_sub_kelas = $(this).closest('tr').find('label').html()
            $('#id_siswa_modal_ekstrakulikuler').val(id);

            $.ajax({
                url: "/getMateriAsrama/",
                type: "get",
                data: {
                    'kategori': kategori,
                    'kelas': kelas,
                },
                dataType: 'json',
                success: function (data) {
                    $("#tipe_nilai_ekstrakulikuler").empty();
                    $.each(data, function (key, value) {
                        //dibawah sini ajaxnya
                        $("#tipe_nilai_ekstrakulikuler").append("<option value='" +
                            value
                            .kode_materi + "'>" + value.nama_materi +
                            "</option>");
                    });
                    $('#kelas_ekstrakulikuler').val(nama_sub_kelas);
                    $('#kelasLabelEkstrakulikuler').html(nama_sub_kelas);
                    $('#kategori_materi_modal_ekstrakulikuler').val(kategori);
                    $('#modalPenilaianEkstrakulikuler').modal('show');
                }
            });
            console.log(id);
        });

        $(document).on('click', '.tombolTambahNilaiSaran', function () {
            var id = $(this).data('id');
            var kategori = $(kode_materi_table_saran).val();
            var kelas = 7;
            var nama_sub_kelas = $(this).closest('tr').find('label').html()
            $('#id_siswa_modal_saran').val(id);

            $.ajax({
                url: "/getMateriAsrama/",
                type: "get",
                data: {
                    'kategori': kategori,
                    'kelas': kelas,
                },
                dataType: 'json',
                success: function (data) {
                    $('#kelas_saran').val(nama_sub_kelas);
                    $('#kelasLabelEkstrakulikuler').html(nama_sub_kelas);
                    $('#kategori_materi_modal_saran').val(kategori);
                    $('#modalCatatandanSaran').modal('show');
                }
            });
            console.log(id);
        });

        $(document).on('click', '.tombolSaveSaran', function () {
            var keterangansaran = $.trim($("#keterangan_saran").val())
            console.log(keterangansaran);
            var keterangan = 'Keterangan';
            var kodemateri = 'ASA - 079';
            if (keterangansaran != '') {
                $.ajax({
                    url: "/storeNilaiAsrama",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: {
                        'id_siswa': $('#id_siswa_modal_saran').val(),
                        'kode_materi': kodemateri,
                        'kategori_materi': $('#kategori_materi_modal_saran').val(),
                        'kelas': $('#kelas_saran').val(),
                        'tipe_nilai': keterangan,
                        'keterangan': keterangansaran,
                    },

                    success: function (data) {
                        if (data == 'true') {
                            alert('Anda berhasil menambahkan nilai');
                            window.location.href = "/penilaian_asrama";
                        } else {
                            alert(
                                'Data nilai sudah dimasukkan sebelumnya, silahkan pilih menu Edit Nilai untuk mengubah nilai!'
                            );
                        }

                    }
                });
            } else {
                alert('Silahkan isi keterangan terlebih dahulu!');
            }

            // console.log(id);
        });



        $(document).on('click', '.tombolSaveMateri', function () {
            var keteranganmateri = $('#keterangan_materi').val();
            var keterangan = 'Keterangan';
            if (keteranganmateri != null) {
                $.ajax({
                    url: "/storeNilaiAsrama",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: {
                        'id_siswa': $('#id_siswa_modal').val(),
                        'kode_materi': $('#tipe_nilai option:selected').val(),
                        'kategori_materi': $('#kategori_materi_modal').val(),
                        'kelas': $('#kelas').val(),
                        'tipe_nilai': keterangan,
                        'keterangan': $('#keterangan_materi').val(),
                    },

                    success: function (data) {
                        if (data == 'true') {
                            alert('Anda berhasil menambahkan nilai');
                            window.location.href = "/penilaian_asrama";
                        } else {
                            alert(
                                'Data nilai sudah dimasukkan sebelumnya, silahkan pilih menu Edit Nilai untuk mengubah nilai!'
                            );
                        }

                    }
                });
            } else {
                alert('Silahkan isi nilai terlebih dahulu!');
            }

            // console.log(id);
        });

        $("#form_praktikum").validate({
            rules: {
                keterangan_praktikum: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                }
            },
            messages: {
                keterangan_praktikum: "Silahkan isi angka 1 sampai 100",
            },

            submitHandler: function (form) {}
        });

        $(document).on('click', '.tombolSavePraktikum', function () {
            if ($("#form_praktikum").valid()) {
                var keterangan = $('#keterangan_praktikum').val();
                var nilai = 'Nilai';
                if (keterangan != null) {
                    $.ajax({
                        url: "/storeNilaiAsrama",
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            'id_siswa': $('#id_siswa_modal_praktikum').val(),
                            'kode_materi': $('#tipe_nilai_praktikum option:selected').val(),
                            'kategori_materi': $('#kategori_materi_modal_praktikum').val(),
                            'kelas': $('#kelas_praktikum').val(),
                            'tipe_nilai': nilai,
                            'keterangan': $('#keterangan_praktikum').val(),
                        },

                        success: function (data) {
                            if (data == 'true') {
                                alert('Anda berhasil menambahkan nilai');
                                window.location.href = "/penilaian_asrama";
                            } else {
                                alert(
                                    'Data nilai sudah dimasukkan sebelumnya, silahkan pilih menu Edit Nilai untuk mengubah nilai!'
                                );
                            }

                        }
                    });
                } else {
                    alert('Silahkan isi nilai terlebih dahulu!')
                }
            } else {
                alert('Silahkan isi angka 1 sampai 100')
            }
            // console.log(id);
        });


        $("#form_sikap").validate({
            rules: {
                keterangan_sikap: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                }
            },
            messages: {
                keterangan_sikap: "Silahkan isi angka 1 sampai 100",
            },

            submitHandler: function (form) {}
        });

        $(document).on('click', '.tombolSaveSikap', function () {
            if ($("#form_sikap").valid()) {
                var keterangan = $('#keterangan_sikap').val();
                var nilai = 'Nilai';
                if (keterangan != null) {
                    $.ajax({
                        url: "/storeNilaiAsrama",
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            'id_siswa': $('#id_siswa_modal_sikap').val(),
                            'kode_materi': $('#tipe_nilai_sikap option:selected').val(),
                            'kategori_materi': $('#kategori_materi_modal_sikap').val(),
                            'kelas': $('#kelas_sikap').val(),
                            'tipe_nilai': nilai,
                            'keterangan': $('#keterangan_sikap').val(),
                        },

                        success: function (data) {
                            if (data == 'true') {
                                alert('Anda berhasil menambahkan nilai');
                                window.location.href = "/penilaian_asrama";
                            } else {
                                alert(
                                    'Data nilai sudah dimasukkan sebelumnya, silahkan pilih menu Edit Nilai untuk mengubah nilai!'
                                );
                            }

                        }
                    });
                } else {
                    alert('Silahkan isi nilai terlebih dahulu');
                }
            } else {
                alert('Silahkan isi angka 1 sampai 100');
            }


            // console.log(id);
        });

        $("#form_ekstrakulikuler").validate({
            rules: {
                keterangan_ekstrakulikuler: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                }
            },
            messages: {
                keterangan_ekstrakulikuler: "Silahkan isi angka 1 sampai 100",
            },

            submitHandler: function (form) {}
        });

        $(document).on('click', '.tombolSaveEkstrakulikuler', function () {
            if ($("#form_ekstrakulikuler").valid()) {
                var keterangan = $('#keterangan_ekstrakulikuler').val();
                var nilai = 'Nilai';
                if (keterangan != null) {
                    $.ajax({
                        url: "/storeNilaiAsrama",
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            'id_siswa': $('#id_siswa_modal_ekstrakulikuler').val(),
                            'kode_materi': $('#tipe_nilai_ekstrakulikuler option:selected')
                            .val(),
                            'kategori_materi': $('#kategori_materi_modal_ekstrakulikuler')
                            .val(),
                            'kelas': $('#kelas_ekstrakulikuler').val(),
                            'tipe_nilai': nilai,
                            'keterangan': $('#keterangan_ekstrakulikuler').val(),
                        },

                        success: function (data) {
                            if (data == 'true') {
                                alert('Anda berhasil menambahkan nilai');
                                window.location.href = "/penilaian_asrama";
                            } else {
                                alert(
                                    'Data nilai sudah dimasukkan sebelumnya, silahkan pilih menu Edit Nilai untuk mengubah nilai!'
                                );
                            }

                        }
                    });
                } else {
                    alert('Silahkan isi nilai terlebih dahulu');
                }
            } else {
                alert('Silahkan isi angka 1 sampai 100');
            }


            // console.log(id);
        });

        $(document).on('click', '.updateKelasAsrama', function () {
            // $('#modalEditNilai').modal('show');
            var id = $('#id_siswa').val();
            var pilihkelas = $('#pilih_kelas').val();
            if (id != null && pilihkelas != null) {
                $.ajax({
                    url: "/updateKelasAsrama",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id_siswa': id,
                        'kode_kelas_asrama': pilihkelas,
                    },
                    dataType: 'json',
                    success: function (data) {
                        alert('Data Kelas Asrama Siswa Berhasil diupdate!');
                        window.location.href = "/penilaian_asrama";
                    }
                });
            } else {
                alert('Silahkan pilih nama dan kelas terlebih dahulu!');
            }

        });

    })

</script>

@endsection
