<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class m_nilaiAkademik extends Model
{
    protected $table = 'nilai_sekolahs';
    
    protected $id_mata_pelajaran;
    protected $id_user_siswa;
    protected $id_user_gurusekolah;
    protected $id_kategori;
    protected $tipe_nilai;
    protected $nilai;
    protected $tahun_ajaran;
    protected $semester;

    protected $fillable = [
        'id_mata_pelajaran',
        'id_user_siswa',
        'id_user_gurusekolah',
        'id_kategori',
        'tipe_nilai',
        'nilai',
        'tahun_ajaran',
        'semester',
    ];

    public function getCountNilaiUjian($idmapel, $idsiswa, $tipenilai, $tahunajaran, $semester){
        
            $nilai_ujian = DB::table('nilai_sekolahs')
            ->where('id_mata_pelajaran', $idmapel)
            ->where('id_user_siswa', $idsiswa)
            ->where('tipe_nilai', $tipenilai)
            ->where('tahun_ajaran', $tahunajaran)
            ->where('semester', $semester)->count();
            return $nilai_ujian;
    }
}
