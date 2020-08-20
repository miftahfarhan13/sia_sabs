<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\m_kritikDanSaran;
use App\m_kritikDanSaranSiswa;

class c_kritikDanSaran extends Controller
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
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran2 = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        $kritikdansaran = DB::table('kritik_dan_sarans')
        ->where('tahun_ajaran', $tahunajaran2)
        ->where('semester', $semester)
        ->where('id_orangtua', Auth::user()->id_user)->get();

        return view('kritik_dan_saran', ['tahunajaran'=>$tahunajaran, 'kritikdansaran'=>$kritikdansaran]);
    }

    public function getKritikSaran()
    {
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran2 = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();
        $kritikdansaran = DB::table('kritik_dan_sarans')
        ->join('orang_tuas', 'orang_tuas.id_orangtua','=','kritik_dan_sarans.id_orangtua')
        ->where('tahun_ajaran', $tahunajaran2)
        ->where('semester', $semester)->get();

        $kritikdansaransiswa = DB::table('kritik_dan_saran_siswas')
        ->join('siswas', 'siswas.id_user','=','kritik_dan_saran_siswas.id_siswa')
        ->where('tahun_ajaran', $tahunajaran2)
        ->where('semester', $semester)
        ->where('id_guru', Auth::user()->id_user)->get();
        return view('lihat_kritik_dan_saran', ['tahunajaran'=>$tahunajaran, 'kritikdansaran'=>$kritikdansaran, 'kritikdansaransiswa'=>$kritikdansaransiswa]);
    }

    public function kritikDanSaranSiswaView()
    {
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();

        $kelassiswa = DB::table('kelas_memiliki_siswas')->where('id_siswa', Auth::user()->id_user)->value('kode_kelas');
        $gurusekolah = DB::table('guru_sekolahs')->select('guru_sekolahs.id_user', 'guru_sekolahs.nama_guru_sekolah')
        ->join('guru_mempunyai_jadwals', 'guru_mempunyai_jadwals.id_gurusekolah','=','guru_sekolahs.id_user')
        ->where('guru_mempunyai_jadwals.kode_kelas', $kelassiswa)->distinct()->get();

        $gedungsiswa = DB::table('gedung_memiliki_siswas')->where('id_siswa', Auth::user()->id_user)->value('kode_gedung');
        $guruasrama = DB::table('guru_asramas')->select('guru_asramas.nik_guruasrama', 'guru_asramas.nama_guru_asrama')
        ->join('gedungs', 'gedungs.id_user_guruasrama','=','guru_asramas.nik_guruasrama')
        ->where('gedungs.kode_gedung', $gedungsiswa)->distinct()->get();
        
        return view('kritik_dan_saran_siswa', ['tahunajaran'=>$tahunajaran, 'gurusekolah'=>$gurusekolah, 'guruasrama'=>$guruasrama]);
    }

    public function updateKritikSaran(Request $request){      
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');  
        DB::table('kritik_dan_sarans')
                ->where('id_orangtua', Auth::user()->id_user)
                ->where('tahun_ajaran', $tahunajaran)
                ->where('semester', $semester)
                ->update(['kritik' => $request->get('kritik'),
                'saran' => $request->get('saran'),]);
       
        return redirect('/kritik_dan_saran')->with('success', 'Kritik dan Saran anda berhasil diupdate.');
    }

    public function storeKritikSaran(Request $request){
        $validasi = $request->validate([
            'kritik' => 'required',
            'saran' => 'required',
        ]);

        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $kritiksaran = new m_kritikDanSaran([
            'id_orangtua' => Auth::user()->id_user,
            'kritik' => $request->get('kritik'),
            'saran' => $request->get('saran'),
            'tahun_ajaran' => $tahunajaran,
            'semester' => $semester,
        ]);

        $kritiksaran->save();
        return redirect('/kritik_dan_saran')->with('success', 'Terima kasih, Kritik dan Saran anda berhasil disimpan.');
    }

    public function storeKritikSaranSiswa(Request $request){

        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $kritiksaran = new m_kritikDanSaranSiswa([
            'id_siswa' => Auth::user()->id_user,
            'id_guru' => $request->get('id_guru'),
            'kritik_dan_saran' => $request->get('kritik'),
            'tahun_ajaran' => $tahunajaran,
            'semester' => $semester,
        ]);

        $kritiksaran->save();
        return response()->json([true]);
    }

    
}
