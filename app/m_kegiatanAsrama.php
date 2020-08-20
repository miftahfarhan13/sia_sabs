<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_kegiatanAsrama extends Model
{
    protected $table = 'kegiatan_asramas';
    protected $fillable = [
        'id_user_guruasrama',
        'kode_kelas_asrama',
        'nama_kegiatan',
        'tanggal',
        'nama_tempat',
        'jam',
    ];
}
