<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\m_suratSakit;

class c_suratSakit extends Controller
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
        $kodegedung = DB::table('gedungs')->where('id_user_guruasrama', Auth::user()->id_user)->value('kode_gedung');
        $siswagedung = DB::table('gedung_memiliki_siswas')
        ->join('siswas', 'siswas.id_user','=','gedung_memiliki_siswas.id_siswa')
        ->where('gedung_memiliki_siswas.kode_gedung', $kodegedung)->get();
        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->get();

        $daftarsakit = DB::table('surat_sakits')
        ->join('siswas', 'siswas.id_user','=','surat_sakits.id_siswa')
        ->where('surat_sakits.id_user_guruasrama', Auth::user()->id_user)
        ->where('surat_sakits.tanggal', date('Y-m-d'))->get();

        return view('surat_sakit', ['tahunajaran'=>$tahunajaran, 'siswagedung'=>$siswagedung, 'daftarsakit'=>$daftarsakit]);
        
    }

    public function storeSuratSakit(Request $request){
        $validasi = $request->validate([
            'keterangan' => 'required',
            'id_siswa' => 'required',
        ]);

        $suratsakit = new m_suratSakit([
            'id_user_guruasrama' => Auth::user()->id_user,
            'tanggal' => date('Y-m-d'),
            'keterangan' => $request->get('keterangan'),
            'id_siswa' => $request->get('id_siswa'),
            
        ]);

        $suratsakit->save();
        return redirect('/surat_sakit')->with('success', 'Surat sakit berhasil disimpan dan dikirimkan kepada pihak sekolah.');
    }
}
