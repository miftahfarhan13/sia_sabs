<?php

namespace App\Http\Controllers;

use App\m_jadwalMataPelajaran;
use App\m_mataPelajaran;
use App\m_kelas;
use App\m_kelasSiswa;
use Illuminate\Http\Request;
use DB;
use Auth;

class c_jadwalMataPelajaran extends Controller
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
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran2 = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        $nama_kelas = DB::table('kelas')
        ->join('kelas_memiliki_siswas', 'kelas_memiliki_siswas.kode_kelas','=','kelas.kode_kelas')
        ->where('kelas_memiliki_siswas.id_siswa', $idsiswa)
        ->where('kelas_memiliki_siswas.tahun_ajaran',$tahunajaran2)
        ->where('kelas_memiliki_siswas.semester',$semester)->value('kelas.nama_kelas');
        
        $matapelajaran = DB::table('guru_mempunyai_jadwals')
        ->join('kelas', 'kelas.kode_kelas','=','guru_mempunyai_jadwals.kode_kelas')
        ->join('mata_pelajarans', 'mata_pelajarans.kode_mapel','=','guru_mempunyai_jadwals.kode_mapel')
        ->where('kelas.nama_kelas',$nama_kelas)
        ->where('guru_mempunyai_jadwals.tahun_ajaran',$tahunajaran2)
        ->where('guru_mempunyai_jadwals.semester',$semester)->get();
        return view('jadwal_mata_pelajaran', ['matapelajaran'=>$matapelajaran, 'tahunajaran'=>$tahunajaran]);
    }

    public function indexJadwalMengajarGuruSekolah(Request $request)
    {
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        $jadwalmengajarguru = DB::table('guru_mempunyai_jadwals')->join('kelas','kelas.kode_kelas','=','guru_mempunyai_jadwals.kode_kelas')->where('id_gurusekolah', Auth::user()->id_user)->get();
        return view('jadwal_mengajar_gurusekolah', ['jadwalmengajarguru'=>$jadwalmengajarguru, 'tahunajaran'=>$tahunajaran]);
    }

    public function KelolaDataSekolahView(Request $request)
    {
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran2 = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');

        $kelas = DB::table('kelas')->get();

        $gurusekolah = DB::table('guru_sekolahs')->join('mata_pelajarans', 'mata_pelajarans.kode_mapel','=','guru_sekolahs.id_mata_pelajaran')->get();

        $matapelajaran = DB::table('guru_mempunyai_jadwals')
        ->join('guru_sekolahs', 'guru_sekolahs.id_user','=','guru_mempunyai_jadwals.id_gurusekolah')
        ->join('kelas', 'kelas.kode_kelas','=','guru_mempunyai_jadwals.kode_kelas')->get();

        $kelassiswa = DB::table('kelas_memiliki_siswas')->select('id_siswa')
        ->where('tahun_ajaran',$tahunajaran2)
        ->where('semester',$semester)->get();
        $kelassiswa2 = json_decode($kelassiswa, true);

        $tambahsiswa = DB::table('siswas')
        ->join('kelas_memiliki_siswas', 'kelas_memiliki_siswas.id_siswa','=','siswas.id_user')
        ->join('kelas', 'kelas.kode_kelas','=','kelas_memiliki_siswas.kode_kelas')
        ->whereNotIn('kelas_memiliki_siswas.id_siswa', $kelassiswa2)->get();

        $siswa = DB::table('siswas')
        ->join('kelas_memiliki_siswas', 'kelas_memiliki_siswas.id_siswa','=','siswas.id_user')
        ->join('kelas', 'kelas.kode_kelas','=','kelas_memiliki_siswas.kode_kelas')
        ->where('kelas_memiliki_siswas.tahun_ajaran',$tahunajaran2)
        ->where('kelas_memiliki_siswas.semester',$semester)->get();

        return view('kelola_data_sekolah', ['matapelajaran'=>$matapelajaran, 'tahunajaran'=>$tahunajaran, 'kelas'=>$kelas, 'gurusekolah'=>$gurusekolah, 'siswa'=>$siswa, 'tambahsiswa'=>$tambahsiswa]);
    }

    public function getJadwalMataPelajaran(Request $request, $kelas){
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');

        $matapelajaran = DB::table('guru_mempunyai_jadwals')
        ->join('guru_sekolahs', 'guru_sekolahs.id_user','=','guru_mempunyai_jadwals.id_gurusekolah')
        ->join('kelas', 'kelas.kode_kelas','=','guru_mempunyai_jadwals.kode_kelas')
        ->join('mata_pelajarans', 'mata_pelajarans.kode_mapel','=','guru_mempunyai_jadwals.kode_mapel')
        ->where('kelas.kode_kelas',$kelas)
        ->where('guru_mempunyai_jadwals.tahun_ajaran',$tahunajaran)
        ->where('guru_mempunyai_jadwals.semester',$semester)->get();

        return $matapelajaran;
    }

    public function getCountMataPelajaran($kodemapel, $namamapel){
        $tahunajaran = DB::table('mata_pelajarans')->where('kode_mapel', $kodemapel)->where('nama_mata_pelajaran', $namamapel)->count();    
        return $tahunajaran;
    }

    public function storeMataPelajaran(Request $request){
        $kodemapel = $request->get('kode_mapel');
        $namamapel = $request->get('nama_mata_pelajaran');
        $getMataPelajaran = $this->getCountMataPelajaran($kodemapel, $namamapel);

        $matapelajaran = new m_mataPelajaran([
            'kode_mapel' => $kodemapel,
            'nama_mata_pelajaran' => $namamapel,
        ]);

        if($getMataPelajaran == 0){
            $matapelajaran->timestamps = false;
            $matapelajaran->save();
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }    
    }

    public function getCountKelas($namakelas){
        $kelas = DB::table('kelas')->where('nama_kelas', $namakelas)->count();    
        return $kelas;
    }

    public function storeTambahKelas(Request $request){
        $namakelas = $request->get('nama_kelas');
        $getKelas = $this->getCountKelas($namakelas);

        $kelas = new m_kelas([
            'nama_kelas' => $namakelas,
        ]);

        if($getKelas == 0){
            $kelas->timestamps = false;
            $kelas->save();
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }    
    }

    public function getCountJadwalMataPelajaran($kodekelas, $idgurusekolah, $kodemapel, $hari, $jam){
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');

        $jadwalmatapelajaran = DB::table('guru_mempunyai_jadwals')
        ->where('kode_kelas', $kodekelas)
        ->where('id_gurusekolah', $idgurusekolah)
        ->where('kode_mapel', $kodemapel)
        ->where('hari', $hari)
        ->where('jam', $jam)
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)->count();   

        return $jadwalmatapelajaran;
    }

    public function getKodeMapel(Request $request){
        $kodemapel = DB::table('guru_sekolahs')->select('id_mata_pelajaran')
        ->where('id_user', $request->get('id_gurusekolah'))->distinct()->get();   

        return $kodemapel;
    }

    public function storeJadwalMataPelajaran(Request $request){
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');

        $kodekelas = $request->get('kode_kelas');
        $idgurusekolah = $request->get('id_gurusekolah');
        $kodemapel = $request->get('kode_mapel_jadwal');
        $hari = $request->get('hari');
        $jam = $request->get('jam');

        $getMataPelajaran = $this->getCountJadwalMataPelajaran($kodekelas,$idgurusekolah, $kodemapel, $hari, $jam);

        $jadwalmatapelajaran = new m_jadwalMataPelajaran([
            'kode_kelas' => $kodekelas,
            'id_gurusekolah' => $idgurusekolah,
            'kode_mapel' => $kodemapel,
            'hari' => $hari,
            'jam' => $jam,
            'tahun_ajaran' => $tahunajaran,
            'semester' => $semester,
        ]);

        if($getMataPelajaran == 0){
            $jadwalmatapelajaran->timestamps = false;
            $jadwalmatapelajaran->save();
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }    
    }

    public function deleteJadwal($id){
        $jadwalmatapelajaran = m_jadwalMataPelajaran::findOrFail($id);
        $jadwalmatapelajaran->delete();
        return $jadwalmatapelajaran;
    }
    
    public function storeTambahKelasSiswa(Request $request){
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $idsiswa = $request->get('id_siswa');
        $kode_kelas = $request->get('kode_kelas');

            foreach ($kode_kelas as $key => $value) {
                $tambahkelas = new m_kelasSiswa();
                $tambahkelas->id_siswa = $idsiswa[$key];
                $tambahkelas->kode_kelas = $kode_kelas[$key];
                $tambahkelas->tahun_ajaran = $tahunajaran;
                $tambahkelas->semester = $semester;
                $tambahkelas->timestamps = false;
                $tambahkelas->save();
            }
            return response()->json([true]);
        
    }
    
}
