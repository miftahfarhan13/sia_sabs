@extends('layouts.app_sidebar')

@section('content')
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial scale = 1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <title>Hasil Presentase</title>
    <link rel="shortcut icon" href="img/group-6.png">
</head>

<body>
    <div>
        <h4 class="font-weight-bold"><i class="fa fa-chart-pie mr-4"></i>Presentase Presensi</h4>
        <hr>

        <div class="col-md-9 pl-0">
            <div>
                <div class="row">
                    <label class="col-form-label font-weight-bold col-sm-2">Tahun Ajaran</label>
                    <div class="col-sm-2">
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

            </div>
        </div>

        <div class="alert alert-primary" role="alert">
            Silahkan pilih bulan terlebih dahulu untuk menampilkan presentase presensi siswa!
        </div>

        <div class="row">
            <div class="col-sm-6 mt-2">
                <div class="card">
                    <div class="card-header">Presensi Sekolah</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 font-weight-bold">Pilih Bulan</label>

                            <div class="input-group col-sm-5">
                                <select class="custom-select" id="pilih_bulan_option_sekolah"
                                    name="pilih_bulan_option_sekolah">
                                    @if($semester = 2)
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    @else
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <button id="pilih_bulan_sekolah" class="btn btn-primary pilih_bulan_sekolah"
                                        type="button">Pilih</button>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>

                </div>

            </div>


            <div class="col-sm-6 mt-2">
                <div class="card">
                    <div class="card-header">Presensi Asrama</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 font-weight-bold">Pilih Bulan</label>
                            <div class="input-group col-sm-5">
                                <select class="custom-select pilih_bulan_option_asrama" id="pilih_bulan_option_asrama"
                                    name="">
                                    @if($semester = 2)
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    @else
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                    @endif
                                </select></td>
                                <div class="input-group-append">
                                    <button id="pilih_bulan_asrama" class="btn btn-primary pilih_bulan_asrama"
                                        type="button">Pilih</button>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <canvas id="myChartAsrama"></canvas>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</body>

</html>

<script>
    $('.pilih_bulan_asrama').on('click', function () {
        var bulan_asrama = $('#pilih_bulan_option_asrama option:selected').val();

        $.ajax({
            url: '/getDataPresensiAsramaCount/' + bulan_asrama,
            type: "GET",
            dataType: "json",
            success: function (data) {

                var hadirasrama = data.Hadir;
                var sakitasrama = data.Sakit;
                var izinasrama = data.Izin;
                var alphaasrama = data.Alpha;

                var total = hadirasrama + sakitasrama + izinasrama + alphaasrama;
                var hadirAsramaPersen = (hadirasrama / total) * 100;
                var sakirAsramaPersen = (sakitasrama / total) * 100;
                var izinAsramaPersen = (izinasrama / total) * 100;
                var alphaAsramaPersen = (alphaasrama / total) * 100;

                console.log(hadirasrama);

                if (total != 0) {
                    var myChartAsrama = document.getElementById('myChartAsrama').getContext(
                        '2d');
                    var massPopChartAsrama = new Chart(myChartAsrama, {
                        type: 'pie',
                        data: {
                            labels: ['Hadir', 'Sakit', 'Izin', 'Alpha'],
                            datasets: [{
                                label: 'Population',
                                data: [hadirAsramaPersen, sakirAsramaPersen,
                                    izinAsramaPersen,
                                    alphaAsramaPersen
                                ],
                                backgroundColor: [
                                    'rgba(77, 175, 124, 1)',
                                    'rgba(254, 241, 96, 1)',
                                    'rgba(230, 126, 34, 1)',
                                    'rgba(240, 52, 52, 1)',
                                ]
                            }],

                        },
                    })
                } else {
                    alert('Belum ada data presensi');
                }
            }
        });
    });

    $('.pilih_bulan_sekolah').on('click', function () {
        var bulan_sekolah = $('#pilih_bulan_option_sekolah option:selected').val();

        $.ajax({
            url: '/getDataPresensiSekolahCount/' + bulan_sekolah,
            type: "GET",
            dataType: "json",
            success: function (data) {
                var hadirsekolah = data.Hadir;
                var sakitsekolah = data.Sakit;
                var izinsekolah = data.Izin;
                var alphasekolah = data.Alpha;

                var total = hadirsekolah + sakitsekolah + izinsekolah + alphasekolah;
                var hadirSekolahPersen = (hadirsekolah / total) * 100;
                var sakirSekolahPersen = (sakitsekolah / total) * 100;
                var izinSekolahPersen = (izinsekolah / total) * 100;
                var alphaSekolahPersen = (alphasekolah / total) * 100;

                if (total != 0) {
                    var myChart = document.getElementById('myChart').getContext(
                        '2d');
                    var massPopChart = new Chart(myChart, {
                        type: 'pie',
                        data: {
                            labels: ['Hadir', 'Sakit', 'Izin', 'Alpha'],
                            datasets: [{
                                label: 'Population',
                                data: [hadirSekolahPersen, sakirSekolahPersen,
                                    izinSekolahPersen,
                                    alphaSekolahPersen
                                ],
                                backgroundColor: [
                                    'rgba(77, 175, 124, 1)',
                                    'rgba(254, 241, 96, 1)',
                                    'rgba(230, 126, 34, 1)',
                                    'rgba(240, 52, 52, 1)',
                                ]
                            }],

                        },


                    })
                } else {
                    alert('Belum ada data presensi');
                }


            }
        });
    });

</script>
@endsection
