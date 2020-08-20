<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_kelasAsramaSiswa extends Model
{
    protected $table = 'kelas_asrama_memiliki_siswas';
    protected $fillable = [
        'kode_kelas_asrama',
        'id_siswa',
    ];
}
