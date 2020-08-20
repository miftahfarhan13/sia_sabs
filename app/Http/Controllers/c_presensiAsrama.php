<?php

namespace App\Http\Controllers;


use App\m_presensiAsrama;
use Illuminate\Http\Request;
use DB;
use Auth;

class c_presensiAsrama extends Controller
{
    //
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
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();

        
        $kegiatan = DB::table('kegiatan_asramas')->select('kegiatan_asramas.id', 'kegiatan_asramas.nama_kegiatan', 'kegiatan_asramas.tanggal', 'kegiatan_asramas.nama_tempat', 'kegiatan_asramas.jam', 'kelas_asramas.nama_kelas_asrama')
        ->join('siswa_menghadiri_kegiatan_asramas', 'siswa_menghadiri_kegiatan_asramas.id_kegiatan','!=','kegiatan_asramas.id')
        ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kegiatan_asramas.kode_kelas_asrama')
        ->where('kegiatan_asramas.tanggal', date('Y-m-d'))
        ->orderBy('kegiatan_asramas.tanggal', 'DESC')->orderBy('jam', 'ASC')->distinct()->get();

        $editkegiatan = DB::table('kegiatan_asramas')->select('kegiatan_asramas.id', 'kegiatan_asramas.nama_kegiatan', 'kegiatan_asramas.tanggal', 'kegiatan_asramas.nama_tempat', 'kegiatan_asramas.jam', 'kelas_asramas.nama_kelas_asrama')
        ->join('siswa_menghadiri_kegiatan_asramas', 'siswa_menghadiri_kegiatan_asramas.id_kegiatan','=','kegiatan_asramas.id')
        ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kegiatan_asramas.kode_kelas_asrama')
        ->where('kegiatan_asramas.tanggal', date('Y-m-d'))
        ->where('siswa_menghadiri_kegiatan_asramas.id_user_guruasrama', Auth::user()->id_user)->distinct()->get();

