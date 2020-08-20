<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class m_nilaiAsrama extends Model
{

    protected $table = 'nilai_asramas';
    protected $id_user_siswa = '';
    protected $id_user_guruasrama = '';
    protected $kode_materi = '';
    protected $tipe_nilai = '';
    protected $nilai = '';
    protected $tahun_ajaran = '';
    protected $semester = '';

    protected $fillable = [
        'id_user_siswa',
        'id_user_guruasrama',
        'kode_materi',
        'kategori_materi',
        'kelas_asrama',
        'tipe_nilai',
        'nilai',
        'tahun_ajaran',
        'semester',
    ];

    public function getCountNilaiAsrama($kodemateri){

        $tahunajaran = DB::table('sekolahs')->where('status','=','aktif')->value('tahun_ajaran');
        $semester = DB::table('sekolahs')->where('status','=','aktif')->value('semester');
        $nilai_asrama = DB::table('nilai_asramas')
        ->where('kode_materi', $kodemateri)
        ->where('tahun_ajaran', $tahunajaran)
        ->where('semester', $semester)
        ->where('id_user_guruasrama', Auth::user()->id_user)->get();
        
        $datanilai = array();

        if(Str::contains($kodemateri, 'ASA - ')){
            $datanilai[0]['nilai'] = $nilai_asrama;
            $datanilai[0]['datanilai'] = 'true';
        }else{
            $datanilai[0]['nilai'] = [];
            $datanilai[0]['datanilai'] = 'false';
        }
                
        return $datanilai;
    }
}
