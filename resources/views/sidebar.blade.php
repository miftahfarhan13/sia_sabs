<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
</a>
<style>
    .close-sidebar {
        float: right;
        justify-self: center;
        margin-top: 10px;
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

</style>
<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <!-- style="color: #296340;" -->
            <a href="home"><img src="img/logo-home.png" class="navbar-brand" href="" width="80px" height="50px"
                    alt="logo"></a>
            <div id="close-sidebar" class="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-header">

            <div class="user-info">
                <span class="user-name">{{Auth::user()->name}}
                </span>
                <p class="user-role">Anda masuk sebagai : </p>
                <span class="badge badge-pill badge-primary">{{Auth::user()->role}}</span>
                

            </div>
        </div>
        <!-- sidebar-header  -->

        <div class="sidebar-menu textcolor">
            <ul>
                <li class="header-menu">
                    <span>Menu</span>
                </li>
                <li>
                    <a href="home">
                        <i class="fa fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if(Auth::user()->role == 'Guru Sekolah')
                <li>
                    <a href="penilaian_akademik">
                        <i class="fa fa-edit"></i>
                        <span>Penilaian Akademik</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Guru Sekolah')
                <li>
                    <a href="edit_nilai">
                        <i class="fa fa-edit"></i>
                        <span>Edit Nilai</span>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role == 'Guru Sekolah')
                <li>
                    <a href="presensi_sekolah">
                        <i class="fa fa-chart-pie"></i>
                        <span>Presensi Sekolah</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Guru Asrama')
                <li>
                    <a href="penilaian_asrama">
                        <i class="fa fa-book"></i>
                        <span>Penilaian Asrama</span>

                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Guru Asrama')
                <li>
                    <a href="edit_nilai_asrama">
                        <i class="fa fa-edit"></i>
                        <span>Edit Nilai Asrama</span>

                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Guru Asrama')
                <li>
                    <a href="presensi_asrama">
                        <i class="fa fa-chart-pie"></i>
                        <span>Presensi Asrama</span>

                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Guru Asrama')
                <li>
                    <a href="surat_sakit">
                        <i class="fa fa-envelope"></i>
                        <span>Surat Sakit</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Guru Asrama')
                <li>
                    <a href="jadwal_mengajar_guruasrama">
                        <i class="fa fa-calendar-alt"></i>
                        <span>Jadwal Mengajar</span>

                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Guru Asrama')
                <li>
                    <a href="lihat_kritik_dan_saran">
                        <i class="fa fa-list"></i>
                        <span>Kritik dan Saran</span>
                    </a>
                </li>
                @endif



                @if(Auth::user()->role == 'Guru Sekolah')
                <li>
                    <a href="jadwal_mengajar_gurusekolah">
                        <i class="fa fa-calendar-alt"></i>
                        <span>Jadwal Mengajar</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Siswa')
                <li>
                    <a href="hasil_penilaianAkademik">
                        <i class="fas fa-book"></i>
                        <span>Penilaian Akademik</span>
                    </a>
                </li>
                @endif


                @if(Auth::user()->role == 'Guru Sekolah')
                <li>
                    <a href="lihat_kritik_dan_saran">
                        <i class="fa fa-list"></i>
                        <span>Kritik dan Saran</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Siswa')
                <li>
                    <a href="hasil_penilaianAsrama">
                        <i class="fas fa-book"></i>
                        <span>Penilaian Asrama</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Siswa')
                <li>
                    <a href="jadwal_mata_pelajaran">
                        <i class="fa fa-calendar-alt"></i>
                        <span>Jadwal Mata Pelajaran</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Siswa')
                <li>
                    <a href="jadwal_kegiatan_asrama">
                        <i class="fa fa-calendar-alt"></i>
                        <span>Jadwal Asrama</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Siswa')
                <li>
                    <a href="hasil_presensi">
                        <i class="fa fa-chart-pie"></i>
                        <span>Presensi</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Siswa')
                <li>
                    <a href="kritik_dan_saran_siswa">
                        <i class="fa fa-list"></i>
                        <span>Kritik dan Saran</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Orang Tua')
                <li>
                    <a href="kritik_dan_saran">
                        <i class="fa fa-edit"></i>
                        <span>Kritik dan Saran</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Orang Tua')
                <li>
                    <a href="hasil_penilaianAkademik">
                        <i class="fa fa-book"></i>
                        <span>Hasil Penilaian Akademik</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Orang Tua')
                <li>
                    <a href="hasil_penilaianAsrama">
                        <i class="fa fa-book"></i>
                        <span>Hasil Penilaian Asrama</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Orang Tua')
                <li>
                    <a href="jadwal_mata_pelajaran">
                        <i class="fa fa-calendar-alt"></i>
                        <span>Jadwal Mata Pelajaran</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Orang Tua')
                <li>
                    <a href="jadwal_kegiatan_asrama">
                        <i class="fa fa-calendar-alt"></i>
                        <span>Jadwal Kegiatan Asrama</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Orang Tua')
                <li>
                    <a href="hasil_presensi">
                        <i class="fa fa-chart-pie"></i>
                        <span>Presensi</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Admin')
                <li>
                    <a href="kelola_akun">
                        <i class="fa fa-edit"></i>
                        <span>Kelola Akun</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Admin')
                <li>
                    <a href="kelola_tahun_ajaran">
                        <i class="fa fa-edit"></i>
                        <span>Kelola Tahun Ajaran</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Admin')
                <li>
                    <a href="kelola_data_sekolah">
                        <i class="fa fa-edit"></i>
                        <span>Kelola Data Sekolah</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'Admin')
                <li>
                    <a href="kelola_data_asrama">
                        <i class="fa fa-edit"></i>
                        <span>Kelola Data Asrama</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     			document.getElementById('logout-form').submit();">
            <div class="row center">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sign Out</span>
            </div>

        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>
<!-- sidebar-wrapper  -->
<style>
    #textcolor {
        color: white;
    }

</style>
<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

</script>
<!-- page-wrapper -->
