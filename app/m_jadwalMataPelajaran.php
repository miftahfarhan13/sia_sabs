<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_jadwalMataPelajaran extends Model
{
    protected $table = 'guru_mempunyai_jadwals';
    protected $fillable = [
        'kode_kelas',
        'id_gurusekolah',
        'kode_mapel',
        'hari',
        'jam',
        'tahun_ajaran',
        'semester',
    ];
}
