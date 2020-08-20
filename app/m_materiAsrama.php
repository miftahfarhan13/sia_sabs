<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_materiAsrama extends Model
{
    protected $table = 'materi_asramas';
    protected $fillable = [
        'kode_materi',
        'kode_kelas_asrama',
        'kategori_materi',
        'nama_materi',
        
    ];
}
