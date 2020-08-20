<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_mataPelajaran extends Model
{
    protected $table = 'mata_pelajarans';
    protected $fillable = [
        'kode_mapel',
        'nama_mata_pelajaran',
        
    ];
}
