@extends('layouts.app_sidebar')

@section('content')

<head>
    <title>Kelola Tahun Ajaran</title>
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
    <h4 class="font-weight-bold"><i class="fa fa-edit mr-4"></i>Kelola Tahun Ajaran</h4>
    <hr>
    <div class="row mt-2">
        <div class="col-md-8">
            <div class="mt-2">
                <div class="card">
                    <div class="card-header font-weight-bold">Tambah Tahun Ajaran <button id="simpanTahunAjaran"
                            type="button" class="btn btn-primary simpanTahunAjaran" style="float:right;">Simpan</button>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-primary col-sm-12" role="alert">
                            Silahkan isi data tahun ajaran dengan format : ex. 2019/2020
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label font-weight-bold">Tahun Ajaran</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran"
                                    placeholder="Isi tahun ajaran">
                            </div>
                            <label class="col-sm-2 col-form-label font-weight-bold">Semester</label>
                            <div class="col-sm-3">
                                <select class="custom-select" id="semester" name="semester">
                                    <option selected disabled>Pilih Semester</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-8">
            <div class="form-row mt-2">
                <div class="col">
                    <div class="card">
                        <div class="card-header font-weight-bold">Update Tahun Ajaran</div>
                        <div class="card-body">
                            <table class="table" id="data_table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tahun Ajaran</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tahunajaran as $index => $tahun_ajarans)
                                    <tr>
                                        <th scope="row">{{$index+1}}</th>
                                        <td>{{ $tahun_ajarans->tahun_ajaran }}</td>
                                        <td>{{ $tahun_ajarans->semester }}</td>
                                        <td><select class="custom-select" id="semester_edit" name="semester_edit">
                                                <option selected disabled>{{ $tahun_ajarans->status }}</option>
                                                <option value="aktif">Aktif</option>
                                                <option value="tidak aktif">Tidak Aktif</option>
                                            </select></td>
                                        <td><button id="{{ $tahun_ajarans->id }}" data-id="{{ $tahun_ajarans->id }}"
                                                name="{{ $tahun_ajarans->id }}" type="button"
                                                class="btn btn-primary right tombolUpdateTahunAjaran">Update</button>
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
<script>
    $(document).on('click', '.simpanTahunAjaran', function () {
        $.ajax({
            url: "/store_tahun_ajaran",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'tahun_ajaran': $('#tahun_ajaran').val(),
                'semester': $('#semester option:selected').val(),
            },

            success: function (data) {
                var hasil = data;
                console.log(hasil);
                if (hasil == 'true') {
                    alert('Anda berhasil menambahkan tahun ajaran');
                    window.location.href = "/kelola_tahun_ajaran";
                    // $('#modalPenilaianUTS').modal('toggle');
                } else {
                    alert('Data tahun ajaran sudah ada pada database!');
                }
                // window.location.href = "/penilaian_asrama";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Silahkan lengkap data terlebih dahulu! Pastikan semua data terisi!');
            },
        });

    });

    $(document).on('click', '.tombolUpdateTahunAjaran', function () {
        var id = $(this).data('id');
        var status = 'tidak aktif';
        console.log(id);
        $.ajax({
            url: "/update_tahun_ajaran_tidak_aktif",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'status': status,
            },

            success: function (data) {
                $.ajax({
                    url: "/update_tahun_ajaran",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: {
                        'id': id,
                        'status': $('#semester_edit option:selected').val(),
                    },

                    success: function (data) {
                        var hasil = data;
                        console.log(id);
                        if (hasil == 'true') {
                            alert('Anda berhasil menambahkan tahun ajaran');
                            window.location.href = "/kelola_tahun_ajaran";
                            // $('#modalPenilaianUTS').modal('toggle');
                        }
                        // window.location.href = "/penilaian_asrama";
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(
                            'Silahkan lengkap data terlebih dahulu! Pastikan semua data terisi!'
                            );
                    },
                });
            },
        });
    });

</script>

@endsection
