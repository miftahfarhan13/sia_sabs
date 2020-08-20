@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Penilaian Akademik</title>
    <link rel="shortcut icon" href="img/group-6.png">
    <style>
        #form_nilai .error {
            color: red;
        }

        #form_nilai_sikap .error {
            color: red;
        }

        #form_nilai_keterampilan .error {
            color: red;
        }
        #formBobotNilaiSimpan .error {
            color: red;
        }
        #formBobotNilaiUpdate .error {
            color: red;
        }

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
    <h4 class="font-weight-bold"><i class="fa fa-book mr-4"></i>Penilaian Akademik</h4>
    <hr>
    <!-- @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
             @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
             @endforeach
        </ul>
    </div>
    @endif -->

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
                    @foreach ($gurusekolahs as $gurusekolah)
                    <label class="col-form-label">{{ $gurusekolah->nama_guru_sekolah }}</label>
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
                <p class="col-form-label col-sm-2 font-weight-bold">Pilih Kelas</p>
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
    <div class="row mt-2">
        <div class="col-md-7">
            @if($bobotnilai->count() > 0)
            <form id="formBobotNilaiUpdate" action="/updateBobotNilai" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">Bobot Penilaian</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group row">
                                    @foreach ($bobotnilai as $bobotnilaii)
                                    <label class="col-sm-3 col-form-label font-weight-bold">KKM</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="kkm" name="kkm"
                                            value="{{ $bobotnilaii->KKM }}" placeholder="Nilai KKM" min="10" max="100">
                                    </div>
                                </div>
                                <div class="alert alert-primary" role="alert">
                                    Silahkan isi bobot nilai Ulangan harian, UTS dan UAS, sistem akan menghitung dalam
                                    persen (%)
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">Ulangan Harian</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="ulanganHarian"
                                            name="ulanganHarian" value="{{ $bobotnilaii->ulangan_harian }}"
                                            placeholder="Nilai Ulangan Harian" min="10" max="100">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">UTS</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="uts" name="uts" placeholder="UTS"
                                            value="{{ $bobotnilaii->uts }}" min="10" max="100">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">UAS</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="uas" name="uas" placeholder="UAS"
                                            value="{{ $bobotnilaii->uas }}" min="10" max="100">
                                    </div>
                                </div>
                                @endforeach
                                <button id="updateBobotNilai" type="submit" class="btn btn-primary"
                                    style="float:right;">Update</button>
                                <!-- <button id="tombolEditBobotNilai" type="button" class="btn btn-warning mr-1"
                                    style="float:right;" >Edit</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @else
            <form id="formBobotNilaiSimpan" action="/storeBobotNilai" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">Bobot Penilaian</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">KKM</label>

                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="kkm" name="kkm" value=""
                                            placeholder="Nilai KKM" min="10" max="100">
                                    </div>

                                </div>
                                <div class="alert alert-primary" role="alert">
                                    Silahkan isi bobot nilai Ulangan harian, UTS dan UAS, sistem akan menghitung dalam
                                    persen (%)
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">Ulangan Harian</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="ulanganHarian"
                                            name="ulanganHarian" value="" placeholder="Nilai Ulangan Harian" min="10"
                                            max="100">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">UTS</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="uts" name="uts" placeholder="UTS"
                                            value="" placeholder="UTS" min="10" max="100">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">UAS</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="uas" name="uas" placeholder="UAS"
                                            value="" placeholder="UTS" min="10" max="100">
                                    </div>
                                </div>

                                <button id="submitBobotNilai" type="submit" class="btn btn-primary"
                                    style="float:right;">Simpan</button>

                            </div>

                        </div>
                    </div>
                </div>

            </form>
            @endif
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
                    <a class="nav-link" id="keterampilan-tab" data-toggle="tab" href="#penilaianKeterampilan" role="tab"
                        aria-controls="Penilaian Keterampilan" aria-selected="false">Penilaian
                        Keterampilan</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="penilaianMateri" role="tabpanel"
                    aria-labelledby="materi-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">Penilaian Materi</div>

                            <div class="card-body">

                                <table id="penilaian_materi" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Nilai</th>
                                            <th scope="col">Deskripsi</th>

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

                <div class="tab-pane fade" id="penilaianSikap" role="tabpanel" aria-labelledby="sikap-tab">
                    <div class="mt-2">
                        <div class="card">
                            <div class="card-header">Penilaian Sikap</div>
                            <div class="card-body">

                                <table id="penilaian_sikap" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Tambah Nilai</th>
                                            <th scope="col">Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>



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
                                <table id="penilaian_keterampilan" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Tambah Nilai</th>
                                            <th scope="col">Deskripsi</th>
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

