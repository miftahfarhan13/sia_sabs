<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }

        $tahunajaran2 = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');

        $siswa = DB::table('siswas')
        ->join('kelas_asrama_memiliki_siswas','kelas_asrama_memiliki_siswas.id_siswa','=','siswas.id_user')
        ->join('gedung_memiliki_siswas','gedung_memiliki_siswas.id_siswa','=','siswas.id_user')
        ->join('gedungs','gedungs.kode_gedung','=','gedung_memiliki_siswas.kode_gedung')
        ->join('kelas_asramas','kelas_asramas.kode_kelas_asrama','=','kelas_asrama_memiliki_siswas.kode_kelas_asrama')
        ->join('kelas_memiliki_siswas','kelas_memiliki_siswas.id_siswa','=','siswas.id_user')
        ->join('kelas','kelas.kode_kelas','=','kelas_memiliki_siswas.kode_kelas')
        ->where('kelas_memiliki_siswas.tahun_ajaran',  $tahunajaran2)
        ->where('kelas_memiliki_siswas.semester',  $semester)->get();

        $gurusekolah = DB::table('guru_sekolahs')
        ->join('mata_pelajarans','mata_pelajarans.kode_mapel','=','guru_sekolahs.id_mata_pelajaran')
        ->where('guru_sekolahs.id_user',  Auth::user()->id_user)->get();

        $guruasrama = DB::table('guru_asramas')
        ->join('gedungs','gedungs.id_user_guruasrama','=','guru_asramas.nik_guruasrama')
        ->where('guru_asramas.nik_guruasrama',  Auth::user()->id_user)->get();

        $siswacount = DB::table('siswas')->count();
        $gurusekolahcount = DB::table('guru_sekolahs')->count();
        $guruasramacount = DB::table('guru_asramas')->count();

        return view('home', ['siswa'=>$siswa, 'gurusekolah'=>$gurusekolah,'guruasrama'=>$guruasrama, 'siswacount'=>$siswacount, 'gurusekolahcount'=>$gurusekolahcount, 'guruasramacount'=>$guruasramacount]);
    }
}
