<?php

namespace App\Http\Controllers;

use App\m_gedungSiswa;
use App\m_guruAsrama;
use App\m_guruSekolah;
use App\m_kelasSiswa;
use App\m_siswa;
use App\m_kelasAsramaSiswa;
use App\m_orangTua;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_kelolaAkun extends Controller
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
        $orangtua = DB::table('orang_tuas')->orderBy('nama', 'ASC')->get();
        $kelasasrama = DB::table('kelas_asramas')->where('nama_kelas_asrama', '!=', 'Umum')->get();
        $kelassekolah = DB::table('kelas')->get();
        $gedung = DB::table('gedungs')->get();
        $kodegedung = DB::table('gedungs')->get('id_user_guruasrama');
        $gedungguruasrama = DB::table('gedungs')->get();
        $matapelajaran = DB::table('mata_pelajarans')->get();
        return view('/kelola_akun', ['orangtua'=>$orangtua, 'kelasasrama'=>$kelasasrama ,'kelassekolah'=>$kelassekolah , 'gedung'=>$gedung, 'gedungguruasrama'=>$gedungguruasrama, 'matapelajaran'=>$matapelajaran]);
    }

    public function storeAkunSiswa(Request $request){

        $siswa = new m_siswa([
            'id_user' => $request->get('id_user'),
            'id_orangtua' => $request->get('id_orangtua'),
            'nama_siswa' => $request->get('nama_siswa'),
            'tanggal_lahir' => $request->get('tanggal_lahir'),
            'alamat' =>$request->get('alamat'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
        ]);

        $user = new User([
            'name' => $request->get('nama_siswa'),
            'id_user' => $request->get('id_user'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
        ]);

        $gedung = new m_gedungSiswa([
            'kode_gedung' => $request->get('kode_gedung'),
            'id_siswa' => $request->get('id_user'),
        ]);

        $kelassekolah = new m_kelasSiswa([
            'kode_kelas' => $request->get('kode_kelas'),
            'id_siswa' => $request->get('id_user'),
        ]);

        $kelasasrama = new m_kelasAsramaSiswa([
            'kode_kelas_asrama' => $request->get('kode_kelas_asrama'),
            'id_siswa' => $request->get('id_user'),
        ]);
        
        $siswa->save();
        $user->save();
        $gedung->timestamps = false;
        $gedung->save();
        $kelassekolah->timestamps = false;
        $kelassekolah->save();
        $kelasasrama->timestamps = false;
        $kelasasrama->save();
        
        return response()->json([true]);
        
    }

    public function storeAkunAdmin(Request $request){
        $user = new User([
            'name' => $request->get('nama_admin'),
            'id_user' => $request->get('id_admin'),
            'password' => Hash::make($request->get('password_admin')),
            'role' => $request->get('role_admin'),
        ]);
       
        $user->save();
        return response()->json([true]);
        
    }

    public function storeAkunOrangTua(Request $request){

        $orangtua = new m_orangTua([
            'id_orangtua' => $request->get('id_orangtua'),
            'nama' => $request->get('nama_orangtua'),
        ]);

        $user = new User([
            'name' => $request->get('nama_orangtua'),
            'id_user' => $request->get('id_orangtua'),
            'password' => Hash::make($request->get('password_orangtua')),
            'role' => $request->get('role_orangtua'),
        ]);
       
        $user->save();
        $orangtua->timestamps = false;
        $orangtua->save();
        return response()->json([true]);
        
    }

    public function storeAkunGuruSekolah(Request $request){

        $gurusekolah = new m_guruSekolah([
            'id_user' => $request->get('id_gurusekolah'),
            'id_mata_pelajaran' => $request->get('id_mata_pelajaran'),
            'nama_guru_sekolah' => $request->get('nama_gurusekolah'),
            'tanggal_lahir' => $request->get('tanggal_lahir_gurusekolah'),
            'alamat' => $request->get('alamat_gurusekolah'),
            'jenis_kelamin' => $request->get('jenis_kelamin_gurusekolah'),
        ]);

        $user = new User([
            'name' => $request->get('nama_gurusekolah'),
            'id_user' => $request->get('id_gurusekolah'),
            'password' => Hash::make($request->get('password_gurusekolah')),
            'role' => $request->get('role_gurusekolah'),
        ]);
       
        $user->save();
        $gurusekolah->timestamps = false;
        $gurusekolah->save();
        return response()->json([true]);
        
    }

    public function storeAkunGuruAsrama(Request $request){

        $guruasrama = new m_guruAsrama([
            'nik_guruasrama' => $request->get('id_guruasrama'),
            'nama_guru_asrama' => $request->get('nama_guruasrama'),
            'tanggal_lahir' => $request->get('tanggal_lahir_guruasrama'),
            'alamat' => $request->get('alamat_guruasrama'),
            'jenis_kelamin' => $request->get('jenis_kelamin_guruasrama'),
        ]);

        $user = new User([
            'name' => $request->get('nama_guruasrama'),
            'id_user' => $request->get('id_guruasrama'),
            'password' => Hash::make($request->get('password_guruasrama')),
            'role' => $request->get('role_guruasrama'),
        ]);

        DB::table('gedungs')
                ->where('kode_gedung', $request->get('kode_gedung_guruasrama'))
                ->update(['id_user_guruasrama' => $request->get('id_guruasrama')]);
       
        $user->save();
        $guruasrama->timestamps = false;
        $guruasrama->save();
        return response()->json([true]);
        
    }
    public function getDataKelasSiswa(Request $request){
        $tahunajaran2 = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');

        $siswa = DB::table('siswas')
        ->join('kelas_memiliki_siswas', 'kelas_memiliki_siswas.id_siswa','=','siswas.id_user')
        ->join('kelas', 'kelas.kode_kelas','=','kelas_memiliki_siswas.kode_kelas')
        ->where('kelas.kode_kelas', $request->get('kode_kelas'))
        ->where('guru_mempunyai_jadwals.tahun_ajaran',$tahunajaran2)
        ->where('guru_mempunyai_jadwals.semester',$semester)->get();

        return $siswa;
    }

    public function getDataGedungSiswa(Request $request){
        $siswa = DB::table('siswas')
        ->join('gedung_memiliki_siswas', 'gedung_memiliki_siswas.id_siswa','=','siswas.id_user')
        ->join('gedungs', 'gedungs.kode_gedung','=','gedung_memiliki_siswas.kode_gedung')
        ->where('gedungs.kode_gedung', $request->get('kode_gedung'))
        ->get();
        
        return $siswa;
    }
    

    public function updateKelasSiswa(Request $request){   
        DB::table('kelas_memiliki_siswas')
                ->where('id_siswa', $request->get('id_user_siswa'))
                ->update(['kode_kelas' => $request->get('kode_kelas')]);
       
        return response()->json([true]);;
    }

    public function updateGedungSiswa(Request $request){   
        DB::table('gedung_memiliki_siswas')
                ->where('id_siswa', $request->get('id_user_siswa'))
                ->update(['kode_gedung' => $request->get('kode_gedung')]);
       
        return response()->json([true]);;
    }
}
