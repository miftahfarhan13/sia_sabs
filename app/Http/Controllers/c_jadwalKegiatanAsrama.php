<?php

namespace App\Http\Controllers;

use App\m_kegiatanAsrama;
use App\m_materiAsrama;
use Illuminate\Http\Request;
use DB;
use Auth;

class c_jadwalKegiatanAsrama extends Controller
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
    public function index(Request $request)
    {   
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }

        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        $id_kelas = DB::table('kelas_asrama_memiliki_siswas')->where('id_siswa', $idsiswa)->value('kode_kelas_asrama');
        $idkelas = [$id_kelas, '7'];

        $jadwalkegiatan = DB::table('kegiatan_asramas')
        ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kegiatan_asramas.kode_kelas_asrama')
        ->where('kegiatan_asramas.tanggal','>=', date('Y-m-d'))
        ->whereIn('kegiatan_asramas.kode_kelas_asrama', $idkelas)->get();
        return view('jadwal_kegiatan_asrama', ['jadwalkegiatan'=>$jadwalkegiatan, 'tahunajaran'=>$tahunajaran]);

        }

    public function indexJadwalMengajarGuruAsrama(Request $request)
    {
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        $jadwalmengajarguru = DB::table('kegiatan_asramas')
        ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kegiatan_asramas.kode_kelas_asrama')
        ->where('kegiatan_asramas.tanggal','>=', date('Y-m-d'))
        ->where('id_user_guruasrama', Auth::user()->id_user)->get();
        return view('jadwal_mengajar_guruasrama', ['jadwalmengajarguru'=>$jadwalmengajarguru, 'tahunajaran'=>$tahunajaran]);
        }

    public function KelolaDataAsramaView(Request $request)
    {
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();

        $gedung = DB::table('gedungs')->get();

        $kelas = DB::table('kelas_asramas')->get();

        $guruasrama = DB::table('guru_asramas')->get();

        $kegiatanasrama = DB::table('kegiatan_asramas')
        ->join('guru_asramas', 'guru_asramas.nik_guruasrama','=','kegiatan_asramas.id_user_guruasrama')
        ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kegiatan_asramas.kode_kelas_asrama')->orderBy('tanggal', 'DESC')->get();

        $siswa = DB::table('siswas')
        ->join('gedung_memiliki_siswas', 'gedung_memiliki_siswas.id_siswa','=','siswas.id_user')
        ->join('gedungs', 'gedungs.kode_gedung','=','gedung_memiliki_siswas.kode_gedung')->get();

        return view('kelola_data_asrama', ['kegiatanasrama'=>$kegiatanasrama, 'tahunajaran'=>$tahunajaran, 'gedung'=>$gedung, 'kelas'=>$kelas, 'guruasrama'=>$guruasrama, 'siswa'=>$siswa]);
    }

    public function getKegiatanAsrama(Request $request){
        $kegiatanasrama = DB::table('kegiatan_asramas')
        ->join('guru_asramas', 'guru_asramas.nik_guruasrama','=','kegiatan_asramas.id_user_guruasrama')
        ->join('kelas_asramas', 'kelas_asramas.kode_kelas_asrama','=','kegiatan_asramas.kode_kelas_asrama')
        ->where('kegiatan_asramas.tanggal', $request->get('tanggal'))
        ->orderBy('tanggal', 'DESC')->get();   
        return $kegiatanasrama;
    }

    public function getGedungSiswa(Request $request){
        $siswa = DB::table('siswas')
        ->join('gedung_memiliki_siswas', 'gedung_memiliki_siswas.id_siswa','=','siswas.id_user')
        ->join('gedungs', 'gedungs.kode_gedung','=','gedung_memiliki_siswas.kode_gedung')
        ->where('gedungs.kode_gedung', $request->get('gedung'))->get();
        return $siswa;
    }

    public function getCountMateriAsrama($kodemateri, $kodekelas, $kategorimateri, $namamateri){
        $tahunajaran = DB::table('materi_asramas')->where('kode_materi', $kodemateri)->where('kode_kelas_asrama', $kodekelas)->where('kategori_materi', $kategorimateri)->where('nama_materi', $namamateri)->count();    
        return $tahunajaran;
    }

    public function storeMateriAsrama(Request $request){
        $kodemateri = $request->get('kode_materi');
        $kodekelas = $request->get('kode_kelas_asrama');
        $kategorimateri = $request->get('kategori_materi');
        $namamateri = $request->get('nama_materi');
        $getMateriAsrama = $this->getCountMateriAsrama($kodemateri, $kodekelas, $kategorimateri, $namamateri);

        $materiasrama = new m_materiAsrama([
            'kode_materi'=> $kodemateri,
            'kode_kelas_asrama' => $kodekelas,
            'kategori_materi' => $kategorimateri,
            'nama_materi' => $namamateri,
            
        ]);

        if($getMateriAsrama == 0){
            $materiasrama->timestamps = false;
            $materiasrama->save();
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }    
    }

    public function getCountKegiatanAsrama($idguru, $kodekelas, $namakegiatan, $tanggal, $namatempat, $jam){
        $tahunajaran = DB::table('kegiatan_asramas')
        ->where('id_user_guruasrama', $idguru)
        ->where('kode_kelas_asrama', $kodekelas)
        ->where('nama_kegiatan', $namakegiatan)
        ->where('tanggal', $tanggal)
        ->where('nama_tempat', $namatempat)
        ->where('jam', $jam)->count();    
        return $tahunajaran;
    }

    public function storeKegiatanAsrama(Request $request){
        $idguru = $request->get('id_user_guruasrama');
        $kodekelas = $request->get('kode_kelas_asrama');
        $namakegiatan = $request->get('nama_kegiatan');
        $tanggal = $request->get('tanggal');
        $namatempat = $request->get('nama_tempat');
        $jam = $request->get('jam');
        $getKegiatanAsrama = $this->getCountKegiatanAsrama($idguru, $kodekelas, $namakegiatan, $tanggal, $namatempat, $jam);

        $kegiatanasrama = new m_kegiatanAsrama([
            'id_user_guruasrama'=> $idguru,
            'kode_kelas_asrama'=> $kodekelas,
            'nama_kegiatan'=> $namakegiatan,
            'tanggal'=> $tanggal,
            'nama_tempat'=> $namatempat,
            'jam'=> $jam,
        
        ]);

        if($getKegiatanAsrama == 0){
            $kegiatanasrama->timestamps = false;
            $kegiatanasrama->save();
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }    
    }

    public function deleteKegiatanAsrama($id){
        $kegiatanasrama = m_kegiatanAsrama::findOrFail($id);
        $kegiatanasrama->delete();
        return $kegiatanasrama;
    }
    
}
