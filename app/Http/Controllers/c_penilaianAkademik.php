<?php

namespace App\Http\Controllers;

use App\m_bobotNilai;
use App\ulangan_harian;
use App\penilaian_keterampilan;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_nilaiAkademik;
use App\nilai_uts;
use App\nilai_uas;
use App\penilaian_sikap; 
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Str;
use SebastianBergmann\Environment\Console;

class c_penilaianAkademik extends Controller
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
    public function index(Request $request)
    {
        $gurusekolahs = DB::table('guru_sekolahs')->join('mata_pelajarans','mata_pelajarans.kode_mapel','=','guru_sekolahs.id_mata_pelajaran')->where('id_user', Auth::user()->id_user)->get();
        
        $jadwalmengajarguru = DB::table('guru_mempunyai_jadwals')->select('kelas.nama_kelas')
        ->join('kelas','kelas.kode_kelas','=','guru_mempunyai_jadwals.kode_kelas')
        ->where('id_gurusekolah', Auth::user()->id_user)->distinct()->get();

        $bobotnilai = DB::table('bobot_penilaians')->where('id_user_gurusekolah', Auth::user()->id_user)->get();

        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        // dd($gurusekolahs);        
        return view('penilaian_akademik',['gurusekolahs'=>$gurusekolahs, 'bobotnilai'=>$bobotnilai, 'tahunajaran'=>$tahunajaran, 'jadwalmengajarguru'=>$jadwalmengajarguru]);
    }

    public function indexEditNilaiAkademik(Request $request)
    {
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();

        // $jadwalmengajarguru = DB::table('guru_mempunyai_jadwals')
        // ->join('kelas','kelas.kode_kelas','=','guru_mempunyai_jadwals.kode_kelas')
        // ->where('id_gurusekolah', Auth::user()->id_user)->get();
        $jadwalmengajarguru = DB::table('guru_mempunyai_jadwals')->select('kelas.nama_kelas')
        ->join('kelas','kelas.kode_kelas','=','guru_mempunyai_jadwals.kode_kelas')
        ->where('id_gurusekolah', Auth::user()->id_user)->distinct()->get();

        $siswa = DB::table('nilai_sekolahs')->select('nilai_sekolahs.id_user_siswa', 'kelas.nama_kelas', 'siswas.id_user', 'siswas.nama_siswa')
        ->join('siswas', 'siswas.id_user','=','nilai_sekolahs.id_user_siswa')
        ->join('kelas_memiliki_siswas', 'kelas_memiliki_siswas.id_siswa','=','nilai_sekolahs.id_user_siswa')
        ->join('kelas', 'kelas.kode_kelas','=','kelas_memiliki_siswas.kode_kelas')
        ->where('kelas.nama_kelas', $request->get('students_class_name'))->distinct()->get();

        $gurusekolahs = DB::table('guru_sekolahs')->join('mata_pelajarans','mata_pelajarans.kode_mapel','=','guru_sekolahs.id_mata_pelajaran')->where('id_user', Auth::user()->id_user)->get();

        return view('edit_nilai', ['tahunajaran'=>$tahunajaran,'jadwalmengajarguru'=>$jadwalmengajarguru, 'gurusekolahs'=>$gurusekolahs, 'siswa'=>$siswa ]);
    }

    public function get_penilaian_siswa($nama_kelas){
        $siswa = DB::table('kelas_memiliki_siswas')
        ->join('siswas', 'siswas.id_user','=','kelas_memiliki_siswas.id_siswa')
        ->join('kelas', 'kelas.kode_kelas','=','kelas_memiliki_siswas.kode_kelas')
        ->where('kelas.nama_kelas',$nama_kelas)->get();

        return response()->json($siswa);
    }

    public function hasilPenilaianSiswa()
    {
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }

        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();

        $tahunajaran2 = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaransiswa = DB::table('sekolahs')
        ->join('siswas', 'siswas.tahun_masuk','=','sekolahs.id')->value('tahun_ajaran');

        $daftartahunajaran = DB::table('sekolahs')
        ->where('tahun_ajaran','>=', $tahunajaransiswa)->get();
        
        $nama_kelas = DB::table('kelas')
        ->join('kelas_memiliki_siswas', 'kelas_memiliki_siswas.kode_kelas','=','kelas.kode_kelas')
        ->where('kelas_memiliki_siswas.id_siswa', $idsiswa)
        ->where('kelas_memiliki_siswas.tahun_ajaran',$tahunajaran2)
        ->where('kelas_memiliki_siswas.semester',$semester)->value('kelas.nama_kelas');

        $matapelajaran = DB::table('guru_mempunyai_jadwals')->select('guru_mempunyai_jadwals.kode_mapel', 'kelas.nama_kelas', 'mata_pelajarans.nama_mata_pelajaran', 'guru_sekolahs.nama_guru_sekolah', 'guru_sekolahs.id_user')
        ->join('kelas', 'kelas.kode_kelas','=','guru_mempunyai_jadwals.kode_kelas')
        ->join('guru_sekolahs', 'guru_sekolahs.id_user','=','guru_mempunyai_jadwals.id_gurusekolah')
        ->join('mata_pelajarans', 'mata_pelajarans.kode_mapel','=','guru_mempunyai_jadwals.kode_mapel')
        ->where('kelas.nama_kelas',$nama_kelas)
        ->where('guru_mempunyai_jadwals.tahun_ajaran',$tahunajaran2)
        ->where('guru_mempunyai_jadwals.semester',$semester)->distinct()->get();

        return view('hasil_penilaianAkademik', ['matapelajaran'=>$matapelajaran, 'tahunajaran'=>$tahunajaran, 'daftartahunajaran'=>$daftartahunajaran]);
    }

    public function getMataPelajaran(Request $request){
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }

        $pilihtahun = $request->get('pilih_tahun');
        $tahunajaran = substr($pilihtahun,0,9);
        $semester = substr($pilihtahun,18,19);

        $nama_kelas = DB::table('kelas')
        ->join('kelas_memiliki_siswas', 'kelas_memiliki_siswas.kode_kelas','=','kelas.kode_kelas')
        ->where('kelas_memiliki_siswas.id_siswa', $idsiswa)
        ->where('kelas_memiliki_siswas.tahun_ajaran',$tahunajaran)
        ->where('kelas_memiliki_siswas.semester',$semester)->value('kelas.nama_kelas');

        $matapelajaran = DB::table('guru_mempunyai_jadwals')->select('guru_mempunyai_jadwals.kode_mapel', 'kelas.nama_kelas', 'mata_pelajarans.nama_mata_pelajaran', 'guru_sekolahs.nama_guru_sekolah', 'guru_sekolahs.id_user')
        ->join('kelas', 'kelas.kode_kelas','=','guru_mempunyai_jadwals.kode_kelas')
        ->join('guru_sekolahs', 'guru_sekolahs.id_user','=','guru_mempunyai_jadwals.id_gurusekolah')
        ->join('mata_pelajarans', 'mata_pelajarans.kode_mapel','=','guru_mempunyai_jadwals.kode_mapel')
        ->where('kelas.nama_kelas',$nama_kelas)
        ->where('guru_mempunyai_jadwals.tahun_ajaran',$tahunajaran)
        ->where('guru_mempunyai_jadwals.semester',$semester)->distinct()->get();

        return response()->json($matapelajaran);
    }

    public function getNilaiMataPelajaran(Request $request){
        $pilihtahun = $request->get('pilih_tahun');
        $tahunajaran = substr($pilihtahun,0,9);
        $semester = substr($pilihtahun,18,19);
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }

        $ulanganhariancount = DB::table('nilai_sekolahs')
        ->where('id_user_siswa', $idsiswa)
        ->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)
        ->where('id_kategori', $request->get('id_kategori'))
        ->where('tipe_nilai', '=', 'Ulangan Harian')->count();

        $getulanganharian = DB::table('nilai_sekolahs')
        ->where('id_user_siswa', $idsiswa)
        ->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)
        ->where('id_kategori', $request->get('id_kategori'))
        ->where('tipe_nilai', '=', 'Ulangan Harian')->sum('nilai');

        $kelassiswa = DB::table('kelas_memiliki_siswas')->where('id_siswa', $idsiswa)->value('kode_kelas');
        $bobotnilaisiswa = DB::table('bobot_penilaians')->select('bobot_penilaians.KKM', 'bobot_penilaians.ulangan_harian', 'bobot_penilaians.uts', 'bobot_penilaians.uas')
        ->join('guru_mempunyai_jadwals', 'guru_mempunyai_jadwals.id_gurusekolah','=','bobot_penilaians.id_user_gurusekolah')
        ->where('guru_mempunyai_jadwals.kode_kelas','=', $kelassiswa)
        ->where('bobot_penilaians.id_user_gurusekolah', $request->get('id_gurusekolah'))->distinct()->get();

        $nilai_array = array();

        $nilai_matapelajaran = DB::table('nilai_sekolahs')
        ->where('id_user_siswa', $idsiswa)
        ->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)
        ->where('tipe_nilai','!=', 'Deskripsi')
        ->where('id_kategori', $request->get('id_kategori'))->get();
        
        $nilai_matapelajaran_count = DB::table('nilai_sekolahs')
        ->where('id_user_siswa', $idsiswa)
        ->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)
        ->where('tipe_nilai','!=', 'Deskripsi')
        ->where('id_kategori', $request->get('id_kategori'))->count();

        $responseArray = json_decode($nilai_matapelajaran, true);
        $responseArrayBobot = json_decode($bobotnilaisiswa, true); // set true here

        $nilai = array_column($responseArray, 'nilai');
        $tipenilai = array_column($responseArray, 'tipe_nilai');

        if($responseArrayBobot != null){
           

            $uts = array_column($responseArrayBobot, 'uts');
            $uas = array_column($responseArrayBobot, 'uas');
            $ulanganharian = array_column($responseArrayBobot, 'ulangan_harian');

            $utsnilai = 0;
            $uasnilai = 0;
            (int)$nilaiakhir = 0;
            $nilaipredikat = '';

            if($ulanganhariancount != null){
                $ulanganharian = ($getulanganharian/$ulanganhariancount)*($ulanganharian[0]/100);
            }
        
            $predikatA = range(91,100);
            $predikatB = range(83,90);
            $predikatC = range(75,82);
            $predikatD = range(0,74);

            foreach ($nilai as $key => $row) { 
                if($responseArray[$key]['tipe_nilai'] != null){
                    if($responseArray[$key]['tipe_nilai'] == 'UTS'){
                        $utsnilai = ($nilai[$key] * $uts[0])/100;
                    }
                    if($responseArray[$key]['tipe_nilai'] == 'UAS'){
                        $uasnilai = ($nilai[$key] * $uas[0])/100;
                    }
                    if($utsnilai != 0 && $uasnilai != 0){
                        (int)$nilaiakhir = $utsnilai + $uasnilai + $ulanganharian;
                        
                    }
                
                    $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                    $nilai_array[$key]['nilai']= $nilai[$key];

                    if($nilaiakhir != 0){
                        $nilai_array[$nilai_matapelajaran_count]['tipe_nilai'] = 'Nilai Akhir';
                        $nilai_array[$nilai_matapelajaran_count]['nilai'] = (int)$nilaiakhir;
                    }

                    foreach($predikatA as $value){
                        if((int)$nilaiakhir == $value ){
                            $nilaipredikat = 'A';
                        }
                    }
                    foreach($predikatB as $value){
                        if((int)$nilaiakhir == $value ){
                            $nilaipredikat = 'B';
                        }
                    }
                    foreach($predikatC as $value){
                        if((int)$nilaiakhir == $value ){
                            $nilaipredikat = 'C';
                        }
                    }
                    foreach($predikatD as $value){
                        if((int)$nilaiakhir == $value ){
                            $nilaipredikat = 'D';
                        }
                    }
                    if((int)$nilaiakhir != 0){
                        $nilai_array[$nilai_matapelajaran_count + 1]['tipe_nilai'] = 'Nilai Predikat';
                        $nilai_array[$nilai_matapelajaran_count + 1]['nilai'] = $nilaipredikat;
                
                    }   
                }
            }

            $nilai_array = json_encode($nilai_array);
        }else{
            foreach ($nilai as $key => $row) { 
                if($responseArray[$key]['tipe_nilai'] != null){
                    $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                    $nilai_array[$key]['nilai']= $nilai[$key];
                }
            }
        }

        
        return $nilai_array;
    }

    public function getNilaiMataPelajaranSikap(Request $request){
        
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }

        $pilihtahun = $request->get('pilih_tahun');
        $tahunajaran = substr($pilihtahun,0,9);
        $semester = substr($pilihtahun,18,19);

        $nilai_array = array();

        $nilai_sikap = DB::table('nilai_sekolahs')
        ->where('id_user_siswa', $idsiswa )
        ->where('id_kategori', '=', 'Sikap')
        ->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)->get();

        $responseArray = json_decode($nilai_sikap, true); // set true here
        $nilai = array_column($responseArray, 'nilai');
        $tipenilai = array_column($responseArray, 'tipe_nilai');

        foreach ($nilai as $key => $row) { 
            if($responseArray[$key]['nilai'] == 4){
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']=  'Sangat Baik';
                
            }
            if($responseArray[$key]['nilai'] == 3){
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']=  'Baik';
                
            }
            if($responseArray[$key]['nilai'] == 2){
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']=  'Kurang';
                
            }
            if($responseArray[$key]['nilai'] == 1){
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']=  'Sangat Kurang';
                
            }
        }
        // $nilai_array = json_encode($nilai_array);
        return $nilai_array;
    }

    

    public function getNilaiMataPelajaranKeterampilan(Request $request){
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }

        $pilihtahun = $request->get('pilih_tahun');
        $tahunajaran = substr($pilihtahun,0,9);
        $semester = substr($pilihtahun,18,19);

        $nilai_array = array();

        $nilai_keterampilan = DB::table('nilai_sekolahs')
        ->where('id_user_siswa', $idsiswa)
        ->where('id_kategori', '=', 'Keterampilan')
        ->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)->get();

        $get_jumlah_nilai_keterampilan = DB::table('nilai_sekolahs')
        ->where('id_user_siswa', $idsiswa)
        ->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)
        ->where('id_kategori', '=', 'Keterampilan')->sum('nilai');

        $responseArray = json_decode($nilai_keterampilan, true); // set true here
        $nilai = array_column($responseArray, 'nilai');
        $tipenilai = array_column($responseArray, 'tipe_nilai');

        $nilaipredikatketerampilan = '';
        if($get_jumlah_nilai_keterampilan != 0){
            $nilaiakhirketerampilan = ceil(($get_jumlah_nilai_keterampilan/30)*(100));
            $predikatA = range(91,100);
            $predikatB = range(83,90);
            $predikatC = range(75,82);
            $predikatD = range(0,74);
            foreach($predikatA as $value){
                if($nilaiakhirketerampilan == $value ){
                    $nilaipredikatketerampilan = 'A';
                }
            }
            foreach($predikatB as $value){
                if($nilaiakhirketerampilan == $value ){
                    $nilaipredikatketerampilan = 'B';
                }
            }
            foreach($predikatC as $value){
                if($nilaiakhirketerampilan == $value ){
                    $nilaipredikatketerampilan = 'C';
                }
            }
            foreach($predikatD as $value){
                if($nilaiakhirketerampilan == $value ){
                    $nilaipredikatketerampilan = 'D';
                }
            }
            
        }
        // $nilai_array['tipe_nilai']=  $tipenilai;

        foreach ($nilai as $key => $row) { 
            if($responseArray[$key]['nilai'] == 5){
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']=  'Sangat Baik';
                
            }
            if($responseArray[$key]['nilai'] == 4){
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']=  'Baik';
                
            }
            if($responseArray[$key]['nilai'] == 3){
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']=  'Cukup';
                
            }
            if($responseArray[$key]['nilai'] == 2){
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']=  'Kurang';
                
            }
            if($responseArray[$key]['nilai'] == 1){
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']=  'Sangat Kurang';
                
            }
            $nilai_array[6]['tipe_nilai']=  'Nilai Akhir';
                $nilai_array[6]['nilai']=  $nilaiakhirketerampilan;
                $nilai_array[7]['tipe_nilai']=  'Nilai Predikat';
                $nilai_array[7]['nilai']=  $nilaipredikatketerampilan;
        }
        // $nilai_array = json_encode($nilai_array);
        return $nilai_array;
    }

    public function getDeskripsiMataPelajaran(Request $request){
        $idsiswa = '';
        $role = Auth::user()->role;
        if($role == 'Orang Tua'){
            $idsiswa = DB::table('orangtua_memiliki_siswas')->where('id_orangtua', Auth::user()->id_user)->value('id_siswa');
        }else{
            $idsiswa =  Auth::user()->id_user;
        }
        $pilihtahun = $request->get('pilih_tahun');
        $tahunajaran = substr($pilihtahun,0,9);
        $semester = substr($pilihtahun,18,19);
        $nilai = DB::table('nilai_sekolahs')->select('nilai_sekolahs.nilai')
        ->where('id_user_siswa', $idsiswa)
        ->where('tipe_nilai', '=', 'Deskripsi')
        ->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)
        ->where('id_kategori', $request->get('id_kategori'))->get();
        return response()->json($nilai);
    }

    public function getCountNilaiUjianKategori(Request $request){
        $nilai_ujian = DB::table('nilai_sekolahs')->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))->where('id_user_siswa',$request->get('id_user_siswa'))->where('id_kategori', $request->get('id_kategori'))->count();
        return $nilai_ujian;
    }

    public function getCountDeskripsi(Request $request){
        $nilai_ujian = DB::table('nilai_sekolahs')
        ->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))
        ->where('id_user_siswa',$request->get('id_user_siswa'))
        ->where('id_kategori', $request->get('id_kategori'))
        ->where('tipe_nilai', $request->get('tipe'))->count();
        return $nilai_ujian;
    }

    public function data_siswa(Request $request){
        $data_siswa = DB::table('siswas')->select('siswas.id_user','siswas.nama_siswa')
        ->join('jadwal_pelajaran_sekolahs','jadwal_pelajaran_sekolahs.id_user_siswa','=','siswas.id_user')
        ->where('id_user_gurusekolah', Auth::user()->id_user)->get();
        return json_encode($data_siswa);
    }

    public function updateBobotNilai(Request $request){
        $validasi = $request->validate([
            'kkm' => 'required',
            'ulanganHarian' => 'required',
            'uts' => 'required',
            'uas' => 'required',
        ]);
        
        DB::table('bobot_penilaians')
                ->where('id_user_gurusekolah', Auth::user()->id_user)
                ->update(['KKM' => $request->get('kkm'),
                'ulangan_harian' => $request->get('ulanganHarian'),
                'uts' => $request->get('uts'),
                'uas' => $request->get('uas'),]);
       
        return redirect('/penilaian_akademik')->with('success', 'Data bobot berhasil diupdate.');
    }

    public function storeBobotNilai(Request $request){
        $validasi = $request->validate([
            'kkm' => 'required',
            'ulanganHarian' => 'required',
            'uts' => 'required',
            'uas' => 'required',
        ]);

        $bobot = new m_bobotNilai([
            'id_user_gurusekolah' => Auth::user()->id_user,
            'KKM' => $request->get('kkm'),
            'ulangan_harian' => $request->get('ulanganHarian'),
            'uts' => $request->get('uts'),
            'uas' => $request->get('uas'),
        ]);
        
        try {
            $bobot->save();
        }catch (\Illuminate\Database\QueryException $e) {
            var_dump($e->errorInfo);
            return redirect('/penilaian_akademik')->with('warning', 'Silahkan lengkapi data bobot nilai');
        }
               
        return redirect('/penilaian_akademik')->with('success', 'Data bobot berhasil disimpan.');
        
    }

    public function getCountNilaiUjian($idmapel, $idsiswa, $tipenilai, $tahunajaran, $semester){
        $nilai_ujian = DB::table('nilai_sekolahs')
        ->where('id_mata_pelajaran', $idmapel)
        ->where('id_user_siswa', $idsiswa)
        ->where('tipe_nilai', $tipenilai)
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)->count();    
        return $nilai_ujian;
    }
    
    public function storeNilaiSekolah(Request $request){
        $id_matapelajaran = DB::table('guru_sekolahs')->where('id_user', Auth::user()->id_user)->value('id_mata_pelajaran');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        
        $nilai_ujian = new m_nilaiAkademik;

        $nilai_ujian->id_user_gurusekolah = Auth::user()->id_user;
        $nilai_ujian->id_mata_pelajaran = $id_matapelajaran;
        $nilai_ujian->id_user_siswa = $request->get('id_siswa');
        $nilai_ujian->id_kategori = $request->get('id_kategori');            
        $nilai_ujian->tipe_nilai = $request->get('tipe_nilai_dropdown');
        $nilai_ujian->nilai = $request->get('nilai');
        $nilai_ujian->tahun_ajaran = $tahunajaran;           
        $nilai_ujian->semester = $semester;

        // $nilai_ujian = new nilai_sekolah([
        //     'id_user_gurusekolah' => Auth::user()->id_user,
        //     'id_mata_pelajaran' => $id_matapelajaran,
        //     'id_user_siswa' => $request->get('id_siswa'),
        //     'id_kategori' => $request->get('id_kategori'),
        //     'tipe_nilai' =>$request->get('tipe_nilai_dropdown'),
        //     'nilai' => $request->get('nilai'),
        //     'tahun_ajaran' => $tahunajaran,
        //     'semester' => $semester,
        // ]);
        
        $tipenilai2 = $request->get('tipe_nilai_dropdown');
        $idsiswa2 = $request->get('id_siswa');

        $getDataNilai = $nilai_ujian->getCountNilaiUjian($id_matapelajaran, $idsiswa2, $tipenilai2, $tahunajaran, $semester);
    
        if($getDataNilai > 0){
            if(Str::contains($tipenilai2, 'Ulangan Harian')){
                $nilai_ujian->save();
                return response()->json([true]);
            }else{
                return response()->json([false]);
            }
        }else{
            $nilai_ujian->save();
            return response()->json([true]);
        }
    }

    public function storeNilaiSekolahIntegrasi(Request $request){
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');

        $id_matapelajaran = DB::table('guru_sekolahs')->where('id_user', Auth::user()->id_user)->value('id_mata_pelajaran');
        $tipenilai2 = $request->get('tipe_nilai_dropdown');
        $idsiswa2 = $request->get('id_user_siswa');
        
        $nilai_ujian = new m_nilaiAkademik;
        $data = array();

        $getDataNilai = $nilai_ujian->getCountNilaiUjian($id_matapelajaran, $idsiswa2, $tipenilai2, $tahunajaran, $semester);
        $getDataNilai = json_decode($getDataNilai);

        if($getDataNilai != null){
            $data['getDataNilai'] = 'true';
        }else{
            $data['getDataNilai'] = 'false';
        }

        if($data['getDataNilai'] == 'true'){
            $nilai_ujian->id_user_gurusekolah = Auth::user()->id_user;
            $nilai_ujian->id_mata_pelajaran = $id_matapelajaran;
            $nilai_ujian->id_user_siswa = $request->get('id_user_siswa');
            $nilai_ujian->id_kategori = $request->get('id_kategori');            
            $nilai_ujian->tipe_nilai = $request->get('tipe_nilai_dropdown');
            $nilai_ujian->nilai = $request->get('nilai');
            $nilai_ujian->tahun_ajaran = $tahunajaran;           
            $nilai_ujian->semester = $semester;
    
            if($getDataNilai > 0){
                if(Str::contains($tipenilai2, 'Ulangan Harian')){
                    $nilai_ujian->save();
                    $data['pesan'] = 'Data nilai ulangan harian berhasil ditambah';
                }else{
                    $data['pesan'] = 'Data nilai sudah dimasukkan sebelumnya';
            }
            }else{
                $nilai_ujian->save();
                $data['pesan'] = 'Data nilai berhasil ditambah';
            }
        }else{
            $data['pesan'] = 'Silahkan cek data! Pastikan data adalah benar!';
        }
            
        return $data;
    }

    public function storeNilaiSekolahUnit(Request $request){
        $nilai_ujian = [
            'id_user_gurusekolah' => $request->get('id_user_gurusekolah'),
            'id_mata_pelajaran' => $request->get('id_mata_pelajaran'),
            'id_user_siswa' => $request->get('id_user_siswa'),
            'id_kategori' => $request->get('id_kategori'),
            'tipe_nilai' => $request->get('tipe_nilai'),
            'nilai' => $request->get('nilai'),
            'tahun_ajaran' => $request->get('tahun_ajaran'),
            'semester' => $request->get('semester'),
        ];
        
        // $nilai_ujian = [
        //     'id_user_gurusekolah' => $data['id_user_gurusekolah'],
        //     'id_mata_pelajaran' => $data['id_mata_pelajaran'],
        //     'id_user_siswa' => $data['id_user_siswa'],
        //     'id_kategori' => $data['id_kategori'],
        //     'tipe_nilai' => $data['tipe_nilai'],
        //     'nilai' => $data['nilai'],
        //     'tahun_ajaran' => $data['tahun_ajaran'],
        //     'semester' => $data['semester'],
        // ];

        $getDataNilai = $this->getCountNilaiUjian($request->get('id_mata_pelajaran'), $request->get('id_user_siswa'), $request->get('tipe_nilai'),$request->get('tahun_ajaran'),$request->get('semester'));
        $nilai_ujian = json_encode($nilai_ujian);

        if($getDataNilai > 0){
            if(Str::contains($request->get('tipe_nilai'), 'Ulangan Harian')){
                $nilai_ujian = true;
                // return $nilai_ujian;
                return response()->json(['Data nilai ulangan harian berhasil diambil']);
            }else{
                $nilai_ujian = false;
                // return $nilai_ujian;
                // return response()->json('Data nilai ujian gagal untuk diambil');
                return response()->json(['Data nilai sudah dimasukkan sebelumnya']);
            }
        }else{
            $nilai_ujian = true;
            // return $nilai_ujian;
            // return response()->json('Data nilai ujian berhasil diambil');
            return response()->json(['Data nilai berhasil diambil']);
        }
    }

    public function storeDeskripsiRaport(Request $request){
        $id_matapelajaran = DB::table('guru_sekolahs')->where('id_user', Auth::user()->id_user)->value('id_mata_pelajaran');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $deskripsi = 'Deskripsi';

        $deskripsiraport = new m_nilaiAkademik([
            'id_user_gurusekolah' => Auth::user()->id_user,
            'id_mata_pelajaran' => $id_matapelajaran,
            'id_user_siswa' => $request->get('id_siswa'),
            'id_kategori' => $request->get('id_kategori'),
            'tipe_nilai' =>$deskripsi,
            'nilai' => $request->get('deskripsi'),
            'tahun_ajaran' => $tahunajaran,
            'semester' => $semester,
        ]);

        $deskripsiraport->save();
        return response()->json([true]);
    }

    public function getCountNilaiUjianSikap($idmapel, $idsiswa, $tipenilai){
        $nilai_ujian = DB::table('nilai_sekolahs')->where('id_mata_pelajaran', $idmapel)->where('id_user_siswa', $idsiswa)->where('tipe_nilai', $tipenilai)->count();    
        return $nilai_ujian;
    }

    public function storeNilaiSikapKeterampilan(Request $request){
        $id_matapelajaran = DB::table('guru_sekolahs')->where('id_user', Auth::user()->id_user)->value('id_mata_pelajaran');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');

        $idsiswa = $request->get('id_siswa_modal');
        $tipenilai = $request->get('tipe_nilai');
        $idkategori = $request->get('id_kategori');
        $nilai = $request->get('nilai_sikap');

        // $getDataNilai = $this->getCountNilaiUjianSikap($id_matapelajaran, $idsiswa, $tipenilai);
        $sizeTipeNilai = count(collect($request)->get('tipe_nilai'));
        $sizeNilai = count(collect($request)->get('nilai_sikap'));

        if($sizeNilai == $sizeTipeNilai){
            foreach ($nilai as $key => $value) {
                $nilaisikap = new m_nilaiAkademik();
                $nilaisikap->id_user_gurusekolah = Auth::user()->id_user;
                $nilaisikap->id_mata_pelajaran = $id_matapelajaran;
                $nilaisikap->id_user_siswa = $idsiswa;
                $nilaisikap->id_kategori = $idkategori[$key];
                $nilaisikap->tipe_nilai = $tipenilai[$key];
                $nilaisikap->nilai = $value ;
                $nilaisikap->tahun_ajaran = $tahunajaran;
                $nilaisikap->semester = $semester;
                $nilaisikap->save();
            }
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }
    }

    public function storeNilaiSikap(Request $request){
        $id_matapelajaran = DB::table('guru_sekolahs')->where('id_user', Auth::user()->id_user)->value('id_mata_pelajaran');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');

        $nilai = $request->input('nilai_sikap');

        //simpan data menggunakan eloquent kurang lebihnya seperti ini
        for ($x = 0; $x <= 10; $x++) {
            $nilaisikap = new m_nilaiAkademik();
            $nilaisikap->id_user_gurusekolah = Auth::user()->id_user;
            $nilaisikap->id_mata_pelajaran = $id_matapelajaran;
            $nilaisikap->id_user_siswa = $request->get('id_siswa');
            $nilaisikap->id_kategori = $request->get('id_kategori');
            $nilaisikap->tipe_nilai = $request->get('tipe_sikapberpendapat');
            $nilaisikap->nilai = $request->get('sikapBerpendapat');
            $nilaisikap->tahun_ajaran = $tahunajaran;
            $nilaisikap->semester = $semester;
            $nilaisikap->save();
            
            //insert data laravel biasa
           }

        return redirect('/presensi_sekolah')->with('success', 'Data presensi berhasil disimpan.');
    }
    public function get_siswa($nama_kelas){
        $siswa = DB::table('nilai_sekolahs')->select('nilai_sekolahs.id_user_siswa', 'kelas.nama_kelas', 'siswas.id_user', 'siswas.nama_siswa')
        ->join('siswas', 'siswas.id_user','=','nilai_sekolahs.id_user_siswa')
        ->join('kelas_memiliki_siswas', 'kelas_memiliki_siswas.id_siswa','=','nilai_sekolahs.id_user_siswa')
        ->join('kelas', 'kelas.kode_kelas','=','kelas_memiliki_siswas.kode_kelas')
        ->where('kelas.nama_kelas', $nama_kelas)->distinct()->get();
        return response()->json($siswa);
    }

    public function get_nilai(Request $request){
        $nilai = DB::table('nilai_sekolahs')
        ->where('id_user_siswa', $request->get('id_user_siswa'))
        ->where('id_mata_pelajaran', $request->get('id_mata_pelajaran'))
        ->where('tahun_ajaran', $request->get('tahun_ajaran'))
        ->where('semester', $request->get('semester'))
        ->where('tipe_nilai','!=','Deskripsi')
        ->where('id_kategori', $request->get('id_kategori'))->get();

        $nilai_array = array();
        $responseNilai = json_decode($nilai, true);

        $id = array_column($responseNilai, 'id');
        $nilai = array_column($responseNilai, 'nilai');
        $tipenilai = array_column($responseNilai, 'tipe_nilai');

        foreach ($nilai as $key => $value) { 
            if($responseNilai[$key]['nilai'] < 75){
                $nilai_array[$key]['id']=  $id[$key];
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']= $nilai[$key];
                $nilai_array[$key]['keterangan']= 'Remedial';
            }else{
                $nilai_array[$key]['id']=  $id[$key];
                $nilai_array[$key]['tipe_nilai']=  $tipenilai[$key];
                $nilai_array[$key]['nilai']= $nilai[$key];
                $nilai_array[$key]['keterangan']= '';
            }
        }

        $nilai_array = json_encode($nilai_array);
        return $nilai_array;
    }

    public function updateNilai(Request $request){
    
        DB::table('nilai_sekolahs')
                ->where('id', $request->get('id_nilai'))
                ->where('id_user_siswa', $request->get('id_siswa'))
                ->update(['nilai' => $request->get('nilai')]);
       
        return response()->json([true]);;
    }

    public function deleteNilaiSekolah($id){
        $nilai_sekolah = m_nilaiAkademik::findOrFail($id);
        $nilai_sekolah->delete();
        return response()->json([true]);
    }

}
