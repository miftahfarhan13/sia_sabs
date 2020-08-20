@extends('layouts.app_sidebar')

@section('content')
<head>
    <title>Kritik dan Saran</title>
    <link rel="shortcut icon" href="img/group-6.png">
</head>

<div>
    <h4 class="font-weight-bold"><i class="fa fa-list mr-4"></i>Kritik dan Saran</h4>
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

            <div class="form-group row">

                <label class="col-form-label font-weight-bold col-sm-2">Tahun Ajaran</label>
                <div class="col-sm-10">
                    @foreach ($tahunajaran as $tahunajarans)
                    <label class="col-form-label">{{ $tahunajarans->tahun_ajaran }}</label>
                    @endforeach
                </div>
                <label class="col-sm-2 col-form-label font-weight-bold">Semester</label>
                <div class="col-sm-10">
                    @foreach ($tahunajaran as $tahunajarans)
                    <label class="col-form-label">{{ $tahunajarans->semester }}</label>
                    @endforeach
                </div>

            </div>

        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="card">
                <div class="card-header">Kritik dan Saran Orang Tua</div>
                <div class="card-body">
                    <table class="table table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kritik</th>
                                <th scope="col">Saran</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kritikdansaran as $index => $kritikdansarans)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{ $kritikdansarans->kritik }}</td>
                                <td>{{ $kritikdansarans->saran }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-header">Kritik dan Saran Siswa</div>
                <div class="card-body">
                    <table class="table table-striped" id="data_table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Kritik dan Saran</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kritikdansaransiswa as $index => $kritikdansaransiswas)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{ $kritikdansaransiswas->nama_siswa }}</td>
                                <td>{{ $kritikdansaransiswas->kritik_dan_saran }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function () {

        // $(document).on('click', '#tombolEditBobotNilai', function () {
        //     if ($('#kritik').is('[readonly]')) {
        //         $('#kritik').prop('readonly', false);
        //         $('#saran').prop('readonly', false);
        //         $("#updateKritikSaran").show();

        //     } else {
        //         $('#kritik').prop('readonly', true);
        //         $('#saran').prop('readonly', true);
        //         $("#submitKritikSaran").css("display", "none");

        //     }
        // });
    })

</script>

@endsection
