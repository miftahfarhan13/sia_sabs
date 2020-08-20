@extends('layouts.app_sidebar')

@section('content')
<head>
    <title>Kritik dan Saran</title>
    <link rel="shortcut icon" href="img/group-6.png">
    <style>
        #form_kritik_dan_saran_simpan .error {
            color: red;
        }

    </style>
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
        <div class="container">

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
    <div class="row mt-2">
        <div class="col-md-9">
            @if($kritikdansaran->count() > 0)
            <form id="form_kritik_dan_saran" action="/updateKritikSaran" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">Kritik dan Saran</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <div class="alert alert-primary" role="alert">
                                    Silahkan isi kritik dan saran anda untuk kami, agar kami dapat meningkatkan kualitas
                                    fasilitas
                                    dan kegiatan belajar dan mengajar.
                                </div>
                                @foreach ($kritikdansaran as $kritikdansarans)
                                <div class="form-group row">

                                    <label class="col-sm-3 col-form-label font-weight-bold">Kritik</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control rounded-0" id="kritik" name="kritik"
                                            rows="5">{{ $kritikdansarans->kritik }}</textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">Saran</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control rounded-0" id="saran" name="saran"
                                            rows="5">{{ $kritikdansarans->saran }}</textarea>
                                    </div>
                                </div>

                                @endforeach
                                <input id="updateKritikSaran" type="submit" class="btn btn-primary" style="float:right;"
                                    value="Update">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @else
            <form id="form_kritik_dan_saran_simpan" action="/storeKritikSaran" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">Kritik dan Saran</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <div class="alert alert-primary" role="alert">
                                    Silahkan isi kritik dan saran anda untuk kami, agar kami dapat meningkatkan kualitas
                                    fasilitas
                                    dan kegiatan belajar dan mengajar.
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">Kritik</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control rounded-0" id="kritik_simpan" name="kritik_simpan" placeholder="Berikan Kritik Anda"
                                        value="" rows="5"></textarea>
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">Saran</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control rounded-0" id="saran_simpan" name="saran_simpan" placeholder="Berikan Saran Anda"
                                        value="" rows="5"></textarea>
                                    </div>
                                </div>

                                <input id="submitKritikSaran" type="submit" class="btn btn-primary"
                                    style="float:right;" value="Simpan">

                            </div>

                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#form_kritik_dan_saran_simpan").validate({
            rules: {
                kritik_simpan: {
                    required: true,
                },
                saran_simpan: {
                    required: true,
                }
            },
            messages: {
                kritik_simpan: {
                    required: 'Silahkan isi kritik anda!',
                },
                saran_simpan: {
                    required: 'Silahkan isi saran anda!',
                }
            },

            submitHandler: function (form) {}
        });
    })

</script>

@endsection