</div>

<!-- Modal -->

<div class="modal fade" id="modalPenilaianUTS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penilaian Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                    Silahkan pilih tipe nilai terlebih dahulu, kemudian silahkan masukan nilai siswa!<br><br>
                    UTS dan UAS hanya dapat dimasukkan satu kali, jika sudah ditambahkan silahkan pilih menu Edit
                    Nilai pada sidebar untuk mengubah nilai!
                    <br>
                    <br><label class="font-weight-bold">Silahkan gunakan tanda '.' (titik) jika nilai adalah bilangan
                        desimal! </label>
                </div>
                <form action="" name="form_nilai" id="form_nilai">
                    <div class="col-sm">
                        <input type="hidden" name="id_siswa_modal" id="id_siswa_modal">
                        <input type="hidden" name="id_kategori" value="Pengetahuan">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Tipe Nilai</label>
                            <div class="col-sm-9">
                                <select class="custom-select" id="tipe_nilai_dropdown" name="tipe_nilai_dropdown">
                                    <option value="Ulangan Harian">Ulangan Harian</option>
                                    <option value="UTS">UTS</option>
                                    <option value="UAS">UAS</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Nilai</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="nilai" name="nilai"
                                    placeholder="Isi Nilai" min="0" max="100">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary tombolSimpanNilaiUjian">Save changes</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="modalPenilaianKeterampilan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penilaian Keterampilan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm">
                    <input type="hidden" name="id_siswa" id="id_siswa_modal_keterampilan">
                    <div class="alert alert-primary" role="alert">
                        Silahkan isi nilai keterampilan berdasarkan kriteria :
                        <br>5 = Sangat Baik
                        <br>4 = Baik
                        <br>3 = Cukup
                        <br>2 = Kurang
                        <br>1 = Sangat Kurang
                    </div>
                    <form action="/storeNilaiSikapKeterampilan" name="form_nilai_keterampilan"
                        id="form_nilai_keterampilan">
                        <div class="form-group row">
                            <input class='id_kategori_keterampilan' type="hidden" name="id_kategori"
                                value="Keterampilan">
                            <input class='tipe_nilai_keterampilan' type="hidden" name="tipe_sikapberpendapat"
                                value="Sikap Berpendapat">
                            <label class="col-sm-3 col-form-label font-weight-bold">Sikap Berpendapat</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control nilai_sikap_keterampilan"
                                    id="nilai_sikap_keterampilan" name="sikapBerpendapat"
                                    placeholder="Sikap Berpendapat" min="1" max="5">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input class='id_kategori_keterampilan' type="hidden" name="id_kategori"
                                value="Keterampilan">
                            <input class='tipe_nilai_keterampilan' type="hidden" name="tipe_presentasi"
                                value="Presentasi">
                            <label class="col-sm-3 col-form-label font-weight-bold">Presentasi</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control nilai_sikap_keterampilan"
                                    id="nilai_sikap_keterampilan" name="presentasi" placeholder="Presentasi" min="1"
                                    max="5">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input class='id_kategori_keterampilan' type="hidden" name="id_kategori"
                                value="Keterampilan">
                            <input class='tipe_nilai_keterampilan' type="hidden" name="tipe_menghargaipendapat"
                                value="Menghargai Pendapat">
                            <label class="col-sm-3 col-form-label font-weight-bold">Menghargai Pendapat</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control nilai_sikap_keterampilan"
                                    id="nilai_sikap_keterampilan" name="menghargaiPendapat"
                                    placeholder="Menghargai Pendapat" min="1" max="5">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input class='id_kategori_keterampilan' type="hidden" name="id_kategori"
                                value="Keterampilan">
                            <input class='tipe_nilai_keterampilan' type="hidden" name="tipe_kebenarankonsep"
                                value="Kebenaran Konsep">
                            <label class="col-sm-3 col-form-label font-weight-bold">Kebenaran Konsep</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control nilai_sikap_keterampilan"
                                    id="nilai_sikap_keterampilan" name="kebenaranKonsep" placeholder="Kebenaran Konsep"
                                    min="1" max="5">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input class='id_kategori_keterampilan' type="hidden" name="id_kategori"
                                value="Keterampilan">
                            <input class='tipe_nilai_keterampilan' type="hidden" name="tipe_kerjasama"
                                value="Kerjasama">
                            <label class="col-sm-3 col-form-label font-weight-bold">Kerjasama</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control nilai_sikap_keterampilan"
                                    id="nilai_sikap_keterampilan" name="kerjasama" placeholder="Kerjasama" min="1"
                                    max="5">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input class='id_kategori_keterampilan' type="hidden" name="id_kategori"
                                value="Keterampilan">
                            <input class='tipe_nilai_keterampilan' type="hidden" name="tipe_keaktifan"
                                value="Keaktifan">
                            <label class="col-sm-3 col-form-label font-weight-bold">Keaktifan</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control nilai_sikap_keterampilan"
                                    id="nilai_sikap_keterampilan" name="keaktifan" placeholder="Keaktifan" min="1"
                                    max="5">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="simpanNilaiKeterampilan" class="btn btn-primary">Save changes</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalAlertNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pemberitahuan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm">
                    <div class="alert alert-primary" role="alert">
                        Data nilai sudah dimasukkan sebelumnya, silahkan pilih menu Edit Nilai untuk mengedit nilai
                        sebelumnya
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Oke</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalPenilaianSikap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penilaian Sikap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="col-sm">

                    <input type="hidden" name="id_siswa" id="id_siswa_modal">
                    <div class="alert alert-primary" role="alert">
                        Silahkan isi nilai sikap berdasarkan kriteria :
                        <br>4 = Sangat Baik
                        <br>3 = Baik
                        <br>2 = Cukup
                        <br>1 = Kurang
                    </div>
                    <form action="/storeNilaiSikapKeterampilan" name="form_nilai_sikap" id="form_nilai_sikap">
                        <div class="form-group row">
                            <input class='id_kategori_sikap' type="hidden" name="id_kategori" value="Sikap">
                            <input class='tipe_nilai_sikap' type="hidden" name="tipe_rasa_ingin_tau"
                                value="Rasa Ingin Tau">
                            <label class="col-sm-3 col-form-label font-weight-bold">Rasa Ingin Tau</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control nilai_sikap" id="nilai_sikap"
                                    name="nilai_sikap" placeholder="Rasa Ingin Tau" min="1" max="4">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input class='id_kategori_sikap' type="hidden" name="id_kategori" value="Sikap">
                            <input class='tipe_nilai_sikap' type="hidden" name="tipe_teliti" value="Teliti">
                            <label class="col-sm-3 col-form-label font-weight-bold">Teliti</label>
                            <div class="col-sm-9">
                                <input type="number" min="1" max="4" class="form-control nilai_sikap" id="nilai_sikap"
                                    name="nilai_sikap" placeholder="Teliti">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input class='id_kategori_sikap' type="hidden" name="id_kategori" value="Sikap">
                            <input class='tipe_nilai_sikap' type="hidden" name="tipe_disiplin" value="Disiplin">
                            <label class="col-sm-3 col-form-label font-weight-bold">Disiplin</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control nilai_sikap" id="nilai_sikap"
                                    name="nilai_sikap" placeholder="Disiplin" min="1" max="4">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input class='id_kategori_sikap' type="hidden" name="id_kategori" value="Sikap">
                            <input class='tipe_nilai_sikap' type="hidden" name="tipe_tanggung_jawab"
                                value="Tanggung Jawab">
                            <label class="col-sm-3 col-form-label font-weight-bold">Tanggung Jawab</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control nilai_sikap" id="nilai_sikap"
                                    name="nilai_sikap" placeholder="Tanggung Jawab" min="1" max="4">
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="simpanNilaiSikap" class="btn btn-primary">Save changes</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalTambahDeskripsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deskripsi Raport</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="col-sm">

                    <input name="id_siswa_deskripsi" hidden id="id_siswa_deskripsi">
                    <div class="alert alert-primary" role="alert">
                        Silahkan isi deskripsi nilai! Deskripsi ini akan ditampilkan pada raport siswa sebagai bahan
                        evaluasi :
                    </div>
                    <label class="col-form-label font-weight-bold">Deskripsi</label>
                    <div class="form-group row">
                        <input class='id_kategori_deskripsi' name="id_kategori_deskripsi" id='id_kategori_deskripsi'
                            value="" hidden>
                        <input class='tipe_nilai_deskripsi' name="tipe_nilai_deskripsi" id='tipe_nilai_deskripsi'
                            value="Deskripsi" hidden>
                        <textarea class="col-sm form-control rounded-0" id="deskripsi" name="deskripsi"
                            placeholder="Deskripsi raport siswa" value="" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="simpanDeskripsi" class="btn btn-primary simpanDeskripsi">Save changes</button>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        
        $("#formBobotNilaiSimpan").validate({
            rules: {
                kkm: {
                    required: true,
                },
                ulanganHarian: {
                    required: true,
                },
                uts: {
                    required: true,
                },
                uas: {
                    required: true,
                }
            },
            messages: {
                kkm: {
                    required: 'Silahkan isi kkm!',
                },
                ulanganHarian: {
                    required: 'Silahkan isi bobot ulangan harian!',
                },
                uts: {
                    required: 'Silahkan isi bobot uts!',
                },
                uas: {
                    required: 'Silahkan isi bobot uas!',
                }
            },

            submitHandler: function (form) {
                form.submit();
            }
        });

        $("#formBobotNilaiUpdate").validate({
            rules: {
                kkm: {
                    required: true,
                },
                ulanganHarian: {
                    required: true,
                },
                uts: {
                    required: true,
                },
                uas: {
                    required: true,
                }
            },
            messages: {
                kkm: {
                    required: 'Silahkan isi kkm!',
                },
                ulanganHarian: {
                    required: 'Silahkan isi bobot ulangan harian!',
                },
                uts: {
                    required: 'Silahkan isi bobot uts!',
                },
                uas: {
                    required: 'Silahkan isi bobot uas!',
                }
            },

            submitHandler: function (form) {
                form.submit();
            }
        });

        $(document).on('click', '.submitBobotNilai', function () {
            if ($('#kkm').text() == null || $('#ulanganHarian').text() == null || $('#uts').text() ==
                null || $('#uas').text() == null) {
                alert('Silahkan lengkapi data!');
            }

            // console.log(id);
        });

        // if ($('#kkm').val() == null) {
        //     $("#submitBobotNilai").show();
        // }


        // $(document).on('click', '#tombolEditBobotNilai', function () {
        //     if ($('#kkm').is('[readonly]')) {
        //         $('#kkm').prop('readonly', false);
        //         $('#ulanganHarian').prop('readonly', false);
        //         $('#uts').prop('readonly', false);
        //         $('#uas').prop('readonly', false);
        //         $("#updateBobotNilai").show();
        //         $("#updateBobotNilai").css("display", "show");


        //     } else {
        //         $('#kkm').prop('readonly', true);
        //         $('#ulanganHarian').prop('readonly', true);
        //         $('#uts').prop('readonly', true);
        //         $('#uas').prop('readonly', true);
        //         $("#updateBobotNilai").css("display", "none");

        //     }
        // });

        $("#form_nilai_sikap").validate({
            rules: {
                nilai_sikap: {
                    required: true,
                    minlength: 1,
                    maxlength: 4,
                    digits: true
                }
            },
            messages: {
                nilai_sikap: "Silahkan isi nilai 1 sampai 4!",
            },

            submitHandler: function (form) {}
        });

        $('#simpanNilaiSikap').on('click', function () {
            if ($("#form_nilai_sikap").valid()) {
                var id = $('#id_siswa_modal').val();
                var idkategori = new Array();
                var tipenilai = new Array();
                var nilai = new Array();

                $('.tipe_nilai_sikap').each(function () {
                    tipenilai.push($(this).val());
                });
                $('.id_kategori_sikap').each(function () {
                    idkategori.push($(this).val());
                });
                $('.nilai_sikap').each(function () {
                    if ($(this).val() != '') {
                        nilai.push($(this).val());
                    }
                });
                // console.dir(idsiswa);

                $.ajax({
                    url: '/storeNilaiSikapKeterampilan/',
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id_siswa_modal': id,
                        'tipe_nilai': tipenilai,
                        'id_kategori': idkategori,
                        'nilai_sikap': nilai,
                    },

                    success: function (data) {
                        if (data == 'true') {
                            alert('Data nilai berhasil disimpan!');
                            window.location.replace("/penilaian_akademik");
                        } else {
                            alert('Silahkan isi semua data');
                        }
                    }
                });
            } else {
                alert('Silahkan isi angka 1 sampai 4!');
            }

        });

        $("#form_nilai_keterampilan").validate({
            rules: {
                nilai_sikap_keterampilan: {
                    required: true,
                    minlength: 1,
                    maxlength: 5,
                    digits: true
                }
            },
            messages: {
                nilai_sikap_keterampilan: "Silahkan isi nilai 1 sampai 5!",
            },

            submitHandler: function (form) {}
        });

        $('#simpanNilaiKeterampilan').on('click', function () {
            if ($("#form_nilai_keterampilan").valid()) { // test for validity
                // do stuff if form is valid
                var id = $('#id_siswa_modal_keterampilan').val();
                var idkategori = new Array();
                var tipenilai = new Array();
                var nilai = new Array();

                $('.tipe_nilai_keterampilan').each(function () {
                    tipenilai.push($(this).val());
                });
                $('.id_kategori_keterampilan').each(function () {
                    idkategori.push($(this).val());
                });
                $('.nilai_sikap_keterampilan').each(function () {
                    if ($(this).val() != '') {
                        nilai.push($(this).val());
                    }
                });

                $.ajax({
                    url: '/storeNilaiSikapKeterampilan/',
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: {
                        'id_siswa_modal': id,
                        'tipe_nilai': tipenilai,
                        'id_kategori': idkategori,
                        'nilai_sikap': nilai,
                    },

                    success: function (data) {
                        if (data == 'true') {
                            alert('Data nilai berhasil disimpan!');
                            window.location.replace("/penilaian_akademik");
                        } else {
                            alert('Silahkan isi semua data');
                        }
                    }
                });
            } else {
                // do stuff if form is not valid
                alert('Silahkan isi angka 1 sampai 5!');
            }



            // console.dir(idsiswa);
        });

        $(document).on('click', '.submitBobotNilai2', function () {
            var id = $(this).data('id');
            var $kkm = $('#kkm').val();
            var $ulanganharian = $('#ulanganHarian').val();
            var $uts = $('#uts').val();
            var $uas = $('#uas').val();
            var totalbobot = $ulanganharian + $uts + $uas;

            if ($kkm > 100) {
                alert('Maaf silahkan masukkan kkm dibawah 100');
            }
            if ($totalbobot > 100) {
                alert('Maaf silahkan masukkan bobot dibawah 100%');
            }


            // console.log(id);
        });


        $(document).on('click', '.tombolTambahNilaiUlangan', function () {
            $('#modalPenilaianUTS').modal('show');
            var id = $(this).data('id');

            $('#id_siswa_modal').val(id);
            // $.ajax({
            //     url: "/getCountNilaiUjian",
            //     data: {
            //         'id_user_siswa': id,
            //         'id_mata_pelajaran': $('#id_matapelajaran').html(),
            //         'tipe_nilai': tipe_nilai,
            //     },
            //     dataType: 'json',
            //     success: function (data) {
            //         var hasil = data;
            //         if (hasil == '0') {
            //             $('#modalPenilaianUTS').modal('show');
            //         } else {
            //             $('#modalAlertNilai').modal('show');
            //             // alert('Anda telah mengisi nilai ini');

            //         }
            //     }
            // });

            // console.log(id);
        });

        $("#form_nilai").validate({
            rules: {
                nilai: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                    number: true
                }
            },
            messages: {
                nilai: {
                    maxlength: "Silahkan isi nilai 1 sampai 100!",
                    minlength: "Silahkan isi nilai 1 sampai 100!",
                    required: "Silahkan isi nilai!",
                }
            },

            submitHandler: function (form) {}
        });

        $(document).on('click', '.tombolSimpanNilaiUjian', function () {
            if ($("#form_nilai").valid()) {
                var kategori = "Pengetahuan";
                $.ajax({
                    url: "/storeNilaiSekolah",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: {
                        'id_siswa': $('#id_siswa_modal').val(),
                        'id_kategori': kategori,
                        'tipe_nilai_dropdown': $('#tipe_nilai_dropdown option:selected').text(),
                        'nilai': $('#nilai').val(),
                    },

                    success: function (data) {
                        var hasil = data;
                        console.log(hasil);
                        if (hasil == 'true') {
                            alert('Anda berhasil menambahkan nilai');
                            $('#modalPenilaianUTS').modal('toggle');
                        }
                        if (hasil == 'false') {
                            alert(
                                'Data nilai sudah dimasukkan sebelumnya, silahkan pilih menu Edit Nilai untuk mengubah nilai siswa!'
                            );
                        }
                        // window.location.href = "/penilaian_asrama";
                    }
                });
            } else {
                alert('Silahkan masukkan angka 1 sampai 100!');
            }


        });
        $(document).on('click', '.tombolTambahNilaiKeterampilan', function () {
            var id = $(this).data('id');
            var tipe_kategori = "Keterampilan";
            $('#id_siswa_modal_keterampilan').val(id);
            $.ajax({
                url: "/getCountNilaiUjianKategori",
                data: {
                    'id_user_siswa': id,
                    'id_mata_pelajaran': $('#id_matapelajaran').html(),
                    'id_kategori': tipe_kategori,
                },
                dataType: 'json',
                success: function (data) {
                    var hasil = data;
                    console.log(hasil);
                    if (hasil > 0) {
                        $('#modalAlertNilai').modal('show');
                    }
                    if (hasil == '0') {
                        $('#modalPenilaianKeterampilan').modal('show');
                    }
                    // else {

                    //     // alert('Anda telah mengisi nilai ini');

                    // }
                }
            });
            console.log(id);
        });
        $(document).on('click', '.tombolTambahNilaiSikap', function () {

            var id = $(this).data('id');
            var tipe_kategori = "Sikap";
            $('#id_siswa_modal').val(id);
            $.ajax({
                url: "/getCountNilaiUjianKategori",
                data: {
                    'id_user_siswa': id,
                    'id_mata_pelajaran': $('#id_matapelajaran').html(),
                    'id_kategori': tipe_kategori,
                },
                dataType: 'json',
                success: function (data) {
                    var hasil = data;
                    if (hasil > 0) {
                        $('#modalAlertNilai').modal('show');
                    }
                    if (hasil == '0') {
                        $('#modalPenilaianSikap').modal('show');
                    }
                }
            });
            console.log(id);
        });

        $(document).on('click', '.simpanDeskripsi', function () {

            $.ajax({
                url: "/storeDeskripsiRaport",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                data: {
                    'id_siswa': $('#id_siswa_deskripsi').val(),
                    'id_kategori': $('#id_kategori_deskripsi').val(),
                    'deskripsi': $('#deskripsi').val(),
                },

                success: function (data) {
                    var hasil = data;
                    console.log(hasil);
                    if (hasil == 'true') {
                        alert('Anda berhasil menambahkan deskripsi');
                        $('#modalTambahDeskripsi').modal('hide');
                        // $('#modalPenilaianUTS').modal('toggle');
                    }
                    // window.location.href = "/penilaian_asrama";
                }
            });

        });

        $(document).on('click', '.deskripsiRaportKeterampilan', function () {
            var id = $(this).data('id');
            var tipe_kategori = "Keterampilan";
            var tipe = "Deskripsi";
            $('#id_siswa_deskripsi').val(id);
            $('#id_kategori_deskripsi').val(tipe_kategori);
            $.ajax({
                url: "/getCountDeskripsi",
                data: {
                    'id_user_siswa': id,
                    'id_mata_pelajaran': $('#id_matapelajaran').html(),
                    'id_kategori': tipe_kategori,
                    'tipe': tipe,
                },
                dataType: 'json',
                success: function (data) {
                    var hasil = data;
                    if (hasil > 0) {
                        $('#modalAlertNilai').modal('show');
                    }
                    if (hasil == '0') {
                        $('#modalTambahDeskripsi').modal('show');
                    }
                }
            });
            console.log(id);
        });


        $(document).on('click', '.deskripsiRaportSikap', function () {
            var id = $(this).data('id');
            var tipe_kategori = "Sikap";
            var tipe = "Deskripsi";
            $('#id_siswa_deskripsi').val(id);
            $('#id_kategori_deskripsi').val(tipe_kategori);
            $.ajax({
                url: "/getCountDeskripsi",
                data: {
                    'id_user_siswa': id,
                    'id_mata_pelajaran': $('#id_matapelajaran').html(),
                    'id_kategori': tipe_kategori,
                    'tipe': tipe,
                },
                dataType: 'json',
                success: function (data) {
                    var hasil = data;
                    if (hasil > 0) {
                        $('#modalAlertNilai').modal('show');
                    }
                    if (hasil == '0') {
                        $('#modalTambahDeskripsi').modal('show');
                    }
                }
            });
            console.log(id);
        });

        $(document).on('click', '.deskripsiRaportPengetahuan', function () {
            var id = $(this).data('id');
            var tipe_kategori = "Pengetahuan";
            var tipe = "Deskripsi";
            $('#id_siswa_deskripsi').val(id);
            $('#id_kategori_deskripsi').val(tipe_kategori);
            $.ajax({
                url: "/getCountDeskripsi",
                data: {
                    'id_user_siswa': id,
                    'id_mata_pelajaran': $('#id_matapelajaran').html(),
                    'id_kategori': tipe_kategori,
                    'tipe': tipe,
                },
                dataType: 'json',
                success: function (data) {
                    var hasil = data;
                    if (hasil > 0) {
                        $('#modalAlertNilai').modal('show');
                    }
                    if (hasil == '0') {
                        $('#modalTambahDeskripsi').modal('show');
                    }
                }
            });
            console.log(id);
        });

        $('#pilih_kelas').on('click', function () {
            var nama_kelas = $('#students_class_name option:selected').val();
            if (nama_kelas) {
                $.ajax({
                    url: '/penilaian/' + nama_kelas,
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
                                ' </td><td><button type="button" class="btn btn-primary tombolTambahNilaiUlangan" id="' +
                                value.id_user + '" data-id="' + value.id_user +
                                '" value="' + value.id_user +
                                '"> <i class="fas fa-plus-square text-center mr-1" style="color: white"></i>Tambah Nilai</button><td><button type="button" class="btn btn-primary deskripsiRaportPengetahuan" id="' +
                                value.id_user + '" data-id="' + value.id_user +
                                '" value="' + value.id_user +
                                '"> <i class="fas fa-plus-square text-center mr-1" style="color: white"></i>Deskripsi Raport</button></td></tr>';

                            markup2 += '<tr> <td> ' + no_tabel + ' </td> <td> ' +
                                value.id_user + ' </td><td> ' + value.nama_siswa +
                                ' </td><td> ' + value.nama_kelas +
                                ' </td><td><button type="button" class="btn btn-primary tombolTambahNilaiSikap" id="' +
                                value.id_user + '" data-id="' + value.id_user +
                                '" value="' + value.id_user +
                                '"> <i class="fas fa-plus-square text-center mr-1" style="color: white"></i>Tambah Nilai</button><td><button type="button" class="btn btn-primary deskripsiRaportSikap" id="' +
                                value.id_user + '" data-id="' + value.id_user +
                                '" value="' + value.id_user +
                                '"> <i class="fas fa-plus-square text-center mr-1" style="color: white"></i>Deskripsi Raport</button></td></tr>';

                            markup3 += '<tr> <td> ' + no_tabel + ' </td> <td> ' +
                                value.id_user + ' </td><td> ' + value.nama_siswa +
                                ' </td><td> ' + value.nama_kelas +
                                ' </td><td><button type="button" class="btn btn-primary tombolTambahNilaiKeterampilan" id="' +
                                value.id_user + '" data-id="' + value.id_user +
                                '" value="' + value.id_user +
                                '"> <i class="fas fa-plus-square text-center mr-1" style="color: white"></i>Tambah Nilai</button><td><button type="button" class="btn btn-primary deskripsiRaportKeterampilan" id="' +
                                value.id_user + '" data-id="' + value.id_user +
                                '" value="' + value.id_user +
                                '"> <i class="fas fa-plus-square text-center mr-1" style="color: white"></i>Deskripsi Raport</button></td></tr>';
                        });
                        $('#penilaian_materi tbody').html(markup);
                        $('#penilaian_sikap tbody').html(markup2);
                        $('#penilaian_keterampilan tbody').html(markup3);

                    }
                });
            }
        });
    })

</script>
@endsection
