<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_gedungSiswa extends Model
{
    protected $table = 'gedung_memiliki_siswas';
    protected $fillable = [
        'kode_gedung',
        'id_siswa',
    ];
}
