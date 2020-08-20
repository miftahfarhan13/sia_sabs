<?php

namespace App\Http\Controllers;

use App\m_presensiSekolah;
use Illuminate\Http\Request;
use DB;
use Auth;

class c_presensiSekolah extends Controller
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

        $jadwalmengajarguru = DB::table('kelas')->select('nama_kelas')->get();

        $daftarsakit = DB::table('surat_sakits')
        ->join('siswas', 'siswas.id_user','=','surat_sakits.id_siswa')
        ->join('guru_asramas', 'guru_asramas.nik_guruasrama','=','surat_sakits.id_user_guruasrama')
        ->where('surat_sakits.tanggal', date('Y-m-d'))->get();

        $daftarpresensi = DB::table('hari_presensi_sekolahs')
        ->join('siswas', 'siswas.id_user','=','hari_presensi_sekolahs.id_siswa')
        ->where('tanggal', date('Y-m-d'))->get();

        return view('presensi_sekolah', ['tahunajaran'=>$tahunajaran,'jadwalmengajarguru'=>$jadwalmengajarguru, 'daftarsakit'=>$daftarsakit, 'daftarpresensi'=>$daftarpresensi  ]);
    }

    public function indexHasilPresensi()
    {   
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        
        return view('/hasil_presensi',['tahunajaran'=>$tahunajaran, 'semester'=>$semester]);
    }

    public function get_siswa($nama_kelas){
        $siswa = DB::table('kelas_memiliki_siswas')
        ->join('siswas', 'siswas.id_user','=','kelas_memiliki_siswas.id_siswa')
        ->join('kelas', 'kelas.kode_kelas','=','kelas_memiliki_siswas.kode_kelas')
        ->where('kelas.nama_kelas',$nama_kelas)->get();
        return response()->json($siswa);
    }

    public function get_siswa_count($nama_kelas){
        $siswa = DB::table('kelas_memiliki_siswas')
        ->join('siswas', 'siswas.id_user','=','kelas_memiliki_siswas.id_siswa')
        ->join('kelas', 'kelas.kode_kelas','=','kelas_memiliki_siswas.kode_kelas')
        ->where('kelas.nama_kelas',$nama_kelas)->count();
        return $siswa;
    }

    public function get_data_presensi_sekolah($nama_kelas){
        $siswa = DB::table('hari_presensi_sekolahs')
        ->join('siswas', 'siswas.id_user','=','hari_presensi_sekolahs.id_siswa')
        ->where('hari_presensi_sekolahs.kelas',$nama_kelas)
        ->where('tanggal', date('Y-m-d'))->count();
        return $siswa;
    }

    public function storePresensiSekolah(Request $request, $nama_kelas){
        $idsiswa = $request->get('id_user_siswa');
        $keterangan = $request->get('keterangan');
        $namakelas = $request->get('nama_kelas');

        $getCountSiswa = $this->get_siswa_count($nama_kelas);
        $size = count((array)$request->get('keterangan'));

        if($getCountSiswa == $size){
            foreach ($idsiswa as $key => $value) {
                $this->simpanPresensiSekolah($idsiswa[$key], $namakelas[$key], $keterangan[$key]);
            }
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }
    }

    public function simpanPresensiSekolah($idsiswa, $nama_kelas, $keterangan){
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');

        if($keterangan != null){
            $presensi = new m_presensiSekolah();
            $presensi->id_siswa = $idsiswa;
            $presensi->kelas = $nama_kelas;
            $presensi->keterangan = $keterangan;
            $presensi->tanggal = date('Y-m-d') ;
            $presensi->tahun_ajaran = $tahunajaran;
            $presensi->semester = $semester;
            $presensi->save();
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }
    }

    public function simpanPresensiSekolahUnit(Request $request){
        if($request->get('keterangan') != null){
            $presensi = [
                'id_siswa'=> $request->get('id_siswa'),
                'kelas'=> $request->get('kelas'),
                'keterangan'=> $request->get('keterangan'),
                'tanggal'=> $request->get('tanggal'),
                'tahun_ajaran'=>$request->get('tahun_ajaran'),
                'semester' => $request->get('semester'),
            ];
    
            return response()->json(['Data presensi berhasil diambil']);
        }else{
            return response()->json(['Silahkan isi data presensi']);
        }
    }

    public function updatePresensiSekolah(Request $request){
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
       
        DB::table('hari_presensi_sekolahs')
                ->where('id_siswa', $request->get('id_user_siswa'))
                ->where('tanggal', date('Y-m-d'))
                ->where('tahun_ajaran', $tahunajaran)
                ->where('semester', $semester)
                ->update(['keterangan' => $request->get('keterangan')]);
       
        return response()->json([true]);;
    }

    public function getDataPresensiSekolahCount($month)
    {   
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }
        
        $presensi_array = array();

        $hadir = DB::table('hari_presensi_sekolahs')
        ->where('keterangan', '=', 'Hadir' )
        ->whereMonth('tanggal', $month )
        ->where('id_siswa', $idsiswa)->count();
        $sakit =  DB::table('hari_presensi_sekolahs')
        ->where('keterangan', '=', 'Sakit' )
        ->whereMonth('tanggal', $month )
        ->where('id_siswa', $idsiswa)->count();
        $izin =  DB::table('hari_presensi_sekolahs')
        ->where('keterangan', '=', 'Izin' )
        ->whereMonth('tanggal', $month )
        ->where('id_siswa', $idsiswa)->count();
        $alpha = DB::table('hari_presensi_sekolahs')
        ->where('keterangan', '=', 'Alpha' )
        ->whereMonth('tanggal', $month )
        ->where('id_siswa', $idsiswa)->count();

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
