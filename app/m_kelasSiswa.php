<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_kelasSiswa extends Model
{
    protected $table = 'kelas_memiliki_siswas';
    protected $fillable = [
        'kode_kelas',
        'id_siswa',
        'tahun_ajaran',
        'semester',
    ];
}
