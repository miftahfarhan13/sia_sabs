<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_presensiAsrama extends Model
{
    protected $table = 'siswa_menghadiri_kegiatan_asramas';
    protected $fillable = [
        'id_kegiatan',
        'id_user_siswa',
        'id_user_guruasrama',
        'keterangan',
    ];
}
