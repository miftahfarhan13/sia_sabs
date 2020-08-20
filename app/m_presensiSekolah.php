<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_presensiSekolah extends Model
{
    protected $table = 'hari_presensi_sekolahs';
    protected $fillable = [
        'id_siswa',
        'kelas',
        'tanggal',
        'keterangan',
        'tahun_ajaran',
        'semester',
        
    ];
}