        return view('presensi_asrama', ['tahunajaran'=>$tahunajaran, 'kegiatan'=>$kegiatan,  'editkegiatan'=>$editkegiatan ]);
    }

    
    public function getDataSiswa(Request $request){
        $namagedung = DB::table('gedungs')->where('id_user_guruasrama', Auth::user()->id_user)->value('nama_gedung');
        $siswaasrama = DB::table('kelas_asrama_memiliki_siswas')
        ->join('siswas','siswas.id_user','=','kelas_asrama_memiliki_siswas.id_siswa')
        ->join('gedung_memiliki_siswas','gedung_memiliki_siswas.id_siswa','=','kelas_asrama_memiliki_siswas.id_siswa')
        ->join('gedungs','gedungs.kode_gedung','=','gedung_memiliki_siswas.kode_gedung')
        ->join('kelas_asramas','kelas_asramas.kode_kelas_asrama','=','kelas_asrama_memiliki_siswas.kode_kelas_asrama')
        ->where('kelas_asramas.nama_kelas_asrama',  $request->get('nama_kelas'))
        ->where('gedungs.nama_gedung','=', $namagedung)->get();
        return response()->json($siswaasrama);
    }

    public function get_kegiatan(Request $request){
        $kegiatan = DB::table('kegiatan_asramas')->select('kegiatan_asramas.id', 'kegiatan_asramas.nama_kegiatan', 'kegiatan_asramas.tanggal', 'kegiatan_asramas.nama_tempat', 'kegiatan_asramas.jam', 'kelas_asramas.nama_kelas_asrama')
        ->join('siswa_menghadiri_kegiatan_asramas', 'siswa_menghadiri_kegiatan_asramas.id_kegiatan','!=','kegiatan_asramas.id')
        ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kegiatan_asramas.kode_kelas_asrama')
        ->where('kegiatan_asramas.tanggal', $request->get('tanggal'))
        ->orderBy('kegiatan_asramas.tanggal', 'DESC')->orderBy('jam', 'ASC')->distinct()->get();
        return response()->json($kegiatan);
    }

    public function get_kegiatan_edit(Request $request){
        $editkegiatan = DB::table('kegiatan_asramas')->select('kegiatan_asramas.id', 'kegiatan_asramas.nama_kegiatan', 'kegiatan_asramas.tanggal', 'kegiatan_asramas.nama_tempat', 'kegiatan_asramas.jam', 'kelas_asramas.nama_kelas_asrama')
        ->join('siswa_menghadiri_kegiatan_asramas', 'siswa_menghadiri_kegiatan_asramas.id_kegiatan','=','kegiatan_asramas.id')
        ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kegiatan_asramas.kode_kelas_asrama')
        ->where('kegiatan_asramas.tanggal', $request->get('tanggal'))
        ->where('siswa_menghadiri_kegiatan_asramas.id_user_guruasrama', Auth::user()->id_user)->distinct()->get();
        return response()->json($editkegiatan);
    }

    public function get_data_presensi(Request $request){
        $kegiatan = DB::table('siswa_menghadiri_kegiatan_asramas')->select('siswa_menghadiri_kegiatan_asramas.id', 'siswa_menghadiri_kegiatan_asramas.id_user_siswa', 'siswas.nama_siswa', 'kelas_asramas.nama_kelas_asrama', 'siswa_menghadiri_kegiatan_asramas.keterangan')
        ->join('siswas', 'siswas.id_user','=','siswa_menghadiri_kegiatan_asramas.id_user_siswa')
        ->join('kegiatan_asramas', 'kegiatan_asramas.id','=','siswa_menghadiri_kegiatan_asramas.id_kegiatan')
        ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kegiatan_asramas.kode_kelas_asrama')
        ->where('siswa_menghadiri_kegiatan_asramas.id_kegiatan', $request->get('id_kegiatan'))
        ->where('siswa_menghadiri_kegiatan_asramas.id_user_guruasrama', Auth::user()->id_user)->get();
        return response()->json($kegiatan);
    }

    // public function get_data_kegiatan(Request $request){
        
    //     $kegiatan = DB::table('kegiatan_asramas')->select('kegiatan_asramas.id_kegiatan', 'kegiatan_asramas.nama_kegiatan', 'kegiatan_asramas.tanggal', 'kegiatan_asramas.nama_tempat', 'kegiatan_asramas.jam', 'kelas_asramas.nama_kelas_asrama')
    //     ->join('siswa_menghadiri_kegiatan_asramas', 'siswa_menghadiri_kegiatan_asramas.id_kegiatan','=','kegiatan_asramas.id_kegiatan')
    //     ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kegiatan_asramas.kode_kelas_asrama')->distinct()->get();
    //     return response()->json($kegiatan);
    // }

    public function get_data_presensi_count(Request $request){
        $datapresensi = DB::table('siswa_menghadiri_kegiatan_asramas')->where('id_kegiatan', $request->get('id_kegiatan'))->where('id_user_guruasrama', Auth::user()->id_user)->count();
        return $datapresensi;
    }
    
    public function get_siswa_asrama_count($nama_kelas){
        $siswa = DB::table('kelas_asrama_memiliki_siswas')
        ->join('siswas', 'siswas.id_user','=','kelas_asrama_memiliki_siswas.id_siswa')
        ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kelas_asrama_memiliki_siswas.kode_kelas_asrama')
        ->where('kelas_asramas.nama_kelas_asrama',$nama_kelas)->count();
        return $siswa;
    }

    public function storePresensiAsrama(Request $request){
        $idsiswa = $request->get('id_user_siswa');
        $keterangan = $request->get('keterangan');
        $namakelas = $request->get('nama_kelas');
        $idkegiatan = $request->get('id_kegiatan');

        $getCountSiswa = $this->get_siswa_asrama_count($namakelas);
        $size = count((array)$request->get('keterangan'));

        if($getCountSiswa == $size){
            foreach ($idsiswa as $key => $value) {
                $presensi = new m_presensiAsrama();
                $presensi->id_user_siswa = $value;
                $presensi->id_user_guruasrama = Auth::user()->id_user;
                $presensi->id_kegiatan = $idkegiatan[$key];
                $presensi->keterangan = $keterangan[$key];
                $presensi->save();
            }
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }
    }

    public function updatePresensiAsrama(Request $request){
       
        DB::table('siswa_menghadiri_kegiatan_asramas')
                ->where('id', $request->get('id'))
                ->update(['keterangan' => $request->get('keterangan')]);
       
        return response()->json([true]);;
    }
    public function getDataPresensiAsramaCount($month)
    {   
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }

        $presensi_array = array();

        $hadir = DB::table('siswa_menghadiri_kegiatan_asramas')
        ->join('kegiatan_asramas', 'kegiatan_asramas.id','=','siswa_menghadiri_kegiatan_asramas.id_kegiatan')
        ->where('siswa_menghadiri_kegiatan_asramas.keterangan', '=', 'Hadir' )
        ->whereMonth('kegiatan_asramas.tanggal', $month )
        ->where('siswa_menghadiri_kegiatan_asramas.id_user_siswa',  $idsiswa)->count();
        $sakit = DB::table('siswa_menghadiri_kegiatan_asramas')
        ->join('kegiatan_asramas', 'kegiatan_asramas.id','=','siswa_menghadiri_kegiatan_asramas.id_kegiatan')
        ->where('siswa_menghadiri_kegiatan_asramas.keterangan', '=', 'Sakit' )
        ->where('siswa_menghadiri_kegiatan_asramas.id_user_siswa',  $idsiswa)
        ->whereMonth('kegiatan_asramas.tanggal', $month )->count();
        $izin = DB::table('siswa_menghadiri_kegiatan_asramas')
        ->join('kegiatan_asramas', 'kegiatan_asramas.id','=','siswa_menghadiri_kegiatan_asramas.id_kegiatan')
        ->where('siswa_menghadiri_kegiatan_asramas.keterangan', '=', 'Izin' )
        ->where('siswa_menghadiri_kegiatan_asramas.id_user_siswa',  $idsiswa)
        ->whereMonth('kegiatan_asramas.tanggal', $month )->count();
        $alpha = DB::table('siswa_menghadiri_kegiatan_asramas')
        ->join('kegiatan_asramas', 'kegiatan_asramas.id','=','siswa_menghadiri_kegiatan_asramas.id_kegiatan')
        ->where('siswa_menghadiri_kegiatan_asramas.keterangan', '=', 'Alpha' )
        ->where('siswa_menghadiri_kegiatan_asramas.id_user_siswa',  $idsiswa)
        ->whereMonth('kegiatan_asramas.tanggal', $month )->count();

        $hadir = json_decode($hadir);
        $sakit = json_decode($sakit);
        $izin = json_decode($izin);
        $alpha = json_decode($alpha);
        
        $presensi_array['Hadir']=  $hadir;
        $presensi_array['Sakit']=  $sakit;
        $presensi_array['Izin']=  $izin;
        $presensi_array['Alpha']=  $alpha;
        $presensi_array = json_encode($presensi_array);
        return $presensi_array;
        
    }
}
