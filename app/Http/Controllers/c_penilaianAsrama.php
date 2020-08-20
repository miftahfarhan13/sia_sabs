<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\m_nilaiAsrama;
use Illuminate\Support\Facades\Auth;

class c_penilaianAsrama extends Controller
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
        $guruasrama = DB::table('guru_asramas')->join('gedungs','gedungs.id_user_guruasrama','=','guru_asramas.nik_guruasrama')->where('nik_guruasrama', Auth::user()->id_user)->get();
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        
        $namagedung = DB::table('gedungs')->where('id_user_guruasrama', Auth::user()->id_user)->value('nama_gedung');
        $siswaasrama = DB::table('kelas_asrama_memiliki_siswas')
        ->join('siswas','siswas.id_user','=','kelas_asrama_memiliki_siswas.id_siswa')
        ->join('gedung_memiliki_siswas','gedung_memiliki_siswas.id_siswa','=','kelas_asrama_memiliki_siswas.id_siswa')
        ->join('gedungs','gedungs.kode_gedung','=','gedung_memiliki_siswas.kode_gedung')
        ->join('kelas_asramas','kelas_asramas.kode_kelas_asrama','=','kelas_asrama_memiliki_siswas.kode_kelas_asrama')
        ->where('gedungs.nama_gedung','=', $namagedung)->get();

        $kelasasrama = DB::table('kelas_asramas')->where('nama_sub_kelas','!=','Umum')->get();

        return view('penilaian_asrama', ['tahunajaran'=>$tahunajaran, 'guruasrama'=>$guruasrama, 'siswaasrama'=>$siswaasrama, 'kelasasrama'=>$kelasasrama ]);
    }

    public function indexEditNilaiAsrama(Request $request)
    {
        $guruasrama = DB::table('guru_asramas')->join('gedungs','gedungs.id_user_guruasrama','=','guru_asramas.nik_guruasrama')->where('nik_guruasrama', Auth::user()->id_user)->get();
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();

        $namagedung = DB::table('gedungs')->where('id_user_guruasrama', Auth::user()->id_user)->value('nama_gedung');
        $siswaasrama = DB::table('kelas_asrama_memiliki_siswas')
        ->join('siswas','siswas.id_user','=','kelas_asrama_memiliki_siswas.id_siswa')
        ->join('gedung_memiliki_siswas','gedung_memiliki_siswas.id_siswa','=','kelas_asrama_memiliki_siswas.id_siswa')
        ->join('gedungs','gedungs.kode_gedung','=','gedung_memiliki_siswas.kode_gedung')
        ->join('kelas_asramas','kelas_asramas.kode_kelas_asrama','=','kelas_asrama_memiliki_siswas.kode_kelas_asrama')
        ->where('gedungs.nama_gedung','=', $namagedung)->get();
        return view('edit_nilai_asrama', ['tahunajaran'=>$tahunajaran, 'guruasrama'=>$guruasrama, 'siswaasrama'=>$siswaasrama ]);
        
    }

    public function materiAsrama()
    {   
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        $materiasrama = DB::table('materi_asramas')->get();
        $kelasasrama = DB::table('kelas_asramas')->select('kelas_asramas.kode_kelas_asrama', 'kelas_asramas.nama_sub_kelas')
        ->join('nilai_asramas', 'nilai_asramas.kelas_asrama','=','kelas_asramas.nama_sub_kelas')
        ->where('nilai_asramas.id_user_siswa', $idsiswa)->distinct()->get();
        return view('hasil_penilaianAsrama', ['materiasrama'=>$materiasrama, 'tahunajaran'=>$tahunajaran, 'kelasasrama'=>$kelasasrama]);
    }

    public function getNilaiAsramaSiswaMateri(Request $request){
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }
        $nilai = DB::table('nilai_asramas')
        ->join('materi_asramas', 'materi_asramas.kode_materi','=','nilai_asramas.kode_materi')
        ->where('nilai_asramas.id_user_siswa', $idsiswa)
        ->where('nilai_asramas.kategori_materi', '=' ,'Materi Pokok')
        ->where('nilai_asramas.kelas_asrama', $request->get('kelas_asrama'))->get();
        return response()->json($nilai);
    }

    public function getNilaiAsramaSiswaPraktikum(Request $request){
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }
        $nilai = DB::table('nilai_asramas')
        ->join('materi_asramas', 'materi_asramas.kode_materi','=','nilai_asramas.kode_materi')
        ->where('nilai_asramas.id_user_siswa', $idsiswa)
        ->where('nilai_asramas.kategori_materi', '=' ,'Pemahaman Konsep dan Praktikum')
        ->where('nilai_asramas.kelas_asrama', $request->get('kelas_asrama'))->get();
        return response()->json($nilai);
    }

    public function getNilaiAsramaSiswaSikap(Request $request){
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }
        $nilai = DB::table('nilai_asramas')
        ->join('materi_asramas', 'materi_asramas.kode_materi','=','nilai_asramas.kode_materi')
        ->where('nilai_asramas.id_user_siswa', $idsiswa)
        ->where('nilai_asramas.kategori_materi', '=' ,'Sikap dan Perilaku')
        ->where('nilai_asramas.kelas_asrama', $request->get('kelas_asrama'))->get();
        return response()->json($nilai);
    }

    public function getNilaiAsramaSiswaEkstrakulikuler(Request $request){
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }
        $nilai = DB::table('nilai_asramas')
        ->join('materi_asramas', 'materi_asramas.kode_materi','=','nilai_asramas.kode_materi')
        ->where('nilai_asramas.id_user_siswa', $idsiswa)
        ->where('nilai_asramas.kategori_materi', '=' ,'Kegiatan Ekstrakulikuler/Pengembangan Diri')
        ->where('nilai_asramas.kelas_asrama', $request->get('kelas_asrama'))->get();
        return response()->json($nilai);
    }

    public function getNilaiAsramaSiswaSaran(Request $request){
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }
        $nilai = DB::table('nilai_asramas')
        ->join('materi_asramas', 'materi_asramas.kode_materi','=','nilai_asramas.kode_materi')
        ->where('nilai_asramas.id_user_siswa', $idsiswa)
        ->where('nilai_asramas.kategori_materi', '=' ,'Catatan dan Saran Wali Kelas')
        ->where('nilai_asramas.kelas_asrama', $request->get('kelas_asrama'))->get();
        return response()->json($nilai);
    }


    public function getMateriAsrama(Request $request)
    {
        $materiasrama = DB::table('materi_asramas')
        ->where('kategori_materi', $request->get('kategori'))
        ->where('kode_kelas_asrama', $request->get('kelas'))->get();
        return response()->json($materiasrama);
    }

    public function getNilaiAsramaSiswa(Request $request){
        $nilai = DB::table('nilai_asramas')
        ->where('id_user_siswa', Auth::user()->id_user)
        ->where('kode_materi', $request->get('kode_materi'))->get();
        return response()->json($nilai);
    }

    public function getHasilPenilaianAsrama()
    {
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        $nama_kelas = DB::table('kelas')
        ->join('kelas_memiliki_siswas', 'kelas_memiliki_siswas.kode_kelas','=','kelas.kode_kelas')
        ->where('kelas_memiliki_siswas.id_siswa', Auth::user()->id_user)->value('kelas.nama_kelas');
        $matapelajaran = DB::table('guru_mempunyai_jadwals')->select('guru_mempunyai_jadwals.kode_mapel', 'kelas.nama_kelas', 'mata_pelajarans.nama_mata_pelajaran')
        ->join('kelas', 'kelas.kode_kelas','=','guru_mempunyai_jadwals.kode_kelas')
        ->join('mata_pelajarans', 'mata_pelajarans.kode_mapel','=','guru_mempunyai_jadwals.kode_mapel')
        ->where('kelas.nama_kelas',$nama_kelas)->distinct()->get();
        
        return view('hasil_penilaianAkademik', ['matapelajaran'=>$matapelajaran, 'tahunajaran'=>$tahunajaran]);
    }

    public function getCountNilaiAsrama($kodemateri){
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $nilai_asrama = DB::table('nilai_asramas')
        ->where('kode_materi', $kodemateri)
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)
        ->where('id_user_guruasrama', Auth::user()->id_user)->count();
        return $nilai_asrama;
        
    }

    public function storeNilaiAsrama(Request $request){
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');

        $kodemateri = $request->get('kode_materi');
        $tipenilai2 = $request->get('tipe_nilai');
        $kelas = $request->get('kelas');
        $idsiswa2 = $request->get('id_siswa');

        $nilai_asrama = new m_nilaiAsrama();
        
        $getDataNilai = $this->getCountNilaiAsrama($kodemateri);

        $nilai_asrama->id_user_guruasrama = Auth::user()->id_user;
        $nilai_asrama->kode_materi = $request->get('kode_materi');
        $nilai_asrama->id_user_siswa = $request->get('id_siswa');
        $nilai_asrama->kategori_materi = $request->get('kategori_materi');            
        $nilai_asrama->kelas_asrama = $request->get('kelas');
        $nilai_asrama->tipe_nilai = $request->get('tipe_nilai');
        $nilai_asrama->nilai = $request->get('keterangan');
        $nilai_asrama->tahun_ajaran = $tahunajaran;           
        $nilai_asrama->semester = $semester;
        
        if($getDataNilai == 0){
            $nilai_asrama->save();
            return response()->json([true]);
            
        }else{
            return response()->json([false]);
        }
    }

    public function getCount($kodemateri){
        $nilai_asrama = new m_nilaiAsrama();
        $getDataNilai = $nilai_asrama->getCountNilaiAsrama($kodemateri);
        
        $nilai = array_column($getDataNilai, 'nilai');
        $pesan = array_column($getDataNilai, 'datanilai');
        return $pesan[0];
    }

    public function storeNilaiAsramaIntegrasi(Request $request){
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');

        $kodemateri = $request->get('kode_materi');
        // $tipenilai2 = $request->get('tipe_nilai');
        // $kelas = $request->get('kelas');
        // $idsiswa2 = $request->get('id_siswa');

        $data = array();
        $nilai_asrama = new m_nilaiAsrama();
        
        $getDataNilai = $nilai_asrama->getCountNilaiAsrama($kodemateri);
        $nilai = array_column($getDataNilai, 'nilai');
        $pesan = array_column($getDataNilai, 'datanilai');

        $nilai_asrama->id_user_guruasrama = Auth::user()->id_user;
        $nilai_asrama->kode_materi = $request->get('kode_materi');
        $nilai_asrama->id_user_siswa = $request->get('id_siswa');
        $nilai_asrama->kategori_materi = $request->get('kategori_materi');            
        $nilai_asrama->kelas_asrama = $request->get('kelas');
        $nilai_asrama->tipe_nilai = $request->get('tipe_nilai');
        $nilai_asrama->nilai = $request->get('keterangan');
        $nilai_asrama->tahun_ajaran = $tahunajaran;           
        $nilai_asrama->semester = $semester;

        if($pesan[0] != 'false' ){
            $data['getDataNilai'] = 'true';
            if(sizeOf($nilai[0]) == 0){
                $data['pesan'] = 'Data nilai asrama berhasil ditambah';
                $nilai_asrama->save();
            }else{
                $data['pesan'] = 'Data nilai asrama gagal ditambah';
            }
        }else {
            $data['getDataNilai'] = 'false';
            $data['pesan'] = 'Data nilai asrama gagal ditambah';
        }
        
        return $data;
    }

    public function storeNilaiAsramaUnit(Request $request){
        $nilai_asrama = [
            'id_user_siswa'=> $request->get('id_siswa'),
            'id_user_guruasrama'=> $request->get('id_guruasrama'),
            'kode_materi'=> $request->get('kode_materi'),
            'kategori_materi'=> $request->get('kategori_materi'),
            'kelas_asrama'=> $request->get('kelas'),
            'tipe_nilai'=>$request->get('tipe_nilai'),
            'nilai' => $request->get('keterangan'),
            'tahun_ajaran' => $request->get('tahun_ajaran'),
            'semester' => $request->get('semester'),
        ];

        $getDataNilai = $this->getCountNilaiAsrama($request->get('kode_materi'), $request->get('id_siswa'), $request->get('tipe_nilai'), $request->get('kelas'),  $request->get('id_guruasrama'));
        
        if($getDataNilai > 0){
            return response()->json(['Data nilai asrama telah dimasukkan sebelumnya']);
        }else{
            $nilai_asrama = true;
            return response()->json(['Data nilai asrama berhasil diambil']);
        }
    }

    public function updateKelasAsrama(Request $request){
       
        DB::table('kelas_asrama_memiliki_siswas')
                ->where('id_siswa', $request->get('id_siswa'))
                ->update(['kode_kelas_asrama' => $request->get('kode_kelas_asrama')]);
       
        return response()->json([true]);
    }

    public function get_nilai_asrama(Request $request){
        $nilai = DB::table('nilai_asramas')
        ->join('materi_asramas', 'materi_asramas.kode_materi','=','nilai_asramas.kode_materi')
        ->where('nilai_asramas.id_user_siswa', $request->get('id_user_siswa'))
        ->where('nilai_asramas.kategori_materi', $request->get('kategori_materi'))
        ->where('nilai_asramas.kelas_asrama', $request->get('kelas_asrama'))
        ->where('nilai_asramas.id_user_guruasrama', Auth::user()->id_user)->get();
        return response()->json($nilai);
    }

    public function updateNilaiAsrama(Request $request){
       
        DB::table('nilai_asramas')
                ->where('id', $request->get('id_nilai'))
                ->update(['nilai' => $request->get('nilai')]);
       
        return response()->json([true]);
    }

    public function deleteNilaiAsrama($id){
        $nilai_asrama = m_nilaiAsrama::findOrFail($id);
        $nilai_asrama->delete();
        return $nilai_asrama;
    }
}
