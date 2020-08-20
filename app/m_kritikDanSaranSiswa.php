<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_kritikDanSaranSiswa extends Model
{
    protected $table = 'kritik_dan_saran_siswas';

    protected $fillable = [
        'id_siswa',
        'id_guru',
        'kritik_dan_saran',
        'tahun_ajaran',
        'semester',
        
    ];
}
